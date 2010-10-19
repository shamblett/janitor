/**
 * Loads the panel for BackupPro
 * 
 * @class JN.panel.BackupPro
 * @extends MODx.FormPanel
 * @param {Object} config An object of configuration properties
 * @xtype jn-panel-backuppro
 */
JN.panel.BackupPro = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'jn-panel-backuppro'
		,title: _('menu_backup_tab')
        ,bodyStyle: ''
        ,defaults: { collapsible: false ,autoHeight: true }
        ,items: [{
            html: '<iframe style="overflow:auto;width:100%;height:650px;" frameborder="0"  scrolling="yes" src="'+JN.config.backuppro_url+'"></iframe>'
            ,border: false
            ,cls: 'modx-page-header'
            ,id: 'jn-backuppro-header'
         }]
    });
    JN.panel.BackupPro.superclass.constructor.call(this,config);
};
Ext.extend(JN.panel.BackupPro,MODx.FormPanel);
Ext.reg('jn-panel-backuppro',JN.panel.BackupPro);
