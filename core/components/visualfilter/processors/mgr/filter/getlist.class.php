<?php

/**
 * Get a list of vfFilter
 */
class vfFilterGetListProcessor extends modObjectGetListProcessor {
	public $objectType = 'vfFilter';
	public $classKey = 'vfFilter';
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
		$query = trim($this->getProperty('query'));
		if ($query) {
			$c->where(array(
				'field:LIKE' => "%{$query}%",
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
		$array['actions'] = array();

		// Edit
		$array['actions'][] = array(
			'cls' => '',
			'icon' => 'icon icon-edit',
			'title' => $this->modx->lexicon('vf_item_update'),
			//'multiple' => $this->modx->lexicon('vf_items_update'),
			'action' => 'updateFilter',
			'button' => true,
			'menu' => true,
		);

		// Remove
		$array['actions'][] = array(
			'cls' => '',
			'icon' => 'icon icon-trash-o action-red',
			'title' => $this->modx->lexicon('vf_item_remove'),
			'multiple' => $this->modx->lexicon('vf_items_remove'),
			'action' => 'removeFilter',
			'button' => true,
			'menu' => true,
		);

		return $array;
	}

}

return 'vfFilterGetListProcessor';