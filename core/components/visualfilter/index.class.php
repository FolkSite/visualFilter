<?php

/**
 * Class visualFilterMainController
 */
abstract class visualFilterMainController extends modExtraManagerController {
	/** @var visualFilter $visualFilter */
	public $visualFilter;


	/**
	 * @return void
	 */
	public function initialize() {
		$corePath = $this->modx->getOption('visualfilter_core_path', null, $this->modx->getOption('core_path') . 'components/visualfilter/');
		require_once $corePath . 'model/visualfilter/visualfilter.class.php';

		$this->visualFilter = new visualFilter($this->modx);
		//$this->addCss($this->visualFilter->config['cssUrl'] . 'mgr/main.css');
		$this->addJavascript($this->visualFilter->config['jsUrl'] . 'mgr/visualfilter.js');
		$this->addHtml('
		<script type="text/javascript">
			visualFilter.config = ' . $this->modx->toJSON($this->visualFilter->config) . ';
			visualFilter.config.connector_url = "' . $this->visualFilter->config['connectorUrl'] . '";
		</script>
		');

		parent::initialize();
	}


	/**
	 * @return array
	 */
	public function getLanguageTopics() {
		return array('visualfilter:default');
	}


	/**
	 * @return bool
	 */
	public function checkPermissions() {
		return true;
	}
}


/**
 * Class IndexManagerController
 */
class IndexManagerController extends visualFilterMainController {

	/**
	 * @return string
	 */
	public static function getDefaultController() {
		return 'home';
	}
}