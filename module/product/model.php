<?php
/**
 * The model file of product module of XiRangCSM
 *
 * @copyright   Copyright 2009-2011 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Congzhi <congzhi@cnezsoft.com>
 * @package     product
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php
class productModel extends model
{
    /**
     * Get all products 
     * 
     * @access public
     * @return object
     */
    public function getAllProducts()
    {
        return $this->dao->select('*')->from(TABLE_PRODUCT)->orderBy('`order`')->fetchAll();
    }

    /**
     * Get product Pairs 
     * 
     * @access public
     * @return array
     */
    public function getPairs()
    {
        return $this->dao->select('id, name')->from(TABLE_PRODUCT)->where('status')->ne('stopped')->orderBy('`order`')->fetchPairs();
    }

    /**
     * Get has service of product
     * 
     * @access public
     * @return array
     */
    public function getProductService()
    {
        $productIds = $this->dao->select('*')->from(TABLE_SERVICETIME)
            ->where('user')->eq($this->app->user->id)
            ->andWhere('serviceTime')->gt(date('Y-m-d'))
            ->orWhere('serviceTime')->eq(date('Y-m-d'))
            ->fetchAll('product');
        return $this->dao->select('id, name')->from(TABLE_PRODUCT)
            ->where('id')->in(array_keys($productIds))
            ->andWhere('status')->eq('online')
            ->orderBy('`order`')->fetchPairs();
    }

    /**
     * Get product by productID 
     * 
     * @param int $productID 
     * @access public
     * @return object
     */
    public function getByID($productID)
    {
        return $this->dao->select('*')->from(TABLE_PRODUCT)->where('id')->eq($productID)->fetch();
    }

    /**
     * Change product status 
     * 
     * @param  int $productID 
     * @param  string $status 
     * @access public
     * @return void
     */
    public function changeProductStatus($productID, $status)
    {
        $this->dao->update(TABLE_PRODUCT)->set('status')->eq($status)->where('id')->eq($productID)->exec();
    }

    /**
     * Update products' order 
     * 
     * @param array $orders 
     * @access public
     * @return void
     */
    public function updateOrder($orders)
    {
        foreach($orders as $productID => $order)
            $this->dao->update(TABLE_PRODUCT)->set('`order`')->eq($order)->where('id')->eq($productID)->exec();
    }

    /**
     * Update Products 
     * 
     * @param array $products 
     * @access public
     * @return void
     */
    public function updateProducts($products)
    {
        $i          = 1;
        $newProduct = new stdclass();
        if(!empty($products['0']))
        {
            foreach($products as $id => $product)
            {
                if(empty($product)) continue;
                $order = 10 * $i;
                $newProduct->id     = $i;
                $newProduct->name   = $product;
                $newProduct->order  = $order;
                $newProduct->status = 'online';
                $this->dao->insert(TABLE_PRODUCT)->data($newProduct)->exec();
                $i++;
            }
        }
        else
        {
            foreach($products as $id => $product)
            {
                if(empty($product)) continue;
                $isExist = $this->dao->select('*')->from(TABLE_PRODUCT)->where('id')->eq($id)->fetch();
                $order = 10 * $i;
                if(!empty($isExist)) 
                {
                    $this->dao->update(TABLE_PRODUCT)->set('name')->eq($product)->set('`order`')->eq($order)->where('id')->eq($id)->exec();
                }
                else
                {
                    $newProduct->name   = $product;
                    $newProduct->order  = $order;
                    $newProduct->status = 'online';
                    $this->dao->insert(TABLE_PRODUCT)->data($newProduct)->exec();
                }
                $i++;
            }
        }
    }
}
