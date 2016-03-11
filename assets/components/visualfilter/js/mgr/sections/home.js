visualFilter.page.Home = function (config) {
	config = config || {};
	Ext.applyIf(config, {
		components: [{
			xtype: 'visualfilter-panel-home', renderTo: 'visualfilter-panel-home-div'
		}]
	});
    visualFilter.page.Home.superclass.constructor.call(this, config);
};
Ext.extend(visualFilter.page.Home, MODx.Component);
Ext.reg('visualfilter-page-home', visualFilter.page.Home);