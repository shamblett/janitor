<?php
  /**
 * Janitor Resolver
 *
 * @package janitor
 * @author S. Hamblett steve.hamblett@linux.com
 */

$success = false;
$modx =& $object->xpdo;

switch($options[xPDOTransport::PACKAGE_ACTION]) {


    case xPDOTransport::ACTION_INSTALL:

			/* Set the correct permissions for phpMyBackupPro */
			$xfigPath = $modx->getOption('assets_path') . 'components/janitor/phpmybackuppro/xfig/';
            $modx->log(xPDO::LOG_LEVEL_INFO,"Setting file permissions for phpMyBackupPro");
 
            $result = chmod($xfigPath.'export', 0777);
            if ( !$result ) {
				$modx->log(xPDO::LOG_LEVEL_INFO,"Failed to set permissions on export directory");
				$success = false;
				break;
			}
			
            $result = chmod($xfigPath.'global_conf.php', 0777);
			if ( !$result ) {
				$modx->log(xPDO::LOG_LEVEL_INFO,"Failed to set permissions on global_conf file");
				$success = false;
				break;
			}
			
			$success = true;
			break;
			
        case xPDOTransport::ACTION_UPGRADE:
            
            $success = true;
            break;
            
        case xPDOTransport::ACTION_UNINSTALL:

            $success = true;
            break;

}
return $success;

