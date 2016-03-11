<?php

/**
 * Create an vfFilter
 */
class vfFilterCreateProcessor extends modObjectCreateProcessor {
	public $objectType = 'vfFilter';
	public $classKey = 'vfFilter';
	public $languageTopics = array('visualfilter');
	//public $permission = 'create';


	/**
	 * @return bool
	 */
	public function beforeSet() {
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

        // method is required
        $method = trim($this->getProperty('method'));
        if (empty($method)) {
            $this->modx->error->addField('method', $this->modx->lexicon('vf_filter_err_method'));
        }

        // code & field combination is unique
        if (!empty($code) && !empty($field) && $this->modx->getCount($this->classKey, array('code' => $code, 'field' => $field))) {
            $this->modx->error->addField('field', $this->modx->lexicon('vf_item_err_ae'));
        }

        // alias is unique, if not empty
        $alias = trim($this->getProperty('alias'));
        if(!empty($alias) && $this->modx->getCount($this->classKey, array('alias' => $alias))) {
            $this->modx->error->addField('alias', $this->modx->lexicon('vf_item_err_ae'));
        }

		return parent::beforeSet();
	}

}

return 'vfFilterCreateProcessor';