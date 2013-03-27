<?php
/**
 * The edit view of faq module of zentaoasm
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
<?php include '../../common/view/kindeditor.html.php';?>
<form method='post' target="hiddenwin">
<table class='table-1' align='center'>
  <caption><?php echo $lang->faq->edit;?></caption>
  <tr>
    <th><?php echo $lang->faq->title;?></th>
    <td><?php echo html::input('request', $FAQ->request, 'class=text-1');?></td>
  </tr>
  <tr>
    <th><?php echo $lang->faq->answer;?></th>
    <td><?php echo html::textarea('answer', $FAQ->answer, 'style="width:90%" rows=20');?></td>
  </tr>
  <tr class='a-center'>
    <td colspan='2'>
    <?php echo html::submitButton() . html::hidden('productID', $FAQ->product) . html::hidden('categoryID', $FAQ->category);?>
    </td>
  </tr>
</table>
</form>
<?php include '../../common/view/footer.admin.html.php';?>
