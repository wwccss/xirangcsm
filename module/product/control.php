<?php
/**
 * The control file of product module of zentaoasm
 *
 * @copyright   Copyright 2009-2011 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     商业软件，未经授权，请立刻删除!
 * @author      Congzhi Chen<congzhi@cnezsoft.com>
 * @package     product
 * @version     $Id$
 * @link        http://www.zentao.net
 */
class product extends control
{
    const NEW_PRODUCT_COUNT  = 5;

    /**
     * Stop a product
     * 
     * @param int $productID 
     * @param  string $confirm 
     * @access public
     * @return void
     */
    public function stop($productID, $confirm = 'no')
    {
        if($confirm == 'no')
        {
            die(js::confirm($this->lang->product->confirmStop, inLink('stop', "productID=$productID&confirm=yes")));
        }
        else
        {
            $this->product->changeProductStatus($productID, 'stopped');
            die(js::locate($this->inLink('manage'), 'parent'));
        }
    }

    /**
     * Online a product
     * 
     * @param  int $productID 
     * @param  string $confirm 
     * @access public
     * @return void
     */
    public function online($productID, $confirm = 'no')
    {
        if($confirm == 'no')
        {
            die(js::confirm($this->lang->product->confirmOnline, inLink('online', "productID=$productID&confirm=yes")));
        }
        else
        {
            $this->product->changeProductStatus($productID, 'online');
            die(js::locate($this->inLink('manage'), 'parent'));
        }
    }
    /**
     * Update products' order 
     * 
     * @access public
     * @return void
     */
    public function updateOrder()
    {
        if(!empty($_POST))
        {
            $this->product->updateOrder($this->post->orders);
            if(dao::isError()) die(js::error(dao::getError()));
            die(js::reload('parent'));
        }
    }

    /**
     * Manage  products
     * 
     * @access public
     * @return void
     */
    public function manage($selectedProductID = 0)
    {
        $this->view->selectedProduct = '';
        if($selectedProductID != 0)
        {
            $this->view->selectedProduct = $this->product->getByID($selectedProductID);
            $this->view->categories = $this->category->getByProductID($selectedProductID);
        }

        if(!empty($_POST))
        {
            if($this->config->api->openSync)
            {
                echo js::error($this->lang->product->cannotUpdate);
            }
            else
            {
                $this->product->updateProducts($this->post->products);
                if(dao::isError()) die(js::error(dao::getError()));
            }
            die(js::reload('parent'));
        }
        $this->view->products = $this->product->getAllProducts();
        $this->display();
    }

    /**
     * Get all products for API
     * 
     * @access public
     * @return void
     */
    public function getAllProducts()
    {
        $this->view->products = $this->product->getAllProducts();
        $this->display();
    }

    /**
     * Sync product 
     * 
     * @access public
     * @return void
     */
    public function syncProduct()
    {
        $products = json_decode(urldecode($_POST['0']));
        foreach($products as $product)
        {
            $isExist = $this->dao->select('*')->from(TABLE_PRODUCT)->where('id')->eq($product->id)->fetch();
            if($isExist)
            {
                $this->dao->update(TABLE_PRODUCT)->set('name')->eq($product->name)->set('status')->eq('online')->where('id')->eq($product->id)->exec();
            }
            else
            {
                $newProduct->id     = $product->id;
                $newProduct->name   = $product->name;
                $newProduct->status = 'online';
                $this->dao->insert(TABLE_PRODUCT)->data($newProduct)->exec();
            }
        }
        if(dao::isError())
        {
            $this->view->result = 'fail'; 
        }
        else
        {
            $this->view->result = 'success'; 
        }
        $this->display();
    }
}
