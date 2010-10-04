/**
 * Loads the welcome panel
 *
 * @class JN.panel.Welcome
 * @extends MODx.FormPanel
 * @param {Object} config An object of configuration properties
 * @xtype jn-panel-welcome
 */
JN.panel.Welcome = function(config) {
    config = config || {};
    var text1 = _('welcome_text_1') + '<img src="'+MODx.config.assets_url+'components/janitor/js/images/janitor.jpg' + '"align="left" height="500">';
    var text2 = text1 + _('welcome_text_2') + _('welcome_text_3') + _('welcome_text_4') + _('welcome_text_5') + _('welcome_text_6');
    var welcometext = text2 +  _('welcome_text_footer');
    Ext.applyIf(config,{
        id: 'jn-panel-welcome'
	,title: _('menu_welcome_tab')
        ,bodyStyle: ''
        ,defaults: { collapsible: false ,autoHeight: true }
        ,items: [{
            html:  welcometext
            ,border: false
            ,cls: 'modx-page-header'
            ,id: 'jn-welcome-header'
         }]
    });
    JN.panel.Welcome.superclass.constructor.call(this,config);
};
Ext.extend(JN.panel.Welcome,MODx.FormPanel);
Ext.reg('jn-panel-welcome',JN.panel.Welcome);

