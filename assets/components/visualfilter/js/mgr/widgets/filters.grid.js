visualFilter.grid.FiltersList = function (config) {
	config = config || {};
	if (!config.id) {
		config.id = 'visualfilter-grid-filters';
	}
	Ext.applyIf(config, {
		url: visualFilter.config.connector_url,
		fields: this.getFields(config),
		columns: this.getColumns(config),
		tbar: this.getTopBar(config),
		sm: new Ext.grid.CheckboxSelectionModel(),
		baseParams: {
			action: 'mgr/filter/getlist'
		},
		listeners: {
            render: {fn: this._initDD, scope: this},
            rowDblClick: function (grid, rowIndex, e) {
				var row = grid.store.getAt(rowIndex);
				this.updateFilter(grid, e, row);
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
		autoHeight: true,
        // Drag & drop
        ddGroup: 'dd',
        enableDragDrop: true
	});
    visualFilter.grid.FiltersList.superclass.constructor.call(this, config);

	// Clear selection on grid refresh
	this.store.on('load', function () {
		if (this._getSelectedIds().length) {
			this.getSelectionModel().clearSelections();
		}
	}, this);
};
Ext.extend(visualFilter.grid.FiltersList, MODx.grid.Grid, {
	windows: {},

    // init Drag & Drop
    _initDD: function(grid) {
        new Ext.dd.DropTarget(grid.el, {
            ddGroup : 'dd',
            copy:   false,
            notifyDrop : function(dd, e, data) {
                var store = grid.store.data.items;
                var target = store[dd.getDragData(e).rowIndex].data;
                var source = store[data.rowIndex].data;
                if ((target.parent == source.parent) && (target.id != source.id)) {
                    dd.el.mask(_('loading'),'x-mask-loading');
                    MODx.Ajax.request({
                        url: visualFilter.config.connector_url,
                        params: {
                            action: 'mgr/filter/sort',
                            source: source.id,
                            target: target.id
                        },
                        listeners: {
                            success: {fn:function(r) {dd.el.unmask();grid.refresh();},scope:grid},
                            failure: {fn:function(r) {dd.el.unmask();},scope:grid}
                        }
                    });
                }
            }
        });
    },

	getMenu: function (grid, rowIndex) {
		var ids = this._getSelectedIds();

		var row = grid.getStore().getAt(rowIndex);
		var menu = visualFilter.utils.getMenu(row.data['actions'], this, ids);

		this.addContextMenuItem(menu);
	},

	createFilter: function (btn, e) {
		var w = MODx.load({
			xtype: 'visualfilter-filter-window-create',
			id: Ext.id(),
			listeners: {
				success: {
					fn: function () {
						this.refresh();
					}, scope: this
				}
			}
		});
		w.reset();
		w.setValues({
            priority: 0,
            filter_method: 'default',
            active: true
        });
		w.show(e.target);
	},

	updateFilter: function (btn, e, row) {
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
				action: 'mgr/filter/get',
				id: id
			},
			listeners: {
				success: {
					fn: function (r) {
						var w = MODx.load({
							xtype: 'visualfilter-filter-window-update',
							id: Ext.id(),
							record: r,
							listeners: {
								success: {
									fn: function () {
										this.refresh();
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

	removeFilter: function (act, btn, e) {
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
				action: 'mgr/filter/remove',
				ids: Ext.util.JSON.encode(ids)
			},
			listeners: {
				success: {
					fn: function (r) {
						this.refresh();
					}, scope: this
				}
			}
		});
		return true;
	},

	getFields: function (config) {
		return ['id', 'priority', 'code', 'field', 'filter_method', 'alias', 'title', 'active', 'actions'];
	},

	getColumns: function (config) {
		return [/*{
			header: _('vf_filter_id'),
			dataIndex: 'id',
			sortable: true,
			width: 60
		},*/{
            header: _('vf_filter_priority'),
            dataIndex: 'priority',
            sortable: true,
            width: 70
        }, {
			header: _('vf_filter_code'),
			dataIndex: 'code',
			sortable: true,
			width: 100
		}, {
			header: _('vf_filter_field'),
			dataIndex: 'field',
			sortable: false,
			width: 200
		}, {
            header: _('vf_filter_filter_method'),
            dataIndex: 'filter_method',
            sortable: false,
            width: 200
        }, {
            header: _('vf_filter_alias'),
            dataIndex: 'alias',
            sortable: false,
            width: 200
        }, {
            header: _('vf_filter_title'),
            dataIndex: 'title',
            sortable: false,
            width: 200
        }, {
			header: _('vf_filter_active'),
			dataIndex: 'active',
			renderer: visualFilter.utils.renderBoolean,
			sortable: true,
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
			text: '<i class="icon icon-plus"></i>&nbsp;' + _('vf_item_create'),
			handler: this.createFilter,
			scope: this
		}, '->', {
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
Ext.reg('visualfilter-grid-filters', visualFilter.grid.FiltersList);
