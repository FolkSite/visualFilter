<?php

/**
 * The home manager controller for visualfilter.
 *
 */
class visualFilterHomeManagerController extends visualfilterMainController {
	/* @var visualFilter $visualFilter */
	public $visualFilter;


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
		$this->addCss($this->visualFilter->config['cssUrl'] . 'mgr/main.css');
		$this->addCss($this->visualFilter->config['cssUrl'] . 'mgr/bootstrap.buttons.css');
		$this->addJavascript($this->visualFilter->config['jsUrl'] . 'mgr/misc/utils.js');
		$this->addJavascript($this->visualFilter->config['jsUrl'] . 'mgr/widgets/filters.grid.js');
		$this->addJavascript($this->visualFilter->config['jsUrl'] . 'mgr/widgets/filters.windows.js');
		$this->addJavascript($this->visualFilter->config['jsUrl'] . 'mgr/widgets/home.panel.js');
		$this->addJavascript($this->visualFilter->config['jsUrl'] . 'mgr/sections/home.js');
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
		return $this->visualFilter->config['templatesPath'] . 'home.tpl';
	}
}