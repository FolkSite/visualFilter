<?php

/**
 * Clone category filters from parent category (recursively)
 */
class vfCategoryFiltersCloneProcessor extends modProcessor {
	public $objectType = 'vfCategoryFilter';
	public $classKey = 'vfCategoryFilter';
	public $languageTopics = array('visualfilter:default');
	//public $permission = 'view';

    /* @var $category modResource */
    private $category;

    /* @var $parentCategory modResource */
    private $parentCategory;

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

        if(!$this->parentCategory = $this->findParentCategory($this->category)) {
            return $this->failure($this->modx->lexicon('vf_category_filters_clone_no_parent'));
        }

        $oldCategoryFilters = $this->modx->getIterator($this->classKey, array('category_id' => $categoryId));
        /* @var $oldCategoryFilter vfCategoryFilter */
        foreach($oldCategoryFilters as $idx => $oldCategoryFilter) {
            $oldCategoryFilter->remove();
        }

        $parentFilters = $this->modx->getIterator($this->classKey, array('category_id' => $this->parentCategory->get('id')));
        /* @var $parentFilter vfCategoryFilter */
        foreach($parentFilters as $idx => $parentFilter) {
            $categoryFilter = $this->modx->newObject($this->classKey, array(
                'priority' => $parentFilter->get('priority'),
                'category_id' => $categoryId,
                'filter_id' => $parentFilter->get('filter_id'),
            ));
            $categoryFilter->save();
        }

        return $this->success($categoryId);
	}

    /**
     * @param $category modResource
     *
     * @return modResource
     */
    private function findParentCategory(& $category) {
        $parentIds = $this->modx->getParentIds($category->get('id'), 10, array('context' => $category->get('context_key')));

        if(empty($parentIds)) {
            return null;
        }

        foreach($parentIds as $parentId) {
            $parentCategory = $this->modx->getObject('msCategory', $parentId);
            if($parentCategory && $this->modx->getCount($this->classKey, array('category_id' => $parentId)) > 0) {
                return $parentCategory;
            }
        }

        return null;
    }

}

return 'vfCategoryFiltersCloneProcessor';