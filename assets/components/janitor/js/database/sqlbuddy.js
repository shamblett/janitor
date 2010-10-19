/**
 * Loads the panel for SQLBuddy
 * 
 * @class JN.panel.SQLBuddy
 * @extends MODx.FormPanel
 * @param {Object} config An object of configuration properties
 * @xtype jn-panel-sqlbuddy
 */
JN.panel.SQLBuddy = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'jn-panel-sqlbuddy'
		,title: _('menu_database_tab')
        ,bodyStyle: ''
        ,defaults: { collapsible: false ,autoHeight: true }
        ,items: [{
            html: '<iframe style="overflow:auto;width:100%;height:650px;" frameborder="0"  src="'+JN.config.sqlbuddy_url+'"</iframe>'
            ,border: false
            ,cls: 'modx-page-header'
            ,id: 'jn-sqlbuddy-header'
         }]
    });
    JN.panel.SQLBuddy.superclass.constructor.call(this,config);
};
Ext.extend(JN.panel.SQLBuddy,MODx.FormPanel);
Ext.reg('jn-panel-sqlbuddy',JN.panel.SQLBuddy);
