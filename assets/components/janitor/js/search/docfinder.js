/**
 * Loads the panel for DocFinder
 * 
 * @class JN.panel.DocFinder
 * @extends MODx.FormPanel
 * @param {Object} config An object of configuration properties
 * @xtype jn-panel-docfinder
 */
JN.panel.DocFinder = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'jn-panel-docfinder'
		,title: _('menu_search_tab')
        ,bodyStyle: ''
        ,defaults: { collapsible: false ,autoHeight: true }
        ,items: [{
            html: '<iframe style="overflow:auto;width:100%;height:650px;" frameborder="0"  src="'+JN.config.docfinder_url+'"</iframe>'
            ,border: false
            ,cls: 'modx-page-header'
            ,id: 'jn-docfinder-header'
         }]
    });
    JN.panel.DocFinder.superclass.constructor.call(this,config);
};
Ext.extend(JN.panel.DocFinder,MODx.FormPanel);
Ext.reg('jn-panel-docfinder',JN.panel.DocFinder);
