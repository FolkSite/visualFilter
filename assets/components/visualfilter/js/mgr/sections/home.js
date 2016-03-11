visualfilter.page.Home = function (config) {
	config = config || {};
	Ext.applyIf(config, {
		components: [{
			xtype: 'visualfilter-panel-home', renderTo: 'visualfilter-panel-home-div'
		}]
	});
	visualfilter.page.Home.superclass.constructor.call(this, config);
};
Ext.extend(visualfilter.page.Home, MODx.Component);
Ext.reg('visualfilter-page-home', visualfilter.page.Home);