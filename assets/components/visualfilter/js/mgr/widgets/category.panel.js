visualFilter.panel.Category = function (config) {
    config = config || {};
    Ext.apply(config, {
        baseCls: 'modx-formpanel',
        layout: 'anchor',

        hideMode: 'offsets',
        items: [{
                html: _('vf_page_intro_msg'),
                cls: 'panel-desc',
                style: 'margin-bottom: 15px'
            }, {
                xtype: 'visualfilter-grid-category-filters',
                cls: 'main-wrapper',
                record: config.record
            }
        ]
    });
    visualFilter.panel.Category.superclass.constructor.call(this, config);
};
Ext.extend(visualFilter.panel.Category, MODx.Panel);
Ext.reg('visualfilter-panel-category', visualFilter.panel.Category);