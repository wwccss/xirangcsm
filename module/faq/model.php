<?php
/**
 * The model file of faq module of zentaocs
 *
 * @copyright   Copyright 2009-2011 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     商业软件，未经授权，请立刻删除!
 * @author      Congzhi Chen<congzhi@cnezsoft.com>
 * @package     faq
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php
class faqModel extends model
{

    /**
     * Get FAQ list by categoryID 
     * 
     * @param  int    $productID 
     * @param  int    $categoryID 
     * @access public
     * @return object
     */
    public function getListByCategoryID($productID, $categoryID)
    {
        return $this->dao->select('id, request')->from(TABLE_FAQ)->where('product')->eq($productID)->andWhere('category')->eq($categoryID)->fetchPairs('id', 'request', false);
    }

    /**
     * Get FAQ by id 
     * 
     * @param  int $faqID 
     * @access public
     * @return void
     */
    public function getByID($faqID)
    {
        return $this->dao->select('*')->from(TABLE_FAQ)->where('id')->eq($faqID)->fetch();
    }

    /**
     * getAllFAQs 
     * 
     * @access public
     * @return void
     */
    public function getAllFAQs()
    {
        return $this->dao->select('*')->from(TABLE_FAQ)->orderBy('addedtime asc')->fetchAll();
    }

    /**
     * Get FAQs by productID 
     * 
     * @param  int $productID 
     * @access public
     * @return object
     */
    public function getByProductID($productID)
    {
        return $this->dao->select('*')->from(TABLE_FAQ)->where('product')->eq($productID)->fetchAll();
    }

    /**
     * Get FAQs by categoryID 
     * 
     * @param  int $categoryID 
     * @access public
     * @return object
     */
    public function getByCategoryID($categoryID)
    {
        return $this->dao->select('*')->from(TABLE_FAQ)->where('category')->eq($categoryID)->fetchAll();
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
        $newFAQ->product   = $productID;
        $newFAQ->category  = $categoryID;
        $newFAQ->request   = $this->post->request;
        $newFAQ->answer    = $this->post->answer;
        $newFAQ->addedtime = helper::now();
        $this->dao->insert(TABLE_FAQ)->data($newFAQ)->autoCheck()->exec();
    }

    /**
     * Delete a faq
     * 
     * @param  int $FAQID 
     * @access public
     * @return void
     */
    public function delete($FAQID)
    {
        $this->dao->delete()->from(TABLE_FAQ)->where('id')->eq($FAQID)->exec();
    }
}
