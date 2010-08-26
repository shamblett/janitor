<?php
/**
 * Log processor
 *
 * @category  Maintenance
 * @author    S. Hamblett <steve.hamblett@linux.com>
 * @copyright 2010 S. Hamblett
 * @license   GPLv3 http://www.gnu.org/licenses/gpl.html
 * @link      none
 *
 * @package   janitor
 * @subpackage processors
 **/
require_once dirname(dirname(__FILE__)).'/index.php';

$manager = $_REQUEST['manager'];
$event = $_REQUEST['event'];
$errorstring = "";

if ( $manager == 'on') $clearManager = true;
if ( $event == 'on' ) $clearEvent = true;

/* Pass the parameters to the Janitor class method */
$result = $jn->truncateLogs($clearManager, $clearEvent, $errorstring);

/* Check the result for error */
if ($result !== true) {
	return $modx->error->failure($modx->lexicon('truncationfailed')." - ".$errorstring);
}

return $modx->error->success($modx->lexicon('truncationsuccess'));

