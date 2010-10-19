Ext.namespace('JN');
/**
 * The base Janitor class
 *
 * @class JN
 * @extends Ext.Component
 * @param {Object} config An object of config properties
 * @xtype janitor
 */
JN = function(config) {
    config = config || {};
    Ext.applyIf(config,{
	base_url: MODx.config.assets_url+'components/janitor/'
        ,connector_url: MODx.config.assets_url+'components/janitor/connector.php'
        ,core_path : MODx.config.core_path
        ,sqlbuddy_url: MODx.config.assets_url+'components/janitor/sqlbuddy'
        ,backuppro_url: MODx.config.assets_url+'components/janitor/phpmybackuppro'
        ,extplorer_url: MODx.config.assets_url+'components/janitor/extplorer'
        ,docfinder_url: MODx.config.assets_url+'components/janitor/docfinder'
    });
    JN.superclass.constructor.call(this,config);
    this.config = config;
};
Ext.extend(JN,Ext.Component,{
    config: {}
    ,panel: {} ,page: {} ,grid: {}, tree: {}
});
Ext.reg('janitor',JN);
JN = new JN();


Ext.onReady(function() {
    MODx.load({
        xtype: 'jn-page-home'
    });
});

JN.page.Home = function(config) {
    config = config || {};
    Ext.applyIf(config,{
		html: '<h2>'+_('janitor')+'</h2>'
		,cls: 'modx-page-header'
		,renderTo: 'jn-panel-header-div'
        ,components: [{
            xtype: 'jn-panel-home'
            ,renderTo: 'jn-panel-home-div'
        }]
    });
    JN.page.Home.superclass.constructor.call(this,config);
};
Ext.extend(JN.page.Home,MODx.Component);
Ext.reg('jn-page-home',JN.page.Home);


JN.panel.Home = function(config) {
    config = config || {};
    Ext.apply(config,{
        id: 'jn-panel-home'
        ,border: false
        ,deferredRender: false
        ,defaults: { autoHeight: true}
       ,items: [{

                xtype: 'jn-panel-welcome'
          },{
                xtype: 'jn-panel-sqlbuddy'
          },{
                xtype: 'jn-panel-backuppro'
          },{
                xtype: 'jn-panel-extplorer'
          },{
		xtype: 'jn-panel-docfinder'
          },{
                title: _('menu_log_tab')
                ,items: [{
                            xtype: 'jn-panel-logs'
                        },{
                            html: '<br/><br/>'
                            ,border: false
                        },{
                            xtype: 'jn-panel-logs-mail'
                        }]
            },{
                 title: _('menu_upgrade_tab')
                 ,items: [{
                    xtype: 'jn-panel-upgrade'
                 }]
            },{
                
                 title: _('menu_events_tab')
                 ,items: [{
                    xtype: 'jn-panel-events'
                 }]
             },{

                 title: _('menu_linkcheck_tab')
                 ,items: [{
                    xtype: 'jn-panel-linkcheck'
                 }]
            }]
    });
    JN.panel.Home.superclass.constructor.call(this,config);
};
Ext.extend(JN.panel.Home,MODx.Tabs);
Ext.reg('jn-panel-home',JN.panel.Home);
