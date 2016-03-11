var visualFilter = function (config) {
	config = config || {};
    visualFilter.superclass.constructor.call(this, config);
};
Ext.extend(visualFilter, Ext.Component, {
	page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}, view: {}, utils: {}
});
Ext.reg('visualFilter', visualFilter);

visualFilter = new visualFilter();