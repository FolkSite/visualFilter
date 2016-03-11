visualFilter.panel.Home = function (config) {
	config = config || {};
	Ext.apply(config, {
		baseCls: 'modx-formpanel',
		layout: 'anchor',
		/*
		 stateful: true,
		 stateId: 'visualfilter-panel-home',
		 stateEvents: ['tabchange'],
		 getState:function() {return {activeTab:this.items.indexOf(this.getActiveTab())};},
		 */
		hideMode: 'offsets',
		items: [{
			html: '<h2>' + _('visualFilter') + '</h2>',
			cls: '',
			style: {margin: '15px 0'}
		}, {
			xtype: 'modx-tabs',
			defaults: {border: false, autoHeight: true},
			border: true,
			hideMode: 'offsets',
			items: [{
				title: _('vf_filters'),
				layout: 'anchor',
				items: [{
					html: _('vf_intro_msg'),
					cls: 'panel-desc'
				}, {
					xtype: 'visualfilter-grid-filters',
					cls: 'main-wrapper'
				}]
			}]
		}]
	});
    visualFilter.panel.Home.superclass.constructor.call(this, config);
};
Ext.extend(visualFilter.panel.Home, MODx.Panel);
Ext.reg('visualfilter-panel-home', visualFilter.panel.Home);
