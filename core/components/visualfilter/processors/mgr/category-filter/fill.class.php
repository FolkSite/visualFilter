<?php

/**
 * Fill an vfCategoryFilter
 */
class vfCategoryFiltersFillProcessor extends modProcessor {
	public $objectType = 'vfCategoryFilter';
	public $classKey = 'vfCategoryFilter';
	public $languageTopics = array('visualfilter:default');
	//public $permission = 'view';

    /* @var $category msCategory */
    private $category;

	/**
	 * We doing special check of permission
	 * because of our objects is not an instances of modAccessibleObject
	 *
	 * @return mixed
	 */
	public function process() {
        $categoryId = $this->getProperty('category_id');
        if (empty($categoryId) || !$this->category = $this->modx->getObject('msCategory', $categoryId)) {
            return $this->failure($this->modx->lexicon('vf_request_error'));
        }

        $oldCategoryFilters = $this->modx->getIterator($this->classKey, array('category_id' => $categoryId));
        /* @var $oldCategoryFilter vfCategoryFilter */
        foreach($oldCategoryFilters as $idx => $oldCategoryFilter) {
            $oldCategoryFilter->remove();
        }

        $allFilters = $this->modx->getIterator('vfFilter');
        /* @var $filter vfFilter */
        foreach($allFilters as $idx => $filter) {
            $categoryFilter = $this->modx->newObject($this->classKey, array(
                'priority' => $filter->get('priority'),
                'category_id' => $categoryId,
                'filter_id' => $filter->get('id'),
            ));
            $categoryFilter->save();
        }

        return $this->success($categoryId);
	}

}

return 'vfCategoryFiltersFillProcessor';