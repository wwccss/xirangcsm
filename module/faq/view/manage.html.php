<?php
/**
 * The manage view of faq module of zentaocs
 *
 * @copyright   Copyright 2009-2011 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     商业软件，未经授权，请立刻删除!
 * @author      Congzhi Chen<congzhi@cnezsoft.com>
 * @package     faq
 * @version     $Id: buildform.html.php 1914 2011-06-24 10:11:25Z yidong@cnezsoft.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<table class='table-2 f-left' style='margin-left:10px'>  
  <caption><?php echo $lang->faq->categoryList;?></caption>
  <tr><td><?php echo html::select('product', $productList, $selectedProductID, 'class=select-3 onchange=switchProduct(this.value)');?></td></tr>
  <?php if(!empty($categories)):?>
  <?php foreach($categories as $id => $category):?>
  <tr>
    <td>
    <?php echo html::a($this->inLink('manage', "productID=$selectedProductID&categoryID=$category->id"), $category->name);?>
    <div class='a-right'><?php echo html::a($this->inLink('create', "productID=$selectedProductID&categoryID=$category->id"), $lang->faq->create);?></div><hr />  
    </td>
  </tr>
  <?php endforeach;?>
  <?php endif;?>
</table>
<table class='table-6 f-left' style='margin-left:10px'>  
  <caption><?php echo ($selectedProductID == '0'? $lang->product->all : $productList[$selectedProductID]) . $lang->arrow . $lang->faq->faqList;?></caption>
  <?php $i = 1; foreach($faqs as $id => $faq):?>
  <tr><td>
  <?php echo $i . '. Q: ' . $faq->request . '?' . "<br />" . 'A:' . $faq->answer; $i++;?><br />
  <div class='a-right'>
  <?php 
  echo html::a($this->inLink('delete', "FAQID=$faq->id"), $lang->faq->delete, "hiddenwin");
  echo html::a($this->inLink('edit', "FAQID=$faq->id"), $lang->faq->edit);
  ?>
  </div><hr />
  </td></tr>
  <?php endforeach;?>
</table>
<?php include '../../common/view/footer.admin.html.php';?>
