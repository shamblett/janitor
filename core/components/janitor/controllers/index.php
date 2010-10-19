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
/*  Database */
$modx->regClientStartupScript($assetsUrl . 'js/database/sqlbuddy.js');
/* Backup */
$modx->regClientStartupScript($assetsUrl . 'js/backup/phpmybackuppro.js');
/* FTP*/
$modx->regClientStartupScript($assetsUrl . 'js/ftp/extplorer.js');
/* Search */
$modx->regClientStartupScript($assetsUrl . 'js/search/docfinder.js');
/* Logs */
$modx->regClientStartupScript($assetsUrl . 'js/logs/logs.js');
$modx->regClientStartupScript($assetsUrl . 'js/logs/mail.js');
/* Upgrade */
$modx->regClientStartupScript($assetsUrl . 'js/upgrade/upgrade.js');
/* Events */
$modx->regClientStartupScript($assetsUrl . 'js/events/events.js');
/* Link Check */
$modx->regClientStartupScript($assetsUrl . 'js/linkcheck/linkcheck.js');

return $modx->smarty->fetch('jnindex.tpl');
