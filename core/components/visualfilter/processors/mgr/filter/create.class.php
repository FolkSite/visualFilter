<?php

/**
 * Create an vfFilter
 */
class vfFilterItemCreateProcessor extends modObjectCreateProcessor {
	public $objectType = 'vfFilter';
	public $classKey = 'vfFilter';
	public $languageTopics = array('visualfilter');
	//public $permission = 'create';


	/**
	 * @return bool
	 */
	public function beforeSet() {
        $code = trim($this->getProperty('code'));
		if (empty($code)) {
			$this->modx->error->addField('code', $this->modx->lexicon('vf_filter_err_code'));
		}

        $field = trim($this->getProperty('field'));
        if (empty($field)) {
            $this->modx->error->addField('field', $this->modx->lexicon('vf_filter_err_field'));
        }
        elseif ($this->modx->getCount($this->classKey, array('field' => $field))) {
            $this->modx->error->addField('field', $this->modx->lexicon('vf_item_err_ae'));
        }

        $method = trim($this->getProperty('method'));
        if (empty($method)) {
            $this->modx->error->addField('method', $this->modx->lexicon('vf_filter_err_method'));
        }

		return parent::beforeSet();
	}

}

return 'vfFilterItemCreateProcessor';