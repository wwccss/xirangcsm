<?php
/**
 * The control file of setting of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2011 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     商业软件，未经授权，请立刻删除!
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     setting
 * @version     $Id$
 * @link        http://www.zentao.net
 */
class setting extends control
{
    /**
     * Set config 
     * 
     * @access public
     * @return void
     */
    public function setConfig()
    {
        if($_POST)
        {
            $this->setting->saveConfig();
            if(dao::isError())die(js::error(dao::getError()));
            echo js::alert($this->lang->setting->success);
            die(js::reload('parent'));
        }
        $this->view->syncConfig = $this->setting->getConfig();
        $this->display();
    }
}

