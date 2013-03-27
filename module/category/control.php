<?php
/**
 * The control file of category module of zentaocs
 *
 * @copyright   Copyright 2009-2011 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     商业软件，未经授权，请立刻删除!
 * @author      Congzhi Chen<congzhi@cnezsoft.com>
 * @package     category
 * @version     $Id$
 * @link        http://www.zentao.net
 */
class category extends control
{
    const NEW_CATEGORY_COUNT = 5;

    /**
     * Delete a category
     * 
     * @param int $categoryID 
     * @param  string $confirm 
     * @access public
     * @return void
     */
    public function delete($categoryID, $confirm = 'no')
    {
        $productID = $this->dao->select('*')->from(TABLE_CATEGORY)->where('id')->eq($categoryID)->fetch()->product;
        if($confirm == 'no')
        {
            die(js::confirm($this->lang->category->confirmDelete, inLink('delete', "categoryID=$categoryID&confirm=yes")));
        }
        else
        {
            $this->category->delete($categoryID);
            die(js::locate($this->inLink('manage', "selectedProduct=$productID"), 'parent'));
        }
    }

    /**
     * Update categories' order 
     * 
     * @access public
     * @return void
     */
    public function updateOrder()
    {
        if(!empty($_POST))
        {
            $this->category->updateOrder($this->post->orders);
            if(dao::isError()) die(js::error(dao::getError()));
            die(js::reload('parent'));
        }
    }

    /**
     * Manage categories
     * 
     * @param  int    $productID 
     * @access public
     * @return void
     */
    public function manage($productID = 0)
    {
        $this->loadModel('product');
        if(!empty($_POST))
        {
            $this->category->updateCategories($this->post->categories);
            if(dao::isError()) die(js::error(dao::getError()));
            die(js::reload('parent'));
        }
        $productList = $this->product->getPairs();
        $productList['0'] = $this->lang->product->selectAProduct;
        $this->view->productList = $productList;
        
        if($productID != 0)
        {
            $this->view->categories  = $this->category->getByProductID($productID);
        }
        else 
        {
            $this->view->categories = '';
        }
        $this->view->productID = $productID;
        $this->display();
    }
}
