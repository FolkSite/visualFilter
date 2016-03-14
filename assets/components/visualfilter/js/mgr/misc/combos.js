visualFilter.combo.TableCode = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        store: new Ext.data.ArrayStore({
            id: 0,
            fields: ['code', 'title'],
            data: [
                ['resource', _('vf_code_resource')],
                ['tv', _('vf_code_tv')],
                ['ms', _('vf_code_ms')],
                ['msoption', _('vf_code_msoption')]
            ]
        }),
        mode: 'local',
        valueField: 'code',
        displayField: 'title'
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
        valueField: 'method',
        displayField: 'title'
    });
    visualFilter.combo.FilterMethod.superclass.constructor.call(this,config);
};
Ext.extend(visualFilter.combo.FilterMethod,MODx.combo.ComboBox);
Ext.reg('visualfilter-combo-filter-method', visualFilter.combo.FilterMethod);



visualFilter.combo.Filter = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        fields: ['id','title']
        ,valueField: 'id'
        ,displayField: 'title'
        ,allowBlank: true
        ,url: visualFilter.config.connector_url
        ,baseParams: {
            action: 'mgr/filter/getcombolist'
            ,combo: 1
            ,id: config.value
        }
        ,pageSize: 20
        ,width: 300
        ,editable: true
    });
    visualFilter.combo.Filter.superclass.constructor.call(this,config);
};
Ext.extend(visualFilter.combo.Filter, MODx.combo.ComboBox);
Ext.reg('visualfilter-combo-filter',visualFilter.combo.Filter);
