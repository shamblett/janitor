<?php
/**
 * Main Janitor class
 *
 * @category  Maintenance
 * @author    S. Hamblett <steve.hamblett@linux.com>
 * @copyright 2009 S. Hamblett
 * @license   GPLv3 http://www.gnu.org/licenses/gpl.html
 * @link      none
 *
 * @package janitor
 */

/**
 * Main Janitor class
 *
 *
 * @category   Maintenance
 * @author     S. Hamblett <shamblett@cwazy.co.uk>
 * @copyright  2009 S. Hamblett
 * @license    GPLv3 http://www.gnu.org/licenses/gpl.html
 * @link       none
 * @see        none
 * @deprecated no
 *
 * @package janitor
 */

class Janitor {

    /* Constants */
    const MALLOGACTIVE = 1;
    const MAILLOGINACTIVE = 0;
    
    /**
     * @var config local configuration settings
     * @access public
     */
    var $config = array();

    /**#@+
     * Constructor
     *
     * @param object &$modx class we are using.
     *
     * @return Janitor a unique Janitor instance.
     */
    function Janitor(&$modx) {
        $this->modx =& $modx;
    }

    /**
     * Initalize the class
     *
     * @access public
     * @param string $ctx context we are using.
     *
     * @return void
     */
    function initialize($ctx = 'mgr') {

        /* MODx provides us with the 'namespace_path' config setting
        * when loading custom manager pages. Set our base and core paths */
        $this->config['base_path'] = $this->modx->getOption('janitor.core_path',null,$this->modx->getOption('core_path').'components/janitor/');
        $this->config['core_path'] = $this->config['base_path'];

        /* add the Provisioner model into MODx */
        $this->modx->addPackage('janitor', $this->config['core_path'].'model/');

        /* Load the 'default' lang foci, which is default.inc.php. */
        $this->modx->lexicon->load('janitor:default');

        /* Load core user lexicon */
        $this->modx->lexicon->load('core:user');

        switch ($ctx) {
            case 'mgr': 
                $this->config['template_path'] = $this->config['core_path'].'templates/';
                $this->modx->smarty->setTemplatePath($this->config['template_path']);

                /* Refresh the smarty config and lexicon so it loads newly loaded custom data */
                $this->modx->smarty->assign('_config', $this->modx->config);
                $this->modx->smarty->assign('_lang', $this->modx->lexicon->fetch());
                break;
        }

    }

    /**
     * Truncate log files
     *
     * @access public
     * @param $manager truncate the manager log
     * @param $event truncate the event log
     *
     * @return $result, true on success
     */
     function truncateLogs($manager, $event, &$errorstring) {

        if ( $manager ) {

            if ($this->modx->exec("TRUNCATE {$this->modx->getTableName('modManagerLog')}") === false) {
                $errorstring = $this->modx->lexicon('truncate_manager_failed');
                return false;
            }
        }

        if ( $event ) {

            if ($this->modx->exec("TRUNCATE {$this->modx->getTableName('modEventLog')}") === false) {
                $errorstring = $this->modx->lexicon('truncate_event_failed');
                return false;
            }
        }

         return true;

     }

     /**
     * Mail error log errors
     *
     * @access public
     * @param $status on or off
     * @param $account to mail to
     *
     * @return $result, true on success
     */
     function mailErrorLog($status, $account, &$errorstring) {

         /* The parameters have already been prepared, 
          * just write them to the system settings
          */

         /* Status */
        $maillogsetting = $this->modx->getObject('modSystemSetting',
                array ('key' => 'maillog-status',
                'namespace' => 'janitor'));
        $maillogsetting->set('value', $status);
        if ( $maillogsetting->save()== false) {
             $errorstring = $this->modx->lexicon('failedtosavemaillog');
             return false;
        }

        /* Account */
        $maillogaccount = $this->modx->getObject('modSystemSetting',
                array ('key' => 'maillog-account',
                'namespace' => 'janitor'));
        $maillogaccount->set('value', $account);
        if ( $maillogaccount->save() == false ) {
             $errorstring = $this->modx->lexicon('failedtosavemaillog');
             return false;
        }

        return true;
    }

    /**
     * Mail Log Status function
     *
     * @access public
     * @return the current Mail Log status
     */

    function mailLogStatus() {

        $response = array();

        /* Status */
        $maillogsetting = $this->modx->getObject('modSystemSetting',
                array ('key' => 'maillog-status',
                'namespace' => 'janitor'));
        $response['status'] =$maillogsetting->get('value');

        /* Account */
        $maillogaccount = $this->modx->getObject('modSystemSetting',
                array ('key' => 'maillog-account',
                'namespace' => 'janitor'));
        $response['account'] =$maillogaccount->get('value');

        return $response;

    }

    /**
     * Upgrade preparation
     *
     * @access public
     *
     * @return $result, true on success
     */
     function upgrade(&$errorstring) {

         /* Remove the core directory and the transport.zip
          * don't care if we fail.
          */  
         $corePath = $this->modx->getOption('core_path');
         $coreDir = $corePath . '/packages/core';
         if ( file_exists($coreDir)) {
             $this->_deleteDirectory($coreDir);
         }
         $transportFile = $corePath . '/packages/core.transport.zip';
         if ( file_exists($transportFile)) unlink($transportFile);

         /* Empty the logs */
         $this->truncateLogs(true, true, $errorstring);
         $logFile = $this->modx->getOption(xPDO::OPT_CACHE_PATH).'logs/error.log';
         if (file_exists($logFile)) {
            $cacheManager= $this->modx->getCacheManager();
            $cacheManager->writeFile($logFile,' ');
         }

         /* Clear the cache */
         $contexts = $this->modx->getCollection('modContext');
         foreach ($contexts as $context) {
            $paths[] = $context->get('key') . '/';
         }
         $options = array(
            'publishing' => 1,
            'extensions' => array('.cache.php', '.msg.php', '.tpl.php'),
            );
         if ($this->modx->getOption('cache_db')) $options['objects'] = '*';
         $this->modx->cacheManager->clearCache($paths, $options);

         /* Flush permissions for the logged in user */
         if ($this->modx->getUser()) {
            $this->modx->user->getAttributes(array(), '', true);
          }

          /* Flush sessions */
          if ($this->modx->getOption('session_handler_class',null,'modSessionHandler') == 'modSessionHandler') {
                $sessionTable = $this->modx->getTableName('modSession');
                $this->modx->exec("TRUNCATE {$sessionTable}");
                $this->modx->user->endSession();
          }

          /* Always works for now */
          return true;
     }

     /**
     * Delete directory helper function
     *
     * @access private
     *
     * @param $directory to delete
     *
     * @return $result, true on success
     */
     function _deleteDirectory($dirname) {

         if (is_dir($dirname)) $dir_handle = opendir($dirname);
         if (!$dir_handle)return false;

         while(false !== ($file = readdir($dir_handle))) {
            if ($file != "." && $file != "..") {
                if (!is_dir($dirname."/".$file))
                    unlink($dirname."/".$file);
                else
                    $this->_deleteDirectory($dirname.'/'.$file);
            }
        }

        closedir($dir_handle);
        rmdir($dirname);

     }
}
