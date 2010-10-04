<?php
/**
 * Common processor
 *
 * @category  Maintenance
 * @author    S. Hamblett <steve.hamblett@linux.com>
 * @copyright 2009 S. Hamblett
 * @license   GPLv3 http://www.gnu.org/licenses/gpl.html
 * @link      none
 *
 * @package janitor
 * @subpackage processors
 */
require_once dirname(dirname(__FILE__)).'/model/janitor/janitor.class.php';

/* Load our main class */
$jn = new Janitor($modx);

/* initialize into a connector context */
return $jn->initialize('connector');

