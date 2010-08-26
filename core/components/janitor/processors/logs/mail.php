<?php
/**
 * Mail Error Log processor
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

$account = $_REQUEST['mail-account'];
$activation = $_REQUEST['mail-log'];
$errorstring = "";

/* Initialise the input parameters */
$status = 0;
if ( $activation == 'activate') $status = 1;

/* Pass the parameters to the Janitor class method */
$result = $jn->mailErrorLog($status, $account, $errorstring);

/* Check the result for error */
if ($result !== true) {
	return $modx->error->failure($modx->lexicon('errormailfailed')." - ".$errorstring);
}

return $modx->error->success($modx->lexicon('errormailsuccess'));

