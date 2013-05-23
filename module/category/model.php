<?php
/**
 * The model file of category module of zentaoASM
 *
 * @copyright   Copyright 2009-2011 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Congzhi <congzhi@cnezsoft.com>
 * @package     category
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php
class categoryModel extends model
{
    /**
     * Get all categories 
     * 
     * @param int $productID
     * @access public
     * @return object
     */
    public function getByProductID($productID = 0)
    {
        return $this->dao->select('*')->from(TABLE_CATEGORY)->where('product')->eq($productID)->orderBy('`order`')->fetchAll('id');
    }

    /**
     * GetPairs
     * 
     * @access public
     * @return object
     */
    public function getPairs()
    {
        $categories = $this->dao->select('id, name')->from(TABLE_CATEGORY)->orderBy('`order`')->fetchPairs();
        $categories = array('' => '') + $categories;
        return $categories;
    }

    /**
     * Get category by ID
     * 
     * @param int $categoryID 
     * @access public
     * @return object
     */
    public function getByID($categoryID)
    {
        return $this->dao->select('*')->from(TABLE_CATEGORY)->where('id')->eq($categoryID)->fetch();
    }

    /**
     * Delete a category
     * 
     * @param int $categoryID 
     * @access public
     * @return void
     */
    public function delete($categoryID)
    {
        $this->dao->delete()->from(TABLE_CATEGORY)->where('id')->eq($categoryID)->exec();
    }

    /**
     * Update categories's order
     * 
     * @param array $orders 
     * @access public
     * @return void
     */
    public function updateOrder($orders)
    {
        foreach($orders as $categoryID => $order)
            $this->dao->update(TABLE_CATEGORY)->set('`order`')->eq($order)->where('id')->eq($categoryID)->andWhere('product')->eq($this->post->productID)->exec();
    }

    /**
     * Update categories 
     * 
     * @param array $categories 
     * @access public
     * @return void
     */
    public function updateCategories($categories)
    {
        $newCategory = new stdclass();
        $i           = 1;
        $isEmpty     = $this->dao->select('*')->from(TABLE_CATEGORY)->fetchAll();
        if(!empty($categories['0']) && empty($isEmpty))
        {
            foreach($categories as $id => $category)
            {
                if(empty($category)) continue;
                $order = 10 * $i;
                $newCategory->id      = $i;
                $newCategory->name    = $category;
                $newCategory->order   = $order;
                $newCategory->product = $this->post->productID;
                $this->dao->insert(TABLE_CATEGORY)->data($newCategory)->exec();
                $i++;
            }
        }
        else
        {
            foreach($categories as $id => $category)
            {
                if(empty($category)) continue;
                $isExist = $this->dao->select('*')->from(TABLE_CATEGORY)->where('id')->eq($id)->andWhere('product')->eq($this->post->productID)->fetch();
                $order = 10 * $i;
                if(!empty($isExist)) 
                {
                    $this->dao->update(TABLE_CATEGORY)->set('name')->eq($category)->set('`order`')->eq($order)->where('id')->eq($id)->exec();
                }
                else
                {
                    $newCategory->name    = $category;
                    $newCategory->order   = $order;
                    $newCategory->product = $this->post->productID;
                    $this->dao->insert(TABLE_CATEGORY)->data($newCategory)->exec();
                }
                $i++;
            }
        }
    }
}
