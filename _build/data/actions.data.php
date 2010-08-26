<?php
/**
 * Actions build script
 *
 * @category  Maintenance
 * @package   Janitor
 * @author    S. Hamblett <steve.hamblett@linux.com>
 * @copyright 2009 S. Hamblett
 * @license   GPLv3 http://www.gnu.org/licenses/gpl.html
 * @link      none
 **/

/* Actions */
$action= $modx->newObject('modAction');
$action->fromArray(array(
    'id' => 1,
    'namespace' => 'janitor',
    'parent' => '0',
    'controller' => 'index',
    'haslayout' => '1',
    'lang_topics' => 'janitor:default,file',
    'assets' => '',
), '', true, true);

/* load menu into action */
$menu= $modx->newObject('modMenu');
$menu->fromArray(array(
    'text' => 'janitor',
    'parent' => 'components',
    'text' => 'janitor',
    'description' => 'janitor.desc',
    'icon' => 'images/icons/plugin.gif',
    'menuindex' => '0',
    'params' => '',
    'handler' => '',
), '', true, true);
$menu->addOne($action);

return $menu;
