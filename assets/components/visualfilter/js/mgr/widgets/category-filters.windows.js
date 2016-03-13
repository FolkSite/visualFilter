visualFilter.window.GetCategoryFilterWindowFields = function (config, isCreate) {
    var availableFields = {
        category_id: {xtype: 'hidden', anchor: '99%', allowBlank: false },
        filter_id: {xtype: 'textfield', hiddenName: 'filter', anchor: '99%', allowBlank: false }
    };

    var fields = [];
    for (var field in availableFields){
        Ext.applyIf(availableFields[field], {
            fieldLabel: _('vf_category_filter_' + field),
            name: field,
            id: config.id + '-' + field
        });
        fields.push(availableFields[field]);
    }

    if(!isCreate){
        fields.push({ xtype: 'hidden', name: 'id', id: config.id + '-id' });
    }
    return fields;
};

visualFilter.window.CreateCategoryFilter = function (config) {
	config = config || {};
	if (!config.id) {
		config.id = 'visualfilter-category-filter-window-create';
	}
	Ext.applyIf(config, {
		title: _('vf_category_filter_create'),
		width: 550,
		autoHeight: true,
		url: visualFilter.config.connector_url,
		action: 'mgr/category-filter/create',
		fields: visualFilter.window.GetCategoryFilterWindowFields(config, true),
		keys: [{
			key: Ext.EventObject.ENTER, shift: true, fn: function () {
				this.submit()
			}, scope: this
		}]
	});
    visualFilter.window.CreateCategoryFilter.superclass.constructor.call(this, config);
};
Ext.extend(visualFilter.window.CreateCategoryFilter, MODx.Window, {});
Ext.reg('visualfilter-category-filter-window-create', visualFilter.window.CreateCategoryFilter);


visualFilter.window.UpdateCategoryFilter = function (config) {
	config = config || {};
	if (!config.id) {
		config.id = 'visualfilter-category-filter-window-update';
	}
	Ext.applyIf(config, {
		title: _('vf_category_filter_update'),
		width: 550,
		autoHeight: true,
		url: visualFilter.config.connector_url,
		action: 'mgr/category-filter/update',
		fields: visualFilter.window.GetCategoryFilterWindowFields(config, false),
		keys: [{
			key: Ext.EventObject.ENTER, shift: true, fn: function () {
				this.submit()
			}, scope: this
		}]
	});
    visualFilter.window.UpdateCategoryFilter.superclass.constructor.call(this, config);
};
Ext.extend(visualFilter.window.UpdateCategoryFilter, MODx.Window, {});
Ext.reg('visualfilter-category-filter-window-update', visualFilter.window.UpdateCategoryFilter);