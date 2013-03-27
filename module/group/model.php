<?php
/**
 * The model file of group module of ZenTaoASM.
 *
 * @copyright   Copyright 2009-2011 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     group
 * @version     $Id: model.php 1914 2011-06-24 10:11:25Z yidong@cnezsoft.com $
 * @link        http://www.zentao.net
 */
?>
<?php
class groupModel extends model
{

    /**
     * Get group lists.
     * 
     * @param  int    $companyID 
     * @access public
     * @return array
     */
    public function getList()
    {
        return $this->dao->select('*')->from(TABLE_GROUP)->fetchAll();
    }

    /**
     * Get group by id.
     * 
     * @param  int    $groupID 
     * @access public
     * @return object
     */
    public function getByID($groupID)
    {
        return $this->dao->findById($groupID)->from(TABLE_GROUP)->fetch();
    }

    /**
     * Get privileges of a groups.
     * 
     * @param  int    $groupID 
     * @access public
     * @return array
     */
    public function getPrivs($groupID)
    {
        $privs = array();
        $stmt  = $this->dao->select('module, method')->from(TABLE_GROUPPRIV)->where('`group`')->eq($groupID)->orderBy('module')->query();
        while($priv = $stmt->fetch()) $privs[$priv->module][$priv->method] = $priv->method;
        return $privs;
    }
    
    /**
     * Update privilege of a group.
     * 
     * @param  int    $groupID 
     * @access public
     * @return bool
     */
    public function updatePrivByGroup($groupID)
    {
        /* Delete old. */
        $this->dao->delete()->from(TABLE_GROUPPRIV)->where('`group`')->eq($groupID)->exec();

        /* Insert new. */
        foreach($this->post->actions as $moduleName => $moduleActions)
        {
            foreach($moduleActions as $actionName)
            {
                $data->group = $groupID;
                $data->module = $moduleName;
                $data->method = $actionName;
                $this->dao->insert(TABLE_GROUPPRIV)->data($data)->exec();
            }
        }
        return true;
    }
}
