<?php

class vfFilterSortProcessor extends modObjectProcessor {
    public $classKey = 'vfFilter';


    /** {@inheritDoc} */
    public function process() {
        $tableName = $this->modx->getTableName($this->classKey);
        /* @var vfFilter $source */
        $source = $this->modx->getObject($this->classKey, $this->getProperty('source'));
        /* @var vfFilter $target */
        $target = $this->modx->getObject($this->classKey, $this->getProperty('target'));

        if (empty($source) || empty($target)) {
            return $this->modx->error->failure();
        }
        //$this->parent = $source->get('parent');

        if ($source->get('priority') < $target->get('priority')) {
            $this->modx->exec("UPDATE ".$tableName."
				SET priority = priority - 1 WHERE
					priority <= {$target->get('priority')}
					AND priority > {$source->get('priority')}
					AND priority > 0
			");

        } else {
            $this->modx->exec("UPDATE ".$tableName."
				SET priority = priority + 1 WHERE
					priority >= {$target->get('priority')}
					AND priority < {$source->get('priority')}
			");
        }
        $newRank = $target->get('priority');
        $source->set('priority',$newRank);
        $source->save();

        if (!$this->modx->getCount($this->classKey, array('priority' => 0))) {
            $this->setIndex();
        }
        return $this->modx->error->success();
    }


    /** {@inheritDoc} */
    public function setIndex() {
        $q = $this->modx->newQuery($this->classKey);
        $q->select('id');
        $q->sortby('priority ASC, id', 'ASC');

        if ($q->prepare() && $q->stmt->execute()) {
            $ids = $q->stmt->fetchAll(PDO::FETCH_COLUMN);
            $sql = '';
            $table = $this->modx->getTableName($this->classKey);
            foreach ($ids as $k => $id) {
                $sql .= "UPDATE ".$table." SET `priority` = '".$k."' WHERE `id` = '".$id."';";
            }
            $this->modx->exec($sql);
        }
    }
}

return 'vfFilterSortProcessor';