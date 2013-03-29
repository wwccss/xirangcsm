<?php
/**
 * The control file of faq module of zentaoASM
 *
 * @copyright   Copyright 2009-2011 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Congzhi Chen<congzhi@cnezsoft.com>
 * @package     faq
 * @version     $Id$
 * @link        http://www.zentao.net
 */
class faq extends control
{
    public function __construct()
    {
        parent::__construct(); 
        $this->loadModel('product');
        $this->loadModel('category');
    }

    /**
     * Show FAQ 
     * 
     * @param  int    $categoryID 
     * @access public
     * @return void
     */
    public function showFAQ($productID = null, $categoryID = 0)
    {
        $productList = $this->product->getPairs();
        $productID = ($productID == null and $productList) ? key($productList) : (int)$productID;
        if($productID == 0)
        {
            $this->view->faqs = $this->faq->getAllFAQs();
        }
        else if($productID != 0 && $categoryID == 0)
        {
            $this->view->faqs = $this->faq->getByProductID($productID);
            $this->view->categories = $this->category->getByProductID($productID);
        }
        else if($productID != 0 && $categoryID != 0)
        {
            $this->view->faqs = $this->faq->getByCategoryID($categoryID);
            $this->view->categories = $this->category->getByProductID($productID);
        }
        $productList['0'] = $this->lang->faq->allProduct;
        $this->view->productList = $productList;
        $this->view->selectedProductID = $productID;
        $this->display();
    }

    /**
     * manage 
     * 
     * @param  int    $categoryID 
     * @access public
     * @return void
     */
    public function manage($productID = 0, $categoryID = 0)
    {
        $this->view->categories = '';
        if($productID == 0)
        {
            $this->view->faqs = $this->faq->getAllFAQs();
        }
        else if($productID != 0 && $categoryID == 0)
        {
            $this->view->faqs = $this->faq->getByProductID($productID);
            $this->view->categories = $this->category->getByProductID($productID);
        }
        else if($productID != 0 && $categoryID != 0)
        {
            $this->view->faqs = $this->faq->getByCategoryID($categoryID);
            $this->view->categories = $this->category->getByProductID($productID);
        }

        $this->loadModel('product');
        $productList = $this->product->getPairs();
        $productList['0'] = $this->lang->product->selectAProduct;
        $this->view->productList = $productList;
        $this->view->selectedProductID = $productID;

        $this->display();
    }

    /**
     * Create a faq
     * 
     * @param  int $productID 
     * @param  int $categoryID 
     * @access public
     * @return void
     */
    public function create($productID, $categoryID)
    {
        if(!empty($_POST))
        {
            if($this->post->answer)
            {
                $this->faq->create($productID, $categoryID);
                if(dao::isError()) die(js::error(dao::getErrot()));
                die(js::locate($this->inLink('manage', "productID=$productID&categoryID=$categoryID")));
            }
            else 
            {
                echo js::alert($this->lang->faq->emptyWarning);
                die(js::locate($this->inLink('create', "productID=$productID&categoryID=$categoryID")));
            }
        }

        $this->display();
    }

    /**
     * Delete
     * 
     * @param  int $FAQID 
     * @param  string $confirm 
     * @access public
     * @return void
     */
    public function delete($FAQID, $confirm = 'no')
    {
        if($confirm == 'no')
        {
            die(js::confirm($this->lang->faq->confirmDelete, inLink('delete', "FAQID=$FAQID&confirm=yes")));
        }
        else 
        {
            $this->faq->delete($FAQID);
            die(js::locate($this->inLink('manage'), 'parent'));
        }
    }
   
    /**
     * edit 
     * 
     * @param  int    $FAQID 
     * @access public
     * @return void
     */
    public function edit($FAQID)
    {
        if(!empty($_POST))
        {
            if($this->post->answer)
            {
                $this->dao->update(TABLE_FAQ)
                    ->set('request')->eq($this->post->request)
                    ->set('answer')->eq($this->post->answer)
                    ->where('id')->eq($FAQID)
                    ->exec();

                if(dao::isError()) die(js::error(dao::getErrot()));
                die(js::locate($this->inLink('manage', "productID={$this->post->productID}&categoryID={$this->post->categoryID}")));
            }
            else 
            {
                echo js::alert($this->lang->faq->emptyWarning);
                die(js::locate($this->inLink('edit', "FAQID=$FAQID")));
            }
        }
        $this->view->FAQ = $this->faq->getByID($FAQID);

        $this->display();
    }
}
