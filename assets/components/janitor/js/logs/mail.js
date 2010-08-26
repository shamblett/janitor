/**
 * Loads the panel for Revolution
 *
 * @class JN.panel.LogsMail
 * @extends MODx.FormPanel
 * @param {Object} config An object of configuration properties
 * @xtype jn-panel-logs-mail
 */

JN.panel.LogsMail = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'jn-panel-logs-mail'
        ,defaults: {
            collapsible: false ,
            autoHeight: true
        }
        ,border: true
        ,header: true
        ,title: _('menu_logs_mail')
        ,layout : 'form'
        ,url: JN.config.connector_url
        ,baseParams: {
            action: 'logs/mail'
        }
        ,items: [{
             xtype: 'textfield'
             ,name: 'mail-account'
             ,id: 'jn-ct-mail-account'
             ,width: 400
             ,fieldLabel: _('log_mail_account')
             ,border: true
        },{
            id: 'jn-log-mail-fieldset'
            ,xtype: 'fieldset'
            ,width: 400
            ,items: [{
                xtype: 'radiogroup'
                ,labelSeparator: ''
                ,width: 300
                ,items: [{
                    id: 'jn-ct-log-mail-activate-log'
                    ,xtype: 'radio'
                    ,boxLabel: _('activate_log_mail')
                    ,inputValue: 'activate'
                    ,name: 'mail-log'
                    ,checked: true
                },{
                    id: 'jn-ct-log-mail-deactivate-log'
                    ,xtype: 'radio'
                    ,boxLabel: _('deactivate_log_mail')
                    ,inputValue: 'deactivate'
                    ,name: 'mail-log'

                }]
            }]
        }]

        ,buttons: [{
                    text: _('button_log_mail')
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
                    ,scope:this
                    }
                    ,'postReady' : {
                    fn: this.postReady
                    ,scope:this
                    }

                }
    });

    JN.panel.LogsMail.superclass.constructor.call(this,config);
};
Ext.extend(JN.panel.LogsMail,MODx.FormPanel,{
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

    ,postReady: function(o) {
        MODx.Ajax.request({
                    url: JN.config.connector_url+'?action=logs/maillogstatus'
                    ,method: 'post'
                    ,scope: this
                    ,listeners: {
                        'success':{fn:function(r) {
                                    var state = r.object;
                                    Ext.getCmp("jn-ct-mail-account").setRawValue(state.account);
                                    if ( state.status == 1 ) {
                                        Ext.getCmp("jn-ct-log-mail-deactivate-log").setValue(true);
                                    }
                        },scope:this}
                    }
                });
    }

    ,success: function() {
        MODx.msg.alert(_('maillogsuccess'));
    }
});
Ext.reg('jn-panel-logs-mail',JN.panel.LogsMail);




