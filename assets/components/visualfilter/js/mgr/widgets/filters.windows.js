visualFilter.window.CreateFilter = function (config) {
	config = config || {};
	if (!config.id) {
		config.id = 'visualfilter-filter-window-create';
	}
	Ext.applyIf(config, {
		title: _('vf_filter_create'),
		width: 550,
		autoHeight: true,
		url: visualFilter.config.connector_url,
		action: 'mgr/filter/create',
		fields: this.getFields(config),
		keys: [{
			key: Ext.EventObject.ENTER, shift: true, fn: function () {
				this.submit()
			}, scope: this
		}]
	});
    visualFilter.window.CreateFilter.superclass.constructor.call(this, config);
};
Ext.extend(visualFilter.window.CreateFilter, MODx.Window, {

	getFields: function (config) {
		return [{
			xtype: 'textfield',
			fieldLabel: _('vf_filter_name'),
			name: 'name',
			id: config.id + '-name',
			anchor: '99%',
			allowBlank: false
		}, {
			xtype: 'textarea',
			fieldLabel: _('vf_filter_description'),
			name: 'description',
			id: config.id + '-description',
			height: 150,
			anchor: '99%'
		}, {
			xtype: 'xcheckbox',
			boxLabel: _('vf_filter_active'),
			name: 'active',
			id: config.id + '-active',
			checked: true
		}];
	},

	loadDropZones: function() {
	}

});
Ext.reg('visualfilter-filter-window-create', visualFilter.window.CreateFilter);


visualFilter.window.UpdateFilter = function (config) {
	config = config || {};
	if (!config.id) {
		config.id = 'visualfilter-filter-window-update';
	}
	Ext.applyIf(config, {
		title: _('vf_filter_update'),
		width: 550,
		autoHeight: true,
		url: visualFilter.config.connector_url,
		action: 'mgr/filter/update',
		fields: this.getFields(config),
		keys: [{
			key: Ext.EventObject.ENTER, shift: true, fn: function () {
				this.submit()
			}, scope: this
		}]
	});
    visualFilter.window.UpdateFilter.superclass.constructor.call(this, config);
};
Ext.extend(visualFilter.window.UpdateFilter, MODx.Window, {

	getFields: function (config) {
		return [{
			xtype: 'hidden',
			name: 'id',
			id: config.id + '-id'
		}, {
			xtype: 'textfield',
			fieldLabel: _('vf_filter_name'),
			name: 'name',
			id: config.id + '-name',
			anchor: '99%',
			allowBlank: false
		}, {
			xtype: 'textarea',
			fieldLabel: _('vf_filter_description'),
			name: 'description',
			id: config.id + '-description',
			anchor: '99%',
			height: 150
		}, {
			xtype: 'xcheckbox',
			boxLabel: _('vf_filter_active'),
			name: 'active',
			id: config.id + '-active'
		}];
	},

	loadDropZones: function() {
	}

});
Ext.reg('visualfilter-filter-window-update', visualFilter.window.UpdateFilter);