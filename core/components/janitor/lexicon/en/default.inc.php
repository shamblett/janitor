<?php
/**
 * Janitor lexicon
 *
 * @category  Miantenance
 * @author    S. Hamblett <steve.hamblett@linux.com>
 * @copyright 2009 S. Hamblett
 * @license   GPLv3 http://www.gnu.org/licenses/gpl.html
 * @link      none
 * @language en
 *
 * @package   janitor
 * @subpackage lexicon
 */
$_lang['janitor'] = 'Janitor';
$_lang['menu_janitor'] = 'Janitor';
$_lang['menu_welcome_tab'] = 'Welcome';
$_lang['menu_sqlbuddy_tab'] = 'Database';
$_lang['menu_docfinder_tab'] = 'Search';
$_lang['menu_backuppro_tab'] = 'Backup';
$_lang['menu_phpwebftp_tab'] = 'FTP';
$_lang['menu_upgrade_tab'] = 'Upgrade';
$_lang['menu_log_tab'] = 'Logs';
$_lang['menu_events_tab'] = 'Events';
$_lang['menu_logs'] = 'Truncate Logs';
$_lang['menu_events'] = "Schedule Events";
$_lang['menu_upgrade'] = 'Site Upgrade Preparation';
$_lang['menu_logs_mail'] = 'Error Log mail settings';
$_lang['manager_log'] = "Manager Log";
$_lang['event_log'] = "Event Log";
$_lang['activate_log_mail'] = 'Activate';
$_lang['deactivate_log_mail'] = 'Deactivate';
$_lang['truncationfailed'] = "Log file truncation failed ";
$_lang['truncationsuccess'] = "Log file truncation succeded ";
$_lang['errormailfailed'] = "Mail log errors failed ";
$_lang['errormailsuccess'] = "Mail log errors succeded ";
$_lang['failedtosavemaillog'] = 'Failed to save the mail error log system settings';
$_lang['mailsuccess'] = "Mail Log settings saved";
$_lang['eventsuccess'] = "Scheduled events saved";
$_lang['upgradesuccess'] = "Site upgrade preparation succeded";
$_lang['upgradefail'] = "Site upgrade preparation failed";
$_lang['maillogsuccess'] = "Mail settings saved";
$_lang['button_log_mail'] = 'Save';
$_lang['log_mail_account'] = '  Mail To';
$_lang['button_truncate_logs'] = "Truncate";
$_lang['button_site_upgrade'] = "Prepare";
$_lang['truncate_manager_failed'] = 'Failed to truncate the Manager Log';
$_lang['truncate_event_failed'] = 'Failed to truncate the Manager Log';
$_lang['unknownerror'] = 'Unknown error';
$_lang['janitor.desc'] = 'A component to assist with site maintenance tasks';
$_lang['welcome_text_1'] = '<br><p style="font-size:20px; text-align:center; margin-right:25%; margin-left:5%;">Welcome to the Janitor Revolution 3PC.</p>';
$_lang['welcome_text_2'] = '<br><p style="font-size:16px; text-align:left; margin-right:25%; margin-left:5%;">A Janitor is defined as someone who
                           looks after a building, in this case the building is your Revolution installation!. Hopefully Janitor will assist you in the everyday maintenance
                           tasks you undertake to keep your site in tip top shape.</p>';
$_lang['welcome_text_3'] = '<br><p style="font-size:16px; text-align:left; margin-right:25%; margin-left:5%;">Janitor uses a mixture of robust 3rd party tools such as MySQLBuddy and phpMyBackUpPro
                           and Revolution specific tools to allow everyday maintenance to be performed easily. Please refer
                           to the User Guide for more specific details on these tools but just to get you started here\'s a
                           brief rundown of the tabs </p>';
$_lang['welcome_text_4'] = '<br><p style="font-size:14px; text-align:left; margin-right:25%; margin-left:5%;"><b>Database</b> Uses
                           MySQLBuddy as a general purpose database maintenance tool for non-specific database tasks.</p>';
$_lang['welcome_text_5'] = '<p style="font-size:14px; text-align:left; margin-right:25%; margin-left:5%;"><b>Backup</b> Uses
                           phpMyBackupPro as a general purpose database backup tool.</p>
                           <p style="font-size:14px; text-align:left; margin-right:25%; margin-left:5%;"><b>FTP</b> Uses
                           phpWebFTP as a lightweight graphical FTP utility.</p>
                           <p style="font-size:14px; text-align:left; margin-right:25%; margin-left:5%;"><b>Search</b> Uses
                           Evolutions DocFinder module as a site serach utility.</p>';
$_lang['welcome_text_6'] = '<p style="font-size:14px; text-align:left; margin-right:25%; margin-left:5%;"><b>Logs</b> Allows log file management. </p>
                           <p style="font-size:14px; text-align:left; margin-right:25%; margin-left:5%;"><b>Upgrade</b> Prepares the site for an upgrade.</p>
                           <p style="font-size:14px; text-align:left; margin-right:25%; margin-left:5%;"><b>Events</b> Scheduled event handling. </p>';
$_lang['welcome_text_footer'] = '<br/><br/><br/><br/><br/><br/><i><p style="font-size:16px; text-align:left; margin-right:25%; margin-left:5%;">Designed and
                                 implemented for MODx Revolution by <a href="mailto:steve.hamblett@linux.com">S. Hamblett</a> incorporating ideas
                                 and suggestions from the MODx community.</p></i>';
$_lang['upgrade_steps']= '<br><p style="font-size:16px; text-align:left; margin-right:5%; margin-left:5%;">This function prepares your installation for an upgrade, specifically it performs the following operations in order :-.</p>';
$_lang['upgrade_steps_list']= '<br/><p style="font-size:14px; text-align:left; margin-right:5%; margin-left:5%;">
                          1. The directory /core/packages/core and the file /core/packages/transport are deleted.</p>
                          <p style="font-size:14px; text-align:left; margin-right:5%; margin-left:5%;">
                          2. The manager log, event log and the error log are cleared.</p>
                          <p style="font-size:14px; text-align:left; margin-right:5%; margin-left:5%;">
                          3. The cache is cleared.</p>
                          <p style="font-size:14px; text-align:left; margin-right:5%; margin-left:5%;">
                          4. Permissions are flushed.</p>
                          <p style="font-size:14px; text-align:left; margin-right:5%; margin-left:5%;">
                          5. All sessions are flushed.</p>
                          <br/><p style="font-size:16px; text-align:left; margin-right:5%; margin-left:5%;">
                          The last step will log you out, any manager actions you perform will return you to the login screen,
                          you should now be able to perform your upgrade.</p><br/>';
$_lang['event_desc'] = '<br><p style="font-size:16px; text-align:left; margin-right:5%; margin-left:5%;">
                        Scheduled event handling is planned to go here, but not in this release!</p>';