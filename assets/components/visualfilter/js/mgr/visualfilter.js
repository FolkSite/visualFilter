var visualfilter = function (config) {
	config = config || {};
	visualfilter.superclass.constructor.call(this, config);
};
Ext.extend(visualfilter, Ext.Component, {
	page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}, view: {}, utils: {}
});
Ext.reg('visualfilter', visualfilter);

visualfilter = new visualfilter();