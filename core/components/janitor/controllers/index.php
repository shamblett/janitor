<?php
/**
 * Base controller file
 *
 * @category  Maintenance
 * @author    S. Hamblett <steve.hamblett@linux.com>
 * @copyright 2009 S. Hamblett
 * @license   GPLv3 http://www.gnu.org/licenses/gpl.html
 * @link      none
 *
 * @package janitor
 * @subpackage controllers
 */
require_once dirname(dirname(__FILE__)).'/model/janitor/janitor.class.php';

/* Load our main class */
$jn = new Janitor($modx);
$jn->initialize('mgr');
$assetsUrl = $modx->getOption('janitor.assets_url',null,$modx->getOption('assets_url').'components/janitor/');
/* Register common JS to HEAD tag */
$modx->regClientStartupScript($assetsUrl .'js/janitor.js');
/*  Welcome */
$modx->regClientStartupScript($assetsUrl . 'js/welcome/welcome.js');
/*  SQL Buddy */
$modx->regClientStartupScript($assetsUrl . 'js/sqlbuddy/sqlbuddy.js');
/* BackupPro */
$modx->regClientStartupScript($assetsUrl . 'js/phpmybackuppro/phpmybackuppro.js');
/* PHPWebFTP*/
$modx->regClientStartupScript($assetsUrl . 'js/phpwebftp/phpwebftp.js');
/* Logs */
$modx->regClientStartupScript($assetsUrl . 'js/logs/logs.js');
$modx->regClientStartupScript($assetsUrl . 'js/logs/mail.js');
/* Upgrade */
$modx->regClientStartupScript($assetsUrl . 'js/upgrade/upgrade.js');
/* Events */
$modx->regClientStartupScript($assetsUrl . 'js/events/events.js');

return $modx->smarty->fetch('jnindex.tpl');
