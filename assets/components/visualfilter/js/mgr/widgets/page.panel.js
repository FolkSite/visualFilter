visualFilter.panel.Page = function (config) {
    config = config || {};
    Ext.apply(config, {
        baseCls: 'modx-formpanel',
        layout: 'anchor',

        hideMode: 'offsets',
        items: []
    });
    visualFilter.panel.Page.superclass.constructor.call(this, config);
};
Ext.extend(visualFilter.panel.Page, MODx.Panel);
Ext.reg('visualfilter-panel-page', visualFilter.panel.Page);