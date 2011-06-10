<?php
/**
 * MODx specific hooks
 *
 * @category  Maintenance
 * @author    S. Hamblett <steve.hamblett@linux.com>
 * @copyright 2009 S. Hamblett
 * @license   GPLv3 http://www.gnu.org/licenses/gpl.html
 * @link      none
 *
 * @package   janitor
 * @subpackage common
 */

/* Get the core config and config inc .php */
require_once dirname(dirname(dirname(dirname(dirname(__FILE__))))) . "/config.core.php";
require_once MODX_CORE_PATH . "/config/config.inc.php"; 

/* Check for a valid session, without using the MODx object */
session_start();
$sessid = session_id();
$modxConn = mysql_connect($database_server, $database_user, $database_password);
if (!$modxConn) die("<h2>You are not authorized to view this page. </h2>");
$dbase = strtr($dbase, "`", " ");
$dbase = trim($dbase);
if ( mysql_select_db($dbase, $modxConn) == false ) die ("<h2>You are not authorized to view this page. </h2>");
$sessionTable = "`" . $table_prefix . "session" . "`";
$sql = "SELECT * FROM " . $sessionTable . " WHERE " . "`id` = " . '"' . $sessid . '"';
$result = mysql_query($sql, $modxConn);
if ( $result == false) die ("<h2>You are not authorized to view this page. </h2>");
if ( mysql_num_rows($result) != 1 ) die("<h2>You are not authorized to view this page. </h2>");
mysql_close($modxConn);
unset($modxConn, 
      $result,
      $sessid,
      $sessionTable,
      $sql);

/* Unset the variables we introduced from the config.inc.php
 * that are not MODx specific, ie dont start with modx_ so we don't
 * contaminate downstream. Not database variables, see below.
 */
unset($table_prefix,
      $lastInstallTime,
      $site_id,
      $site_sessionname,
      $https_port,
      $isSecureRequest,
      $url_scheme,
      $http_host,
      $site_url);

/* Caller specific initialisation */

/* Create a MODx object */
if ( isset($modx_create_object) ) {
	
	/* Create a MODx object as a manager */
	define('IN_MANAGER_MODE',true);
	include_once MODX_CORE_PATH . 'model/modx/modx.class.php';
	$options = array();
	$modx = new modX('', $options);
	$modx->setDebug(E_ALL & ~E_NOTICE);
	$modx->setLogLevel(modX::LOG_LEVEL_ERROR);
	$modx->setLogTarget('FILE');
	$modx->initialize('mgr');
    $modxConfig = $modx->GetConfig();

}
	
/* Preserve database variables */
if ( isset($modx_preserve_database_variables) ) {
	
    /* Preserve them as modx_ variables */
    $modx_database_type = $database_type;
    $modx_database_server = $database_server;
    $modx_database_user = $database_user;
    $modx_database_password = $database_password;
    $modx_database_connection_charset = $database_connection_charset;
    $modx_dbase = $dbase;
}

/* Unset the original database variables */
unset($database_type,
      $database_server,
      $database_user,
      $database_password,
      $database_connection_charset,
      $dbase);     
      
      
      
