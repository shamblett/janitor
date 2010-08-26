<?php
/**
 * Status Mail Log processor
 *
 * @category  Maintenance
 * @author    S. Hamblett <steve.hamblett@linux.com>
 * @copyright 2009 S. Hamblett
 * @license   GPLv3 http://www.gnu.org/licenses/gpl.html
 * @link      none
 *
 * @package   janitor
 * @subpackage processors
 **/
require_once dirname(dirname(__FILE__)).'/index.php';

/* Call to the Janitor class method */
$result = $jn->mailLogStatus();

$response = $modx->error->success('', $result);
return json_encode($response);
