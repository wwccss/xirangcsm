<?php
/**
 * The control file of group module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2011 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     商业软件，未经授权，请立刻删除!
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     group
 * @version     $Id: control.php 1979 2011-07-01 05:20:02Z wwccss $
 * @link        http://www.zentao.net
 */
class group extends control
{
    /**
     * Browse groups.
     * 
     * @access public
     * @return void
     */
    public function browse()
    {

        $position[]      = $this->lang->group->browse;

        $groups     = $this->group->getList();
        $groupUsers = array();

        $this->view->position   = $position;
        $this->view->groups     = $groups;
        $this->view->groupUsers = $groupUsers;

        $this->display();
    }

    /**
     * Manage privleges of a group. 
     * 
     * @param  int    $groupID 
     * @access public
     * @return void
     */
    public function managePriv($param = 0)
    {
        $groupID = $param;
        foreach($this->lang->resource as $moduleName => $action) $this->app->loadLang($moduleName);

        if(!empty($_POST))
        {
            $result = $this->group->updatePrivByGroup($groupID);
            echo js::alert($result ? $this->lang->group->successSaved : $this->lang->group->errorNotSaved);
            die(js::reload('parent'));
        }

        $group      = $this->group->getById($groupID);
        $groupPrivs = $this->group->getPrivs($groupID);

        $this->view->position[]    = $group->name . $this->lang->colon . $this->lang->group->managePriv;

        $this->view->group      = $group;
        $this->view->groupPrivs = $groupPrivs;

        $this->display();
    }
}
