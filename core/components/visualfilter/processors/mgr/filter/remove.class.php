<?php

/**
 * Remove an vfFilter
 */
class vfFilterRemoveProcessor extends modObjectProcessor {
	public $objectType = 'vfFilter';
	public $classKey = 'vfFilter';
	public $languageTopics = array('visualfilter');
	//public $permission = 'remove';


	/**
	 * @return array|string
	 */
	public function process() {
		if (!$this->checkPermissions()) {
			return $this->failure($this->modx->lexicon('access_denied'));
		}

		$ids = $this->modx->fromJSON($this->getProperty('ids'));
		if (empty($ids)) {
			return $this->failure($this->modx->lexicon('vf_item_err_ns'));
		}

		foreach ($ids as $id) {
			/** @var vfFilter $object */
			if (!$object = $this->modx->getObject($this->classKey, $id)) {
				return $this->failure($this->modx->lexicon('vf_item_err_nf'));
			}

			$object->remove();
		}

		return $this->success();
	}

}

return 'vfFilterRemoveProcessor';