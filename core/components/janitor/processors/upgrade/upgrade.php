<?php
/**
 * Upgrade processor
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

/* Pass the parameters to the Janitor class method */
$result = $jn->upgrade($errorstring);

/* Check the result for error */
if ($result !== true) {
	return $modx->error->failure($modx->lexicon('upgradefailed')." - ".$errorstring);
}

return $modx->error->success($modx->lexicon('upgradesuccess'));

