<?php
/**
 * The request view file of request module of ZenTaoASM.
 *
 * @copyright   Copyright 2009-2011 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     request
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<div class='row' id='top' name='top'>
  <div class='u-24-5'>
    <div class='cont-left'>
      <div class='box-title'><?php echo $lang->faq->categoryList;?></div>
      <div class='box-content'>
        <ul>
          <li style="list-style-type:none"><?php echo html::select('product', $productList, $selectedProductID, 'class=select-2 onchange=switchProduct(this.value)');?></li>
          <?php if(!empty($categories)):?>
          <?php foreach($categories as $id => $category):?>
          <li style="list-style-type:none">&#160;&#160;&rsaquo;&rsaquo;&#160;&#160;<?php echo html::a(inlink('showFAQ', "productID=$selectedProductID&categoryID=$category->id"), $category->name);?></li>
          <?php endforeach;?>
          <?php endif;?>  
        </ul>
      </div>
      <div class='box-title'><?php echo $lang->faq->customBox;?></div>
      <div class='box-content'>
        <p align='center'><?php echo html::linkButton($lang->faq->request, $this->createLink('request', 'create'))?></p>
        <p align='center'><?php echo html::linkButton($lang->login, $this->createLink('user', 'index'))?></p>
      </div>
    </div>
  </div>
  <div class='u-24-19'>
    <div class='cont'>
      <div class='box-title'><?php echo $lang->faq->faqList;?></div>
      <div id="topic">
        <ul>
        <?php $i = 1; foreach($faqs as $id => $faq):?>
          <li><a href='<?php echo "#content$i";?>'><?php echo $faq->request . '?' ; $i++;?></a></li>
        <?php endforeach;?>
        </ul>
      </div>
      <div id="faqContent">
      <?php $i = 1; foreach($faqs as $id => $faq):?>
        <h3>
          <div class="a-left"><a id="<?php echo "content$i";?>" name="<?php echo "content$i";?>"><?php echo $faq->request . '?';?></a>
          <a class='f-right' href='#top'><?php echo $lang->faq->toTop;?></a></div>
        </h3>  
        <p><?php echo $faq->answer; $i++;?></p>
      <?php endforeach;?>
      </div>
    </div>
  </div>
</div>
<?php include '../../common/view/footer.html.php';?>
