<?php
/**
 * The create view file of user module of zentaoasm.
 *
 * @copyright   Copyright 2009-2011 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     商业软件，未经授权，请立刻删除!
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
  <?php if($type == 'inside'): ?>
  <caption><?php echo $lang->user->inside->createProfile;?></caption>
  <?php endif; ?>
  <?php if($type == 'customer'): ?>
  <caption><?php echo $lang->user->customer->createProfile;?></caption>
  <?php endif; ?>
  <tr>
    <td class='w-120px' align='right'><?php echo $lang->user->account;?></td>
    <td><?php echo html::input('account', '', "class='text-3'"); echo $lang->user->lblAccount;?></td>
  </tr>  
  <tr>
    <td align='right'><?php echo $lang->user->password;?></td>
    <td><?php echo html::input('password1', '', "class='text-3'");?></td>
  </tr>  
  <tr>
    <td align='right'><?php echo $lang->user->password2;?></td>
    <td><?php echo html::input('password2', '', "class='text-3'");?></td>
  </tr>  
  <tr>
    <td align='right'><?php echo $lang->user->realname;?></td>
    <td><?php echo html::input('realname', '', "class='text-3'");?></td>
  </tr>  
  <tr>
    <td align='right'><?php echo $lang->user->gendar;?></td>
    <td><?php echo html::select('gendar', $lang->user->gendarList, '', "class='text-3'");?></td>
  </tr>  
  <?php if($type == 'inside'): ?>
  <tr>
    <td align='right'><?php echo $lang->user->role;?></td>
    <td><?php echo html::select('role', $lang->user->roleList, '', "class='text-3'");?></td>
  </tr>  
  <?php endif; ?>
  <tr>
    <td align='right'><?php echo $lang->user->email;?></td>
    <td><?php echo html::input('email', '', "class='text-3'");?></td>
  </tr>  
  <tr>
    <td align='right'><?php echo $lang->user->mobile;?></td>
    <td><?php echo html::input('mobile', '', "class='text-3'");?></td>
  </tr>  
  <tr>
    <td align='right'><?php echo $lang->user->phone;?></td>
    <td><?php echo html::input('phone', '', "class='text-3'");?></td>
  </tr>  
  <?php if($type == 'customer'): ?>
  <tr>
    <td align='right'><?php echo $lang->user->company;?></td>
    <td><?php echo html::input('company', '', "class='text-3'");?></td>
  </tr>  
  <?php endif; ?>
  <tr>
    <td align='right'><?php echo $lang->user->address;?></td>
    <td><?php echo html::input('address', '', "class='text-3'");?></td>
  </tr>  
  <tr>
    <td align='right'><?php echo $lang->user->zipcode;?></td>
    <td><?php echo html::input('zipcode', '', "class='text-3'");?></td>
  </tr>  
  <tr>
    <td align='right'><?php echo $lang->user->birthday;?></td>
    <td><?php echo html::input('birthday', '', "class='text-3 date'");?></td>
  </tr>  
  <tr>
    <td align='right'><?php echo $lang->user->qq;?></td>
    <td><?php echo html::input('qq', '', "class='text-3'");?></td>
  </tr>  
  <tr>
    <td align='right'><?php echo $lang->user->msn;?></td>
    <td><?php echo html::input('msn', '', "class='text-3'");?></td>
  </tr>  
  <tr>
    <td align='right'><?php echo $lang->user->yahoo;?></td>
    <td><?php echo html::input('yahoo', '', "class='text-3'");?></td>
  </tr>  
  <tr>
    <td align='right'><?php echo $lang->user->gtalk;?></td>
    <td><?php echo html::input('gtalk', '', "class='text-3'");?></td>
  </tr>  
  <tr>
    <td align='right'><?php echo $lang->user->wangwang;?></td>
    <td><?php echo html::input('wangwang', '', "class='text-3'");?></td>
  </tr>  
  <tr><td colspan='2' align='center'><?php echo html::submitButton() . html::resetButton();?></td></tr>
</table>
</form>
<?php include '../../common/view/footer.admin.html.php';?>
