<?php
/**
 * The manage view of product module of zentaoASM
 *
 * @copyright   Copyright 2009-2011 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Congzhi Chen<congzhi@cnezsoft.com>
 * @package     product
 * @version     $Id: buildform.html.php 1914 2011-06-24 10:11:25Z yidong@cnezsoft.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<table class='table-5 bd-none' align='center'>
  <tr valign='top'>
    <td class='a-left' width='45%'>
      <form method='post' target='hiddenwin' action='<?php echo $this->inLink('updateOrder');?>'>
      <table width='100%'>
        <caption><?php echo $lang->product->productManage;?></caption>  
        <tr>
          <td class='a-left'>
            <ul class='tree'>
            <?php 
            foreach($products as $product)
            {
                echo "<li>";
                echo $product->name . ' ';
                echo html::input("orders[$product->id]", "$product->order", "class='w-20px'");
                if($product->status == 'stopped')
                {
                    echo html::a($this->inLink('online', "productID=$product->id"), $lang->product->online, 'hiddenwin');
                }
                if($product->status != 'stopped')
                {
                    echo html::a($this->inLink('stop', "productID=$product->id"), $lang->product->stop, 'hiddenwin');
                }
                echo $lang->product->statusList[$product->status];
                echo '</li>';
            }
            ?>
            </ul>
          </td>
        </tr>
        <tr><td class='a-center'><?php echo html::submitButton($lang->product->updateOrder);?></td></tr>
      </table>
      </form>
    </td>
    <td class='a-left'>
      <form method='post' target='hiddenwin'>
      <table class='table-1'>
        <caption><?php echo $lang->product->changeOrAdd;?></caption>  
        <tr>
          <td class='a-center'>
          <?php 
          foreach($products as $product) echo html::input("products[$product->id]", $product->name, "class='text-2'") . '<br />';
          for($i = 0; $i < PRODUCT::NEW_PRODUCT_COUNT; $i ++) echo html::input("products[]", '', "class='text-2'") . '<br />';
          echo html::submitButton();
          ?>
          </td>
        </tr>
      </table>
      </form>
    </td>
  </tr>
</table>
<?php include '../../common/view/footer.admin.html.php';?>
