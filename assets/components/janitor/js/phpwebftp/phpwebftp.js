/**
 * Loads the panel for PHPWebFTP
 * 
 * @class JN.panel.PHPWebFTP
 * @extends MODx.FormPanel
 * @param {Object} config An object of configuration properties
 * @xtype jn-panel-phpwebftp
 */
JN.panel.PHPWebFTP = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'jn-panel-phpwebftp'
		,title: _('menu_phpwebftp_tab')
        ,bodyStyle: ''
        ,defaults: { collapsible: false ,autoHeight: true }
        ,items: [{
            html: '<iframe style="overflow:auto;width:100%;height:100%;" frameborder="0"  src="'+JN.config.phpwebftp_url+'"</iframe>'
            ,border: false
            ,cls: 'modx-page-header'
            ,id: 'jn-phpwebftp-header'
         }]
    });
    JN.panel.PHPWebFTP.superclass.constructor.call(this,config);
};
Ext.extend(JN.panel.PHPWebFTP,MODx.FormPanel);
Ext.reg('jn-panel-phpwebftp',JN.panel.PHPWebFTP);
