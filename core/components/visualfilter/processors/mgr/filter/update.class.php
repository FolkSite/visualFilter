<?php

/**
 * Update an vfFilter
 */
class vfFilterUpdateProcessor extends modObjectUpdateProcessor {
	public $objectType = 'vfFilter';
	public $classKey = 'vfFilter';
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

        // code is required
        $code = trim($this->getProperty('code'));
        if (empty($code)) {
            $this->modx->error->addField('code', $this->modx->lexicon('vf_filter_err_code'));
        }
        // field is required
        $field = trim($this->getProperty('field'));
        if (empty($field)) {
            $this->modx->error->addField('field', $this->modx->lexicon('vf_filter_err_field'));
        }

        // filter method is required
        $method = trim($this->getProperty('filter_method'));
        if (empty($method)) {
            $this->modx->error->addField('filter_method', $this->modx->lexicon('vf_filter_err_method'));
        }

        // code & field combination is unique
        if (!empty($code) && !empty($field) && $this->modx->getCount($this->classKey, array('code' => $code, 'field' => $field, 'id:!=' => $id))) {
            $this->modx->error->addField('field', $this->modx->lexicon('vf_item_err_ae'));
        }

        // alias is unique, if not empty
        $alias = trim($this->getProperty('alias'));
        if(!empty($alias) && $this->modx->getCount($this->classKey, array('alias' => $alias, 'id:!=' => $id))) {
            $this->modx->error->addField('alias', $this->modx->lexicon('vf_item_err_ae'));
        }

		return parent::beforeSet();
	}
}

return 'vfFilterUpdateProcessor';
