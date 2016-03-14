<?php

/**
 * Create an vfCategoryFilter
 */
class vfCategoryFilterCreateProcessor extends modObjectCreateProcessor {
	public $objectType = 'vfCategoryFilter';
	public $classKey = 'vfCategoryFilter';
	public $languageTopics = array('visualfilter');
	//public $permission = 'create';


	/**
	 * @return bool
	 */
	public function beforeSet() {
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
        if (!empty($category_id) && !empty($filter_id) && $this->modx->getCount($this->classKey, array('category_id' => $category_id, 'filter_id' => $filter_id))) {
            $this->modx->error->addField('filter_id', $this->modx->lexicon('vf_item_err_ae'));
        }

		return parent::beforeSet();
	}

}

return 'vfCategoryFilterCreateProcessor';