Ext.onReady(function() {
	visualfilter.config.connector_url = OfficeConfig.actionUrl;

	var grid = new visualfilter.panel.Home();
	grid.render('office-visualfilter-wrapper');

	var preloader = document.getElementById('office-preloader');
	if (preloader) {
		preloader.parentNode.removeChild(preloader);
	}
});