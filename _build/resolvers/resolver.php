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
 
            $result = chmod($xfigPath.'export', 0775);
            if ( !$result ) {
				$modx->log(xPDO::LOG_LEVEL_INFO,"Failed to set permissions on export directory");
				$success = false;
				break;
			}
			
			/* Set the correct permissions for Extplorer */
			$extplorerPath = $modx->getOption('assets_path') . 'components/janitor/extplorer/';
            $modx->log(xPDO::LOG_LEVEL_INFO,"Setting file permissions for Extplorer");

            $result = chmod($extplorerPath.'config', 0775);
            if ( !$result ) {
				$modx->log(xPDO::LOG_LEVEL_INFO,"Failed to set permissions on config directory");
				$success = false;
				break;
			}

            $result = chmod($extplorerPath.'ftp_tmp', 0775);
			if ( !$result ) {
				$modx->log(xPDO::LOG_LEVEL_INFO,"Failed to set permissions on ftp_temp directory");
				$success = false;
				break;
			}

			/* Set the correct permissions for the tmp directory  */
			$tmpPath = $modx->getOption('assets_path') . 'components/janitor/tmp';
            $modx->log(xPDO::LOG_LEVEL_INFO,"Setting file permissions for tmp directory");
 
            $result = chmod($tmpPath, 0775);
            if ( !$result ) {
				$modx->log(xPDO::LOG_LEVEL_INFO,"Failed to set permissions on tmp directory");
				$success = false;
				break;
			}
			
			$success = true;
			break;
			
        case xPDOTransport::ACTION_UPGRADE:
            
            /* Set the correct permissions for phpMyBackupPro */
			$xfigPath = $modx->getOption('assets_path') . 'components/janitor/phpmybackuppro/xfig/';
            $modx->log(xPDO::LOG_LEVEL_INFO,"Setting file permissions for phpMyBackupPro");
 
            $result = chmod($xfigPath.'export', 0775);
            if ( !$result ) {
				$modx->log(xPDO::LOG_LEVEL_INFO,"Failed to set permissions on export directory");
				$success = false;
				break;
			}
			
            $result = chmod($xfigPath.'global_conf.php', 0775);
			if ( !$result ) {
				$modx->log(xPDO::LOG_LEVEL_INFO,"Failed to set permissions on global_conf file");
				$success = false;
				break;
			}

            /* Set the correct permissions for Extplorer */
			$extplorerPath = $modx->getOption('assets_path') . 'components/janitor/extplorer/';
            $modx->log(xPDO::LOG_LEVEL_INFO,"Setting file permissions for Extplorer");

            $result = chmod($extplorerPath.'config', 0775);
            if ( !$result ) {
				$modx->log(xPDO::LOG_LEVEL_INFO,"Failed to set permissions on config directory");
				$success = false;
				break;
			}

            $result = chmod($extplorerPath.'ftp_tmp', 0775);
			if ( !$result ) {
				$modx->log(xPDO::LOG_LEVEL_INFO,"Failed to set permissions on ftp_temp directory");
				$success = false;
				break;
			}
            
			/* Set the correct permissions for the tmp directory  */
			$tmpPath = $modx->getOption('assets_path') . 'components/janitor/tmp';
            $modx->log(xPDO::LOG_LEVEL_INFO,"Setting file permissions for tmp directory");
 
            $result = chmod($tmpPath, 0775);
            if ( !$result ) {
				$modx->log(xPDO::LOG_LEVEL_INFO,"Failed to set permissions on tmp directory");
				$success = false;
				break;
			}
			
            $success = true;
            break;
            
        case xPDOTransport::ACTION_UNINSTALL:

            $success = true;
            break;

}
return $success;

