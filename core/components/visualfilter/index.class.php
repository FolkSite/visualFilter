<?php

/**
 * Class visualfilterMainController
 */
abstract class visualfilterMainController extends modExtraManagerController {
	/** @var visualfilter $visualfilter */
	public $visualfilter;


	/**
	 * @return void
	 */
	public function initialize() {
		$corePath = $this->modx->getOption('visualfilter_core_path', null, $this->modx->getOption('core_path') . 'components/visualfilter/');
		require_once $corePath . 'model/visualfilter/visualfilter.class.php';

		$this->visualfilter = new visualfilter($this->modx);
		//$this->addCss($this->visualfilter->config['cssUrl'] . 'mgr/main.css');
		$this->addJavascript($this->visualfilter->config['jsUrl'] . 'mgr/visualfilter.js');
		$this->addHtml('
		<script type="text/javascript">
			visualfilter.config = ' . $this->modx->toJSON($this->visualfilter->config) . ';
			visualfilter.config.connector_url = "' . $this->visualfilter->config['connectorUrl'] . '";
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
class IndexManagerController extends visualfilterMainController {

	/**
	 * @return string
	 */
	public static function getDefaultController() {
		return 'home';
	}
}