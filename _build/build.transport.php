<?php
/**
 * Main package build script
 *
 * @category   Maintenance
 *
 * @package    Janitor
 * @subpackage Build
 * @author     S. Hamblett <steve.hamblett@linux.com>
 * @copyright  2010 S. Hamblett
 * @license    GPLv3 http://www.gnu.org/licenses/gpl.html
 * @link       none
 */
$mtime = microtime();
$mtime = explode(' ', $mtime);
$mtime = $mtime[1] + $mtime[0];
$tstart = $mtime;
set_time_limit(0);

require_once dirname(__FILE__) . '/build.config.php';
require_once MODX_CORE_PATH . 'model/modx/modx.class.php';
$modx= new modX();
$modx->initialize('mgr');
$modx->setDebug(false);
$modx->setLogLevel(modX::LOG_LEVEL_INFO);
echo '<pre>'; $modx->setLogTarget('ECHO');
error_reporting(E_ALL); ini_set('display_errors', true);

$name = 'janitor';
$version = '1.3';
$release = 'beta';

$modx->loadClass('transport.modPackageBuilder', '', false, true);
$builder = new modPackageBuilder($modx);
$builder->createPackage($name, $version, $release);
$builder->registerNamespace('janitor', false, true, '{core_path}components/janitor/');
$base = dirname(dirname(__FILE__)) . '/';
$sources= array (
    'root' => $base,
    'assets' => $base . 'assets/components/janitor/',
    'docs' => $base . 'assets/components/janitor/docs/',
    'core' => $base . 'core/components/janitor/',
    'lexicon' => $base . 'core/components/janitor/lexicon/',
    'model' => $base . 'core/components/janitor/model/',
    'templates' => $base . 'core/components/janitor/templates/',
    'build' => $base . '_build/',
    'data' => $base . '_build/data/',
    'resolvers' => $base . '_build/resolvers/',
    'source_core' => $base . 'core/components/janitor',
    'source_assets' => $base . 'assets/components/janitor',
);
unset($base);

$vehicles = array();

/* ACTIONS */
$menu = require_once $sources['data'].'actions.data.php';
if (!$menu) $modx->log(xPDO::LOG_LEVEL_FATAL,'Menu not found!');
$attr = array(
    xPDOTransport::PRESERVE_KEYS => true,
    xPDOTransport::UPDATE_OBJECT => true,
    xPDOTransport::UNIQUE_KEY => ('text'),
    xPDOTransport::RELATED_OBJECTS => true,
    xPDOTransport::RELATED_OBJECT_ATTRIBUTES => array (
        'Action' => array (
            xPDOTransport::PRESERVE_KEYS => false,
            xPDOTransport::UPDATE_OBJECT => true,
            xPDOTransport::UNIQUE_KEY => array ('namespace', 'controller'),
        ),
    ),
);

$vehicle = $builder->createVehicle($menu, $attr);
$vehicles[] = $vehicle;

/* SETTINGS */
require_once $sources['data'].'settings.data.php';

$attr = array(
    xPDOTransport::PRESERVE_KEYS => true,
    xPDOTransport::UPDATE_OBJECT => true,
    xPDOTransport::RELATED_OBJECTS => false,
    xPDOTransport::UNIQUE_KEY => 'key');
	
foreach ($settings as $setting ) {

	$vehicle = $builder->createVehicle($setting, $attr);
	$vehicles[] = $vehicle;
}

/* CATEGORY */
$attr = array(
    xPDOTransport::PRESERVE_KEYS => false,
    xPDOTransport::UPDATE_OBJECT => true,
    xPDOTransport::RELATED_OBJECTS => false,
    xPDOTransport::UNIQUE_KEY => 'category');
	
$vehicle = $builder->createVehicle($category, $attr);
$vehicles[] = $vehicle;

/* Resolve the files and php resolvers on the last vehicle */
$vehicle = end($vehicles);

$vehicle->resolve('file', array(
    'source' => $sources['source_assets'],
    'target' => "return MODX_ASSETS_PATH . 'components/';"));
    
$vehicle->resolve('file', array(
    'source' => $sources['source_core'],
    'target' => "return MODX_CORE_PATH . 'components/';"));
    
$vehicle->resolve('php',array(
            'type' => 'php',
            'source' => $sources['resolvers'] . 'resolver.php'));
	
/* Pack the vehicles*/
foreach ( $vehicles as $vehicle ) {

	$builder->putVehicle($vehicle);
}

/* Pack in the license file, readme and setup options */
$builder->setPackageAttributes(array(
	'license' => file_get_contents($sources['docs'] . 'LICENSE.txt'),
 	'readme' => file_get_contents($sources['docs'] . 'README.txt')));

/* zip up the package */
$builder->pack();

$mtime= microtime();
$mtime= explode(" ", $mtime);
$mtime= $mtime[1] + $mtime[0];
$tend= $mtime;
$totalTime= ($tend - $tstart);
$totalTime= sprintf("%2.4f s", $totalTime);
echo "\nExecution time: {$totalTime}\n";
exit ();
