/**
 * Loads the panel for Revolution
 *
 * @class JN.panel.Logs
 * @extends MODx.FormPanel
 * @param {Object} config An object of configuration properties
 * @xtype jn-panel-logs
 */

JN.panel.Logs = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'jn-panel-logs'
        ,cls: 'modx-resource-tab'
        ,defaults: {
            collapsible: false ,
            autoHeight: true
        }
        ,border: false
        ,title: _('menu_logs')
        ,header: true
        ,layout : 'form'
        ,bodyStyle: 'padding: 15px 15px 15px 0;'
        ,url: JN.config.connector_url
        ,baseParams: {
            action: 'logs/logs'
        }
        ,items: [
        {
            id: 'jn-log-fieldset'
            ,xtype: 'fieldset'
            ,border: false
            ,items: [{
                xtype: 'radiogroup'
                ,labelSeparator: ''
                ,columns: 1
                ,border: false
                ,items: [{
                    id: 'jn-ct-revolution-manager-log'
                    ,xtype: 'checkbox'
                    ,boxLabel: _('manager_log')
                    ,name: 'manager'
                    ,checked: false
                },{
                    id: 'jn-ct-revolution-event-log'
                    ,xtype: 'checkbox'
                    ,boxLabel: _('event_log')
                    ,name: 'event'
                    ,checked: false
                }]
            }]
        }]

        ,buttons: [{
                    text: _('button_truncate_logs')
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

    JN.panel.Logs.superclass.constructor.call(this,config);
};
Ext.extend(JN.panel.Logs,MODx.FormPanel,{
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
        MODx.msg.alert(_('truncationsuccess'));
    }
});
Ext.reg('jn-panel-logs',JN.panel.Logs);


