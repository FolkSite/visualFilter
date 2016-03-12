<?php
/** @var array $scriptProperties */
switch ($modx->event->name) {
    case 'OnDocFormRender':
        if ($mode == 'new') {
            return;
        }
        /** @var modResource $resource */
        $class_key = $resource->get('class_key');
        $template = $resource->get('template');
        if($class_key != 'msCategory') {
            return;
        }
        $showTemplates = trim($modx->getOption('visualfilter_show_templates'));
        $showTab = false;
        if($showTemplates == '*') {
            $showTab = true;
        }
        else {
            $showTemplates = array_map('trim', explode(',', $showTemplates));
            if (in_array($template, $showTemplates)) {
                $showTab = true;
            }
        }
        if(!$showTab) {
            return;
        }
        $modx23 = !empty($modx->version) && version_compare($modx->version['full_version'], '2.3.0', '>=');
        $modx->controller->addHtml('<script type="text/javascript">
			Ext.onReady(function() {
				MODx.modx23 = ' . (int)$modx23 . ';
			});
		</script>');
        /** @var visualFilter $visualFilter */
        $visualFilter = $modx->getService('visualFilter', 'visualFilter', MODX_CORE_PATH.'components/visualfilter/model/visualfilter/');
        $modx->controller->addLexiconTopic('visualfilter:default');
        $url = $visualFilter->config['assetsUrl'];
        $modx->controller->addJavascript($url . 'js/mgr/visualfilter.js');
        $modx->controller->addLastJavascript($url . 'js/mgr/misc/utils.js');
        //$modx->controller->addLastJavascript($url . 'js/mgr/widgets/threads.grid.js');
        //$modx->controller->addLastJavascript($url . 'js/mgr/widgets/threads.windows.js');
        //$modx->controller->addLastJavascript($url . 'js/mgr/widgets/messages.grid.js');
        //$modx->controller->addLastJavascript($url . 'js/mgr/widgets/messages.windows.js');
        $modx->controller->addLastJavascript($url . 'js/mgr/widgets/page.panel.js');
        $modx->controller->addCss($url . 'css/mgr/main.css');

        if ($modx->getCount('modPlugin', array('name' => 'AjaxManager', 'disabled' => false))) {
            $modx->controller->addHtml('
			<script type="text/javascript">
				visualFilter.config = ' . $modx->toJSON($visualFilter->config) . ';
				visualFilter.config.connector_url = "' . $visualFilter->config['connectorUrl'] . '";
				Ext.onReady(function() {
					window.setTimeout(function() {
						var tabs = Ext.getCmp("modx-resource-tabs");
						if (tabs) {
							tabs.insert(3, {
								xtype: "visualfilter-panel-page",
								id: "visualfilter-panel-page",
								title: _("visualFilterTab"),
								record: {
									id: ' . $resource->get('id') . '
								}
							});
						}
					}, 10);
				});
			</script>');
        }
        else {
            $modx->controller->addHtml('
			<script type="text/javascript">
				visualFilter.config = ' . $modx->toJSON($visualFilter->config) . ';
				visualFilter.config.connector_url = "' . $visualFilter->config['connectorUrl'] . '";
				Ext.ComponentMgr.onAvailable("modx-resource-tabs", function() {
					this.on("beforerender", function() {
						this.insert(3, {
							xtype: "visualfilter-panel-page",
							id: "visualfilter-panel-page",
							title: _("visualFilterTab"),
							record: {
								id: ' . $resource->get('id') . '
							}
						});
					});
					Ext.apply(this, {
							stateful: true,
							stateId: "modx-resource-tabs-state",
							stateEvents: ["tabchange"],
							getState: function() {return {activeTab:this.items.indexOf(this.getActiveTab())};
						}
					});
				});
			</script>');
        }
        break;
}