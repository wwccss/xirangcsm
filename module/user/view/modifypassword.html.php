<?php
/**
 * The modify password view file of user module of XiRangCSM.
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
<form method='post' target='hiddenwin'>
  <table class='table-5' align='center'>
    <caption class='a-left'><?php echo $lang->user->modifyPassword; ?></caption>
    <tr>
      <td align='right'><?php echo $lang->user->oldPassword; ?></td>
      <td><?php echo html::password('oldpassword', '', "class='text-3'"); ?></td>
    </tr>
    <tr>
      <td align='right'><?php echo $lang->user->password; ?></td>
      <td><?php echo html::password('password', '', "class='text-3'"); ?></td>
    </tr>
    <tr>
      <td align='right'><?php echo $lang->user->password2; ?></td>
      <td><?php echo html::password('password2', '', "class='text-3'"); ?></td>
    </tr>
    <tr><td colspan='2' align='center'><?php echo html::submitButton() . html::resetButton();?></td></tr>
  </table>
</form>
<?php include '../../common/view/footer.html.php';?>
