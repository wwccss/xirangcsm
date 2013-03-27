<?php
/**
 * The modify password view file of user module of zentaoASM.
 *
 * @copyright   Copyright 2009-2011 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Yangyang Shi <shiyangyang@cnezsoft.com>
 * @package     User
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>
<form method='post' enctype='multipart/form-data' target='hiddenwin'>
<table class='table-5 fixed' align='center'>
  <caption><?php echo $lang->user->addProductService;?></caption>
  <tr>
    <td class='w-120px' align='right'><?php echo $lang->user->product;?></td>
    <td><?php echo html::select('product', $products, '', "class='text-3'");?></td>
  </tr>  
  <tr>
    <td class='w-120px' align='right'><?php echo $lang->user->serviceTime;?></td>
    <td><?php echo html::input('serviceTime', '', "class='text-3 date'");?></td>
  </tr>  
  <tr><td colspan='2' align='center'><?php echo html::submitButton() . html::resetButton();?></td></tr>
</table>
</form>
<?php include '../../common/view/footer.admin.html.php';?>
