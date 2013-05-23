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
<div>
  <div class='span2'>
    <div id='sidenav'>
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
    </div>
  </div>
  <div class='span10'>
    <ul class="breadcrumb">
      <li><?php echo $lang->faq->faqList?> <span class="divider">/</span></li>
      <li><?php echo html::a(inlink('showFAQ', "productID=$selectedProductID"), $productList[$selectedProductID])?> <span class="divider">/</span></li>
      <?php if(isset($categories[$categoryID])):?>
      <li class="active"><?php echo $categories[$categoryID]->name?></li>
      <?php endif;?>
    </ul>
    <div id="topic">
      <ul>
      <?php $i = 1; foreach($faqs as $id => $faq):?>
        <li><a href='<?php echo "#content$i";?>'><?php echo $faq->request . '?' ; $i++;?></a></li>
      <?php endforeach;?>
      </ul>
    </div>
    <div id="faqContent">
    <?php $i = 1; foreach($faqs as $id => $faq):?>
      <div>
        <?php echo $lang->faq->request . " : "?>
        <span id="<?php echo "content$i";?>" class='strong' name="<?php echo "content$i";?>"><?php echo $faq->request . ' ?';?></span>
        <a class='f-right' href='#top' title='<?php echo $lang->faq->toTop?>'><?php echo $lang->faq->toTop;?></a>
      </div>
      <p>
        <?php
        echo $lang->faq->answer . ' : ';
        echo $faq->answer; $i++;
        ?>
      </p>
      <hr />
    <?php endforeach;?>
    </div>
  </div>
</div>
<?php include '../../common/view/footer.html.php';?>
