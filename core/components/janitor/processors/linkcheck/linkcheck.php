<?php
/**
 * Link Check processor
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

$errorstring = "";
$output = "";
$outputArray = array();
$resource = "";
$children = false;

if ( $_POST['resource'] != '' ) {
    $resource = $_POST['resource'];
} else {
    $resource = Janitor::NO_RESOURCE;
}

if ( isset($_POST['children'])) {
    $children = true;
}

/* Call the Janitor class method */
$result = $jn->runLinkCheck($output, $errorstring, $resource, $children);

/* Check the result for error */
if ($result !== true) {
	return $modx->error->failure($modx->lexicon('linkcheckfailed')." - ".$errorstring);
}

return $modx->error->success($modx->lexicon('linkchecksuccess'), $output);

