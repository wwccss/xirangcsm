<?php
/**
 * The control file of company module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     company
 * @version     $Id: control.php 4373 2013-02-19 02:31:01Z zhujinyonging@gmail.com $
 * @link        http://www.zentao.net
 */
class company extends control
{
    /**
     * Edit a company.
     * 
     * @access public
     * @return void
     */
    public function edit()
    {
        if(!empty($_POST))
        {
            $this->company->update();
            if(dao::isError()) die(js::error(dao::getError()));

            die(js::alert($this->lang->company->successSaved) . js::reload('parent'));
        }

        $title      = $this->lang->company->common . $this->lang->colon . $this->lang->company->edit;
        $position[] = $this->lang->company->edit;
        $this->view->title     = $title;
        $this->view->position  = $position;
        $this->view->company   = $this->company->getFirst();

        $this->display();
    }
}
