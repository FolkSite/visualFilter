<?php

/**
 * Get a combo list of vfFilter
 */
class vfFilterGetComboListProcessor extends modObjectGetListProcessor {
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
        $title = $array['code'].'|'.$array['field'];
        if(!empty($array['filter_method'])) {
            $title .= ':'.$array['filter_method'];
        }

        if(!empty($array['title'])) {
            $title = $array['title'].' ('.$title.')';
        }

        $array['title'] = $title;

		return $array;
	}

}

return 'vfFilterGetComboListProcessor';