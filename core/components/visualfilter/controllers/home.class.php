<?php

/**
 * The home manager controller for visualfilter.
 *
 */
class visualfilterHomeManagerController extends visualfilterMainController {
	/* @var visualfilter $visualfilter */
	public $visualfilter;


	/**
	 * @param array $scriptProperties
	 */
	public function process(array $scriptProperties = array()) {
	}


	/**
	 * @return null|string
	 */
	public function getPageTitle() {
		return $this->modx->lexicon('visualfilter');
	}


	/**
	 * @return void
	 */
	public function loadCustomCssJs() {
		$this->addCss($this->visualfilter->config['cssUrl'] . 'mgr/main.css');
		$this->addCss($this->visualfilter->config['cssUrl'] . 'mgr/bootstrap.buttons.css');
		$this->addJavascript($this->visualfilter->config['jsUrl'] . 'mgr/misc/utils.js');
		$this->addJavascript($this->visualfilter->config['jsUrl'] . 'mgr/widgets/items.grid.js');
		$this->addJavascript($this->visualfilter->config['jsUrl'] . 'mgr/widgets/items.windows.js');
		$this->addJavascript($this->visualfilter->config['jsUrl'] . 'mgr/widgets/home.panel.js');
		$this->addJavascript($this->visualfilter->config['jsUrl'] . 'mgr/sections/home.js');
		$this->addHtml('<script type="text/javascript">
		Ext.onReady(function() {
			MODx.load({ xtype: "visualfilter-page-home"});
		});
		</script>');
	}


	/**
	 * @return string
	 */
	public function getTemplateFile() {
		return $this->visualfilter->config['templatesPath'] . 'home.tpl';
	}
}