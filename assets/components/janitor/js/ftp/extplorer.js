/**
 * Loads the panel for Extplorer
 *
 * @class JN.panel.Extplorer
 * @extends MODx.FormPanel
 * @param {Object} config An object of configuration properties
 * @xtype jn-panel-extplorer
 */
JN.panel.Extplorer = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'jn-panel-extplorer'
		,title: _('menu_ftp_tab')
        ,bodyStyle: ''
        ,defaults: { collapsible: false ,autoHeight: true }
        ,items: [{
            html: '<iframe style="overflow:auto;width:100%;height:650px;" frameborder="0"  src="'+JN.config.extplorer_url+'"</iframe>'
            ,border: false
            ,cls: 'modx-page-header'
            ,id: 'jn-extplorer-header'
         }]
    });
    JN.panel.Extplorer.superclass.constructor.call(this,config);
};
Ext.extend(JN.panel.Extplorer,MODx.FormPanel);
Ext.reg('jn-panel-extplorer',JN.panel.Extplorer);


