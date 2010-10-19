/**
 * Loads the panel for Revolution
 *
 * @class JN.panel.LinkCheck
 * @extends MODx.FormPanel
 * @param {Object} config An object of configuration properties
 * @xtype jn-panel-linkcheck
 */

JN.panel.LinkCheck = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'jn-panel-linkcheck'
        ,cls: 'modx-resource-tab'
        ,defaults: {
            collapsible: false ,
            autoHeight: true
        }
        ,border: true
        ,title: _('menu_linkcheck')
        ,header: true
        ,layout : 'form'
        ,bodyStyle: 'padding: 15px 15px 15px 0;'
        ,url: JN.config.connector_url
        ,baseParams: {
            action: 'linkcheck/linkcheck'
        }
        ,timeout: 300
        ,items: [
        {
            xtype: 'textfield'
            ,name: 'resource'
            ,id: 'jn-ct-resource'
            ,fieldLabel: _('menu_linkcheck_resource')

        },{
             xtype: 'checkbox'
             ,name: 'children'
             ,id: 'jn-ct-children'
             ,inputValue: 1
             ,fieldLabel: _('menu_linkcheck_children')
        },{

             html: '<br/>'
             ,border: false
        },{

            xtype: 'textarea'
            ,name: 'jn-linkcheck-ta-summary'
            ,id: 'jn-linkcheck-ta-summary-id'
            ,hideLabel: true
            ,emptyText: _('summaryarea')
            ,anchor: '97%'
            ,grow: true

        },{

            xtype: 'textarea'
            ,name: 'jn-linkcheck-ta'
            ,id: 'jn-linkcheck-ta-id'
            ,emptyText: _('reportarea')
            ,hideLabel: true
            ,anchor: '97%'
            ,grow: true
        }]

        ,buttons: [{
                    text: _('button_linkcheck')
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
                    ,'failure' : {
                    fn: this.failure
                    ,scope:this
                    }
                }
    });

    JN.panel.LinkCheck.superclass.constructor.call(this,config);
};
Ext.extend(JN.panel.LinkCheck,MODx.FormPanel,{
    initialized: false
    ,setup: function() {
        /* do any post-render actions here */
        this.initialized = true;
        this.fireEvent('ready');
    }

    ,beforeSubmit: function(o) {
        
        /* Change the default waiting message */
        o.config.saveMsg = _('linkcheck_checking');

        /* Clear the text areas */
        var summaryarea = Ext.getCmp('jn-linkcheck-ta-summary-id');
        summaryarea.setValue("Your link check is running, please wait....");
        var text = ' ';
        var textAreaLog = Ext.getCmp('jn-linkcheck-ta-id');
        textAreaLog.setValue(text);

        Ext.apply(o.form.baseParams,{

            });
    }

    ,success: function(result) {

      /* Update the text areas */
      var summary = result.result.object.summary;
      var textAreaSummary = Ext.getCmp('jn-linkcheck-ta-summary-id');
      textAreaSummary.setValue(summary);
      var text = result.result.object.log;
      var textAreaLog = Ext.getCmp('jn-linkcheck-ta-id');
      textAreaLog.setValue(text);
      
    }

    ,failure: function() {

        MODx.msg.alert(_('linkcheckfailed'));

    }
});
Ext.reg('jn-panel-linkcheck',JN.panel.LinkCheck);


