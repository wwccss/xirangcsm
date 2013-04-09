<?php
/**
 * The edit view of company module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     company
 * @version     $Id: edit.html.php 4488 2013-02-27 02:54:49Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<form method='post' target='hiddenwin' id='dataform'>
  <table align='center' class='table-5 table-bordered'> 
    <caption><?php echo $lang->company->edit;?></caption>
    <tr>
      <th class='rowhead'><?php echo $lang->company->name;?></th>
      <td><?php echo html::input('name', $company->name, "class='text-1'");?></td>
    </tr>  
    <tr><td colspan='2' class='a-center'><?php echo html::submitButton();?></td></tr>
  </table>
</form>
<?php include '../../common/view/footer.admin.html.php';?>
