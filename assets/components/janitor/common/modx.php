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
 * contaminate downstream.
 */
unset($database_type,
      $database_server,
      $database_user,
      $database_password,
      $database_connection_charset,
      $dbase,
      $table_prefix,
      $lastInstallTime,
      $site_id,
      $site_sessionname,
      $https_port,
      $isSecureRequest,
      $url_scheme,
      $http_host,
      $site_url);
