<?php

/**
 * Get a list of vfCategoryFilter
 */
class vfCategoryFilterGetListProcessor extends modObjectGetListProcessor {
	public $objectType = 'vfCategoryFilter';
	public $classKey = 'vfCategoryFilter';
	public $defaultSortField = 'priority';
	public $defaultSortDirection = 'ASC';
	//public $permission = 'list';


	/**
	 * * We doing special check of permission
	 * because of our objects is not an instances of modAccessibleObject
	 *
	 * @return boolean|string
	 */
	public function beforeQuery() {
		if (!$this->checkPermissions()) {
			return $this->modx->lexicon('access_denied');
		}

		return true;
	}


	/**
	 * @param xPDOQuery $c
	 *
	 * @return xPDOQuery
	 */
	public function prepareQueryBeforeCount(xPDOQuery $c) {
        $c->leftJoin('vfFilter','Filter','`vfCategoryFilter`.`filter_id` = `Filter`.`id`');
        $c->leftJoin('msCategory','Category','`vfCategoryFilter`.`category_id` = `Category`.`id`');
        $c->select($this->modx->getSelectColumns($this->classKey, $this->classKey, ''));
        $c->select('`Filter`.`title` as `filter_title`,`Filter`.`code` as `filter_code`, `Filter`.`field` as `filter_field`, `Filter`.`filter_method` as `filter_method`, `Filter`.`active` as `active`');

        $category_id = intval($this->getProperty('category_id'));
        if(!empty($category_id)) {
            $c->where(array('`vfCategoryFilter`.`category_id`' => $category_id));
        }

		$query = trim($this->getProperty('query'));
		if ($query) {
			$c->where(array(
				'`Filter`.`title`:LIKE' => "%{$query}%",
                'OR:`Filter`.`code`:LIKE' => "%{$query}%",
                'OR:`Filter`.`field`:LIKE' => "%{$query}%",
                'OR:`Filter`.`filter_method`:LIKE' => "%{$query}%",
			));
		}

		return $c;
	}


	/**
	 * @param xPDOObject $object
	 *
	 * @return array
	 */
	public function prepareRow(xPDOObject $object) {
		$array = $object->toArray();

        $array['filter_value'] = $array['filter_code'].'|'.$array['filter_field'];
        if(!empty($array['filter_method'])){
            $array['filter_value'] .= ':'.$array['filter_method'];
        }

		$array['actions'] = array();

		// Edit
		$array['actions'][] = array(
			'cls' => '',
			'icon' => 'icon icon-edit',
			'title' => $this->modx->lexicon('vf_item_update'),
			//'multiple' => $this->modx->lexicon('vf_items_update'),
			'action' => 'updateCategoryFilter',
			'button' => true,
			'menu' => true,
		);

		// Remove
		$array['actions'][] = array(
			'cls' => '',
			'icon' => 'icon icon-trash-o action-red',
			'title' => $this->modx->lexicon('vf_item_remove'),
			'multiple' => $this->modx->lexicon('vf_items_remove'),
			'action' => 'removeCategoryFilter',
			'button' => true,
			'menu' => true,
		);

		return $array;
	}

}

return 'vfCategoryFilterGetListProcessor';