<?php

// Load MODX config
/** @noinspection PhpIncludeInspection */
if (file_exists(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php')) {
    require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
}
else {
    require_once dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/config.core.php';
}

/** @noinspection PhpIncludeInspection */
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CONNECTORS_PATH . 'index.php';
/** @var visualFilter $visualFilter */
$visualFilter = $modx->getService('visualFilter', 'visualFilter', $modx->getOption('visualfilter_core_path', null, $modx->getOption('core_path') . 'components/visualfilter/') . 'model/visualfilter/');
$modx->lexicon->load('visualfilter:default');

// handle request
$corePath = $modx->getOption('visualfilter_core_path', null, $modx->getOption('core_path') . 'components/visualfilter/');
$path = $modx->getOption('processorsPath', $visualFilter->config, $corePath . 'processors/');
$modx->request->handleRequest(array(
	'processors_path' => $path,
	'location' => '',
));