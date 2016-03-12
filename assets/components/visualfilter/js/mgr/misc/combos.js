visualFilter.combo.TableCode = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        store: new Ext.data.ArrayStore({
            id: 0,
            fields: ['code', 'title'],
            data: [
                ['resource ', _('vf_code_resource')],
                ['tv ', _('vf_code_tv')],
                ['ms ', _('vf_code_ms')],
                ['msoption ', _('vf_code_msoption')],
                ['msvendor  ', _('vf_code_msvendor')]
            ]
        }),
        mode: 'local',
        displayField: 'title',
        valueField: 'code'
    });
    visualFilter.combo.TableCode.superclass.constructor.call(this,config);
};
Ext.extend(visualFilter.combo.TableCode,MODx.combo.ComboBox);
Ext.reg('visualfilter-combo-table-code', visualFilter.combo.TableCode);


visualFilter.combo.FilterMethod = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        store: new Ext.data.ArrayStore({
            id: 0,
            fields: ['method', 'title'],
            data: [
                ['default', _('vf_filter_method_default')],
                ['number', _('vf_filter_method_number')],
                ['boolean', _('vf_filter_method_boolean')],
                ['parents', _('vf_filter_method_parents')],
                ['categories', _('vf_filter_method_categories')],
                ['grandparents', _('vf_filter_method_grandparents')],
                ['vendors', _('vf_filter_method_vendors')],
                ['fullname', _('vf_filter_method_fullname')],
                ['year', _('vf_filter_method_year')],
                ['month', _('vf_filter_method_month')],
                ['day', _('vf_filter_method_day')],
            ]
        }),
        mode: 'local',
        displayField: 'title',
        valueField: 'method'
    });
    visualFilter.combo.FilterMethod.superclass.constructor.call(this,config);
};
Ext.extend(visualFilter.combo.FilterMethod,MODx.combo.ComboBox);
Ext.reg('visualfilter-combo-filter-method', visualFilter.combo.FilterMethod);
