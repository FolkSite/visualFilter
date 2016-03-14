visualFilter.grid.PageFilters = function (config) {
	config = config || {};
	if (!config.id) {
		config.id = 'visualfilter-grid-category-filters';
	}
    config.record = config.record || {};
    config.record.id = config.record.id || 0;
	Ext.applyIf(config, {
		url: visualFilter.config.connector_url,
		fields: this.getFields(config),
		columns: this.getColumns(config),
		tbar: this.getTopBar(config),
		sm: new Ext.grid.CheckboxSelectionModel(),
		baseParams: {
			action: 'mgr/category-filter/getlist',
            category_id: config.record.id
		},
		listeners: {
			rowDblClick: function (grid, rowIndex, e) {
				var row = grid.store.getAt(rowIndex);
				this.updateCategoryFilter(grid, e, row);
			}
		},
		viewConfig: {
			forceFit: true,
			enableRowBody: true,
			autoFill: true,
			showPreview: true,
			scrollOffset: 0,
			getRowClass: function (rec, ri, p) {
				return !rec.data.active
					? 'visualfilter-grid-row-disabled'
					: '';
			}
		},
		paging: true,
		remoteSort: true,
		autoHeight: true
	});
    visualFilter.grid.PageFilters.superclass.constructor.call(this, config);

	// Clear selection on grid refresh
	this.store.on('load', function () {
		if (this._getSelectedIds().length) {
			this.getSelectionModel().clearSelections();
		}
	}, this);
};
Ext.extend(visualFilter.grid.PageFilters, MODx.grid.Grid, {
	windows: {},

	getMenu: function (grid, rowIndex) {
		var ids = this._getSelectedIds();

		var row = grid.getStore().getAt(rowIndex);
		var menu = visualFilter.utils.getMenu(row.data['actions'], this, ids);

		this.addContextMenuItem(menu);
	},

	createCategoryFilter: function (btn, e) {
		var w = MODx.load({
			xtype: 'visualfilter-category-filter-window-create',
			id: Ext.id(),
			listeners: {
				success: {
					fn: function () {
						this.refresh();
                        MODx.fireResourceFormChange();
					}, scope: this
				}
			}
		});
		w.reset();
		w.setValues({
            category_id: this.config.record.id
        });
		w.show(e.target);
	},
    cloneCategoryFilters: function (btn, e) {
        MODx.msg.confirm({
            title: _('vf_category_filters_clone'),
            text: _('vf_category_filters_clone_confirm'),
            url: this.config.url,
            params: {
                action: 'mgr/category-filter/clone',
                category_id: this.config.record.id
            },
            listeners: {
                success: {
                    fn: function (r) {
                        this.refresh();
                        MODx.fireResourceFormChange();
                    }, scope: this
                }
            }
        });
    },
    fillCategoryFilters: function (btn, e) {
        MODx.msg.confirm({
            title: _('vf_category_filters_fill'),
            text: _('vf_category_filters_fill_confirm'),
            url: this.config.url,
            params: {
                action: 'mgr/category-filter/fill',
                category_id: this.config.record.id
            },
            listeners: {
                success: {
                    fn: function (r) {
                        this.refresh();
                        MODx.fireResourceFormChange();
                    }, scope: this
                }
            }
        });
    },

	updateCategoryFilter: function (btn, e, row) {
		if (typeof(row) != 'undefined') {
			this.menu.record = row.data;
		}
		else if (!this.menu.record) {
			return false;
		}
		var id = this.menu.record.id;

		MODx.Ajax.request({
			url: this.config.url,
			params: {
				action: 'mgr/category-filter/get',
				id: id
			},
			listeners: {
				success: {
					fn: function (r) {
						var w = MODx.load({
							xtype: 'visualfilter-category-filter-window-update',
							id: Ext.id(),
							record: r,
							listeners: {
								success: {
									fn: function () {
										this.refresh();
                                        MODx.fireResourceFormChange();
									}, scope: this
								}
							}
						});
						w.reset();
						w.setValues(r.object);
						w.show(e.target);
					}, scope: this
				}
			}
		});
	},

	removeCategoryFilter: function (act, btn, e) {
		var ids = this._getSelectedIds();
		if (!ids.length) {
			return false;
		}
		MODx.msg.confirm({
			title: ids.length > 1
				? _('vf_items_remove')
				: _('vf_item_remove'),
			text: ids.length > 1
				? _('vf_items_remove_confirm')
				: _('vf_item_remove_confirm'),
			url: this.config.url,
			params: {
				action: 'mgr/category-filter/remove',
				ids: Ext.util.JSON.encode(ids)
			},
			listeners: {
				success: {
					fn: function (r) {
						this.refresh();
                        MODx.fireResourceFormChange();
					}, scope: this
				}
			}
		});
		return true;
	},

	getFields: function (config) {
		return ['id', 'priority', 'filter_title', 'filter_value', 'active', 'actions'];
	},

	getColumns: function (config) {
		return [/*{
			header: _('vf_filter_id'),
			dataIndex: 'id',
			sortable: true,
			width: 60
		},*/{
            header: _('vf_category_filter_priority'),
            dataIndex: 'priority',
            sortable: false,
            width: 70
        }, {
			header: _('vf_category_filter_title'),
			dataIndex: 'filter_title',
			sortable: false,
			width: 100
		}, {
			header: _('vf_category_filter_value'),
			dataIndex: 'filter_value',
			sortable: false,
			width: 200
		}, {
			header: _('vf_category_filter_active'),
			dataIndex: 'active',
			renderer: visualFilter.utils.renderBoolean,
			sortable: false,
			width: 70
		}, {
			header: _('vf_grid_actions'),
			dataIndex: 'actions',
			renderer: visualFilter.utils.renderActions,
			sortable: false,
			width: 100,
			id: 'actions'
		}];
	},

	getTopBar: function (config) {
		return [{
			text: '<i class="icon icon-plus"></i>&nbsp;' + _('vf_category_filters_action_add'),
			handler: this.createCategoryFilter,
			scope: this
		},{
            text: '<i class="icon icon-level-up"></i>&nbsp;' + _('vf_category_filters_action_clone'),
            handler: this.cloneCategoryFilters,
            scope: this
        },{
            text: '<i class="icon icon-th-list"></i>&nbsp;' + _('vf_category_filters_action_fill'),
            handler: this.fillCategoryFilters,
            scope: this
        },
            '->',
        {
			xtype: 'textfield',
			name: 'query',
			width: 200,
			id: config.id + '-search-field',
			emptyText: _('vf_grid_search'),
			listeners: {
				render: {
					fn: function (tf) {
						tf.getEl().addKeyListener(Ext.EventObject.ENTER, function () {
							this._doSearch(tf);
						}, this);
					}, scope: this
				}
			}
		}, {
			xtype: 'button',
			id: config.id + '-search-clear',
			text: '<i class="icon icon-times"></i>',
			listeners: {
				click: {fn: this._clearSearch, scope: this}
			}
		}];
	},

	onClick: function (e) {
		var elem = e.getTarget();
		if (elem.nodeName == 'BUTTON') {
			var row = this.getSelectionModel().getSelected();
			if (typeof(row) != 'undefined') {
				var action = elem.getAttribute('action');
				if (action == 'showMenu') {
					var ri = this.getStore().find('id', row.id);
					return this._showMenu(this, ri, e);
				}
				else if (typeof this[action] === 'function') {
					this.menu.record = row.data;
					return this[action](this, e);
				}
			}
		}
		return this.processEvent('click', e);
	},

	_getSelectedIds: function () {
		var ids = [];
		var selected = this.getSelectionModel().getSelections();

		for (var i in selected) {
			if (!selected.hasOwnProperty(i)) {
				continue;
			}
			ids.push(selected[i]['id']);
		}

		return ids;
	},

	_doSearch: function (tf, nv, ov) {
		this.getStore().baseParams.query = tf.getValue();
		this.getBottomToolbar().changePage(1);
		this.refresh();
	},

	_clearSearch: function (btn, e) {
		this.getStore().baseParams.query = '';
		Ext.getCmp(this.config.id + '-search-field').setValue('');
		this.getBottomToolbar().changePage(1);
		this.refresh();
	}
});
Ext.reg('visualfilter-grid-category-filters', visualFilter.grid.PageFilters);
