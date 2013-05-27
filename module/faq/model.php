<?php
/**
 * The model file of faq module of XiRangCSM
 *
 * @copyright   Copyright 2009-2011 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
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
        $faq = new stdclass();
        $faq->product   = $productID;
        $faq->category  = $categoryID;
        $faq->request   = $this->post->request;
        $faq->answer    = $this->post->answer;
        $faq->addedtime = helper::now();
        $this->dao->insert(TABLE_FAQ)->data($faq)->autoCheck()->batchCheck($this->config->faq->create->requiredFields, 'notempty')->exec();
    }

    public function update($faqID)
    {
        $faq = fixer::input('post')->get();
        $this->dao->update(TABLE_FAQ)->data($faq)->where('id')->eq($faqID)->autoCheck()->batchCheck($this->config->faq->edit->requiredFields, 'notempty')->exec();
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
