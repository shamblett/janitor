/**
 * Loads the panel for Revolution
 *
 * @class JN.panel.Events
 * @extends MODx.FormPanel
 * @param {Object} config An object of configuration properties
 * @xtype jn-panel-events
 */

JN.panel.Events = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'jn-panel-events'
        ,cls: 'modx-resource-tab'
        ,defaults: {
            collapsible: false ,
            autoHeight: true
        }
        ,border: true
        ,title: _('menu_events')
        ,header: true
        ,layout : 'form'
        ,url: JN.config.connector_url
        ,baseParams: {
            action: 'events/events'
        }
        ,items: [
        {
            id: 'jn-ct-events'
            ,html: _('event_desc')

        }]

        /*,buttons: [{
                    text: _('button_site_upgrade')
                    ,handler: this.submit
                    ,scope: this
                }]*/
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

    JN.panel.Events.superclass.constructor.call(this,config);
};
Ext.extend(JN.panel.Events,MODx.FormPanel,{
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
        MODx.msg.alert(_('eventssuccess'));
    }
});
Ext.reg('jn-panel-events',JN.panel.Events);






