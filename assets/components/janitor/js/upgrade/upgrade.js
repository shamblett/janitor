/**
 * Loads the panel for Revolution
 *
 * @class JN.panel.Upgrade
 * @extends MODx.FormPanel
 * @param {Object} config An object of configuration properties
 * @xtype jn-panel-upgrade
 */

JN.panel.Upgrade = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'jn-panel-upgrade'
        ,cls: 'modx-resource-tab'
        ,defaults: {
            collapsible: false ,
            autoHeight: true
        }
        ,border: true
        ,title: _('menu_upgrade')
        ,header: true
        ,layout : 'form'
        ,bodyStyle: 'padding: 15px 15px 15px 0;'
        ,url: JN.config.connector_url
        ,baseParams: {
            action: 'upgrade/upgrade'
        }
        ,items: [
        {
            id: 'jn-ct-upgrade'
            ,html: _('upgrade_steps')+_('upgrade_steps_list')
            
        }]

        ,buttons: [{
                    text: _('button_site_upgrade')
                    ,handler: this.submit
                    ,scope: this
                }]
        ,listeners: {
                    'setup': {
                    fn:this.setup
                    ,scope:this
                    }
                    ,'beforeSubmit': {
                    fn:this.beforeSubmit
                    ,scope:this
                    }
                    ,'success' : {
                    fn: this.success
                    ,scope:this}

                }
    });

    JN.panel.Upgrade.superclass.constructor.call(this,config);
};
Ext.extend(JN.panel.Upgrade,MODx.FormPanel,{
    initialized: false
    ,setup: function() {
        /* do any post-render actions here */
        this.initialized = true;
        this.fireEvent('ready');
    }

    ,beforeSubmit: function(o) {
        /* do any pre-submit actions here */
        Ext.apply(o.form.baseParams,{

            });
    }

    ,success: function() {
        MODx.msg.alert(_('upgradesuccess'));
    }
});
Ext.reg('jn-panel-upgrade',JN.panel.Upgrade);




