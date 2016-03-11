visualFilter.window.getFilterWindowFields = function (config, isCreate) {
    var availableFields = {
        tab_general: {
            priority: {xtype: 'numberfield', decimalPrecision: 0, anchor: '99%', allowBlank: false },
            code: {xtype: 'textfield', anchor: '99%', allowBlank: false },
            field: {xtype: 'textfield', anchor: '99%', allowBlank: false },
            method: {xtype: 'textfield', anchor: '99%', allowBlank: false },
            alias: {xtype: 'textfield', anchor: '99%', allowBlank: true },
            active: {xtype: 'combo-boolean', renderer: 'boolean', anchor: '99%', allowBlank: true }
        }
    };

    var tabs = [];

    for(var tab_name in availableFields) {
        var fields = [];
        for (var field in availableFields[tab_name]){
            Ext.applyIf(availableFields[tab_name][field], {
                fieldLabel: _('vf_filter_' + field),
                name: field,
                id: config.id + '-' + field
            });
            fields.push(availableFields[tab_name][field]);
        }

        var tab = {
            title: _('vf_filter_' + tab_name),
            layout: 'anchor',
            items: [{
                layout: 'form',
                cls: 'modx-panel',
                items: [fields]
            }]
        };
        tabs.push(tab);
    }

    var result = [];
    if(!isCreate){
        result.push({ xtype: 'hidden', name: 'id', id: config.id + '-id' });
    }

    result.push({
        xtype: 'modx-tabs',
        defaults: {border: false, autoHeight: true},
        deferredRender: false,
        border: true,
        hideMode: 'offsets',
        items: [tabs]
    });

    return result;
}

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
		fields: visualFilter.window.getFilterWindowFields(config, true),
		keys: [{
			key: Ext.EventObject.ENTER, shift: true, fn: function () {
				this.submit()
			}, scope: this
		}]
	});
    visualFilter.window.CreateFilter.superclass.constructor.call(this, config);
};
Ext.extend(visualFilter.window.CreateFilter, MODx.Window, {});
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
		fields: visualFilter.window.getFilterWindowFields(config, false),
		keys: [{
			key: Ext.EventObject.ENTER, shift: true, fn: function () {
				this.submit()
			}, scope: this
		}]
	});
    visualFilter.window.UpdateFilter.superclass.constructor.call(this, config);
};
Ext.extend(visualFilter.window.UpdateFilter, MODx.Window, {});
Ext.reg('visualfilter-filter-window-update', visualFilter.window.UpdateFilter);