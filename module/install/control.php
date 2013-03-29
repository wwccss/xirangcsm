<?php
/**
 * The control file of install module of ZenTaoASM.
 *
 * @copyright   Copyright 2009-2011 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     install
 * @version     $Id$
 * @link        http://www.zentao.net
 */
class install extends control
{
    /**
     * The construction function , check is install or not.
     * 
     * @access public
     * @return array
     */
    public function __construct()
    {
        if(!defined('RUN_MODE') or RUN_MODE != 'install') die('error');
        parent::__construct();
    }

    /**
     * The index page.
     * 
     * @access public
     * @return void
     */
    public function index()
    {
        if(!isset($this->config->installed) or !$this->config->installed) $this->session->set('installing', true);

        $this->view->header->title = $this->lang->install->welcome;
        $this->display();
    }

    /**
     * Checking the system.
     * 
     * @access public
     * @return void
     */
    public function step1()
    {
        $this->view->header->title  = $this->lang->install->checking;
        $this->view->phpVersion     = $this->install->getPhpVersion();
        $this->view->phpResult      = $this->install->checkPHP();
        $this->view->pdoResult      = $this->install->checkPDO();
        $this->view->pdoMySQLResult = $this->install->checkPDOMySQL();
        $this->view->tmpRootInfo    = $this->install->getTmpRoot();
        $this->view->tmpRootResult  = $this->install->checkTmpRoot();
        $this->view->dataRootInfo   = $this->install->getDataRoot();
        $this->view->dataRootResult = $this->install->checkDataRoot();
        $this->view->iniInfo        = $this->install->getIniInfo();
        $this->display();
    }

    /**
     * Set the database.
     * 
     * @access public
     * @return void
     */
    public function step2()
    {
        $this->view->header->title = $this->lang->install->setConfig;
        $this->display();
    }

    /**
     * Create the config file.
     * 
     * @access public
     * @return void
     */
    public function step3()
    {
        if(!empty($_POST))
        {
            $return = $this->install->checkConfig();
            if($return->result == 'ok')
            {
                $this->view = (object)$_POST;
                $this->view->lang   = $this->lang;
                $this->view->config = $this->config;
                $this->view->domain = $this->server->HTTP_HOST;
                $this->view->header->title = $this->lang->install->saveConfig;
                $this->display();
            }
            else
            {
                $this->view->header->title = $this->lang->install->saveConfig;
                $this->view->error = $return->error;
                $this->display();
            }
        }
        else
        {
            $this->locate($this->createLink('install'));
        }
    }

    /**
     * Step4: create site and admin.
     * 
     * @access public
     * @return array
     */
    public function step4()
    {
        if(!empty($_POST))
        {
            $this->install->grantPriv();
            if(dao::isError()) die(js::error(dao::getError()));

            $this->loadModel('setting')->updateVersion($this->config->version);
            die(js::locate(inlink('step5', "admin={$this->post->account}"), 'parent'));
        }

        $this->view->header->title = $this->lang->install->getPriv;
        if(!isset($this->config->installed) or !$this->config->installed)
        {
            $this->view->error = $this->lang->install->errorNotSaveConfig;
            $this->display();
        }
        else
        {
            $this->view->pmsDomain = $this->server->HTTP_HOST;
            $this->display();
        }
    }

    /**
     * Step5: save the admin user to the config.
     * 
     * @param  string    $admin 
     * @access public
     * @return void
     */
    public function step5($admin)
    {
        session_destroy();
        $this->view->header->title = $this->lang->install->success;
        $this->display();
    }
}
