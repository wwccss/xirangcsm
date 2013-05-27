<?php
/**
 * The manage view of category module of XiRangCSM
 *
 * @copyright   Copyright 2009-2011 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Congzhi Chen<congzhi@cnezsoft.com>
 * @package     category
 * @version     $Id: buildform.html.php 1914 2011-06-24 10:11:25Z yidong@cnezsoft.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<table class='table-5 bd-none' align='center'>
  <tr valign='top'>
    <td width='45%' class='a-left'>
      <form method='post' target='hiddenwin' action='<?php echo $this->inLink('updateOrder');?>' class='form-horizontal'>
      <table width='100%'>
        <caption><?php echo $lang->category->categoryManage;?></caption>  
        <?php if($productList):?>
        <tr><td><?php echo html::select('product', $productList, $productID, 'class=select-1 onchange=switchProduct(this.value)');?></td></tr>
        <tr>
          <td class='a-left'>
            <ul class='tree'>
            <?php 
            if(!empty($categories))
            {
              foreach($categories as $category)
              {
                  echo "<li>";
                  echo $category->name . ' ';
                  echo html::a($this->inLink('delete', "categoryID=$category->id"), $lang->delete, 'hiddenwin');
                  echo html::input("orders[$category->id]", "$category->order", "class='w-20px'");
                  echo '</li>';
              }
            }
            ?>
            </ul>
          </td>
        </tr>
        <tr><td class='a-center'><?php echo html::submitButton($lang->category->updateOrder) . html::hidden('productID', $productID);?></td></tr>
        <?php else:?>
        <tr><td class='a-center'><?php echo $lang->product->none?></td></tr>
        <?php endif;?>
      </table>
      </form>
    </td>
    <td class='a-left'>
      <form method='post' target='hiddenwin'>
      <table class='table-1'>
        <caption><?php echo $lang->category->changeOrAdd;?></caption>  
        <tr>
          <td class='a-center'>
          <?php 
          if(!empty($categories))
          {
            foreach($categories as $category) echo html::input("categories[$category->id]", $category->name, "class='text-2'") . '<br />';
          }
          if($productID != 0)
          {
            for($i = 0; $i < CATEGORY::NEW_CATEGORY_COUNT; $i ++) echo html::input("categories[]", '', "class='text-2'") . '<br />';
            echo html::submitButton() . html::hidden('productID', $productID);
          }
          ?>
          </td>
        </tr>
      </table>
      </form>
    </td>
  </tr>
</table>
<?php include '../../common/view/footer.admin.html.php';?>
