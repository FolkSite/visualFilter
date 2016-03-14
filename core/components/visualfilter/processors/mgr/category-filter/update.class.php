<?php

/**
 * Update an vfCategoryFilter
 */
class vfCategoryFilterUpdateProcessor extends modObjectUpdateProcessor {
	public $objectType = 'vfCategoryFilter';
	public $classKey = 'vfCategoryFilter';
	public $languageTopics = array('visualfilter');
	//public $permission = 'save';


	/**
	 * We doing special check of permission
	 * because of our objects is not an instances of modAccessibleObject
	 *
	 * @return bool|string
	 */
	public function beforeSave() {
		if (!$this->checkPermissions()) {
			return $this->modx->lexicon('access_denied');
		}

		return true;
	}


	/**
	 * @return bool
	 */
	public function beforeSet() {
		$id = (int)$this->getProperty('id');
		if (empty($id)) {
			return $this->modx->lexicon('vf_item_err_ns');
		}


        // category_id is required
        $category_id = trim($this->getProperty('category_id'));
        if (empty($category_id)) {
            $this->modx->error->addField('filter_id', $this->modx->lexicon('vf_filter_err_category_id'));
        }
        // filter_id is required
        $filter_id = trim($this->getProperty('filter_id'));
        if (empty($filter_id)) {
            $this->modx->error->addField('filter_id', $this->modx->lexicon('vf_filter_err_filter_id'));
        }

        // category_id & filter_id combination is unique
        if (!empty($category_id) && !empty($filter_id) && $this->modx->getCount($this->classKey, array('category_id' => $category_id, 'filter_id' => $filter_id, 'id:!=' => $id))) {
            $this->modx->error->addField('filter_id', $this->modx->lexicon('vf_item_err_ae'));
        }

        return parent::beforeSet();
	}
}

return 'vfCategoryFilterUpdateProcessor';
