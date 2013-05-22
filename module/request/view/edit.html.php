<?php
/**
 * The browse view of request module of zentaoASM
 *
 * @copyright   Copyright 2009-2011 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Jinyong Zhu<zhujinyong@cnezsoft.com>
 * @package     request
 * @version     $Id: buildform.html.php 1914 2011-06-24 10:11:25Z yidong@cnezsoft.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<div>
  <form method='post' target='hiddenwin' enctype='multipart/form-data'>
    <table class='table-1'>
      <caption><?php echo $lang->request->edit;?></caption>
      <tr>
        <th><?php echo $lang->request->product;?></th>
        <td><?php echo html::select('product', $products, $product, "class=select-3 onchange=switchProduct($request->id,this.value)")?></td>
      </tr>
      <tr>
        <th><?php echo $lang->request->category;?></th>
        <td><?php echo html::select('category', $categories, $category, 'class=select-3')?></td>
      </tr>
      <tr>
        <th class='w-100px'><?php echo $lang->request->title;?></th>
        <td><?php echo html::input('title', $title, 'class=text-1');?></td>
      </tr>
      <tr>
        <th><?php echo $lang->request->desc;?></th>
        <td><?php echo html::textarea('desc', $desc, 'style="width:90%" rows=10');?></td>
      </tr>
      <tr>
        <th><?php echo $lang->request->file;?></th>
        <td><?php echo $this->fetch('file', 'printFiles', array('files' => $request->files, 'fieldset' => 'false')). "<br>". $this->fetch('file', 'buildform', 'fileCount=2')?></td>
      </tr>
      <tr><td colspan='2' class='a-center'><?php echo html::submitButton(). html::hidden('requestID', $requestID);?></td></tr>
    </table>
  </form>
</div>
<?php include '../../common/view/footer.html.php';?>
