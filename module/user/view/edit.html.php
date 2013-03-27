<?php
/**
 * The edit view file of user module of zentaoASM.
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
<div class='row'>
  <?php if(RUN_MODE == 'front'):?>
  <div class='u-24-5'>
    <div class='cont-left'><?php include 'blockusermenu.html.php';?></div>
  </div>
  <?php endif;?>
  <div class='u-24-19'>
    <form method='post' enctype='multipart/form-data' target='hiddenwin'>
      <table class='table-5' align='center'>
        <caption><?php if($type == 'customer') echo $lang->user->customer->editProfile; else echo $lang->user->inside->editProfile;?></caption>
        <tr>
          <td class='w-150px' align='right'><?php echo $lang->user->account;?></td>
          <td><?php echo html::input('account', $user->account, "class='text-3'");?></td>
        </tr>  
        <?php if(RUN_MODE == 'admin'): ?>
        <tr>
          <td align='right'><?php echo $lang->user->password;?></td>
          <td><?php echo html::password('password1', '', "class='text-3'") . $lang->user->control->lblPassword;?></td>
        </tr>  
        <tr>
          <td align='right'><?php echo $lang->user->password2;?></td>
          <td><?php echo html::password('password2', '', "class='text-3'");?></td>
        </tr>  
        <?php endif;?>
        <tr>
          <td align='right'><?php echo $lang->user->realname;?></td>
          <td><?php echo html::input('realname', $user->realname, "class='text-3'");?></td>
        </tr>  
        <tr>
          <td align='right'><?php echo $lang->user->gendar;?></td>
          <td><?php echo html::select('gendar', $lang->user->gendarList, $user->gendar, "class='text-3'");?></td>
        </tr>  
        <?php if($type == 'inside'): ?>
        <tr>
          <td align='right'><?php echo $lang->user->role;?></td>
          <td><?php echo html::select('role', $lang->user->roleList, $user->role, "class='text-3'");?></td>
        </tr>  
        <?php endif; ?>
        <tr>
          <td align='right'><?php echo $lang->user->email;?></td>
          <td><?php echo html::input('email', $user->email, "class='text-3'");?></td>
        </tr>  
        <tr>
          <td align='right'><?php echo $lang->user->mobile;?></td>
          <td><?php echo html::input('mobile', $user->mobile, "class='text-3'");?></td>
        </tr>  
        <tr>
          <td align='right'><?php echo $lang->user->phone;?></td>
          <td><?php echo html::input('phone', $user->phone, "class='text-3'");?></td>
        </tr>  
        <?php if($type == 'customer'): ?>
        <tr>
          <td align='right'><?php echo $lang->user->company;?></td>
          <td><?php echo html::input('company', $user->company, "class='text-3'");?></td>
        </tr>  
        <?php endif; ?>
        <tr>
          <td align='right'><?php echo $lang->user->address;?></td>
          <td><?php echo html::input('address', $user->address, "class='text-3'");?></td>
        </tr>  
        <tr>
          <td align='right'><?php echo $lang->user->zipcode;?></td>
          <td><?php echo html::input('zipcode', $user->zipcode, "class='text-3'");?></td>
        </tr>  
        <tr>
          <td align='right'><?php echo $lang->user->birthday;?></td>
          <td><?php echo html::input('birthday', $user->birthday, "class='text-3 date'");?></td>
        </tr>  
        <tr>
          <td align='right'><?php echo $lang->user->qq;?></td>
          <td><?php echo html::input('qq', $user->qq, "class='text-3'");?></td>
        </tr>  
        <tr>
          <td align='right'><?php echo $lang->user->msn;?></td>
          <td><?php echo html::input('msn', $user->msn, "class='text-3'");?></td>
        </tr>  
        <tr>
          <td align='right'><?php echo $lang->user->yahoo;?></td>
          <td><?php echo html::input('yahoo', $user->yahoo, "class='text-3'");?></td>
        </tr>  
        <tr>
          <td align='right'><?php echo $lang->user->gtalk;?></td>
          <td><?php echo html::input('gtalk', $user->gtalk, "class='text-3'");?></td>
        </tr>  
        <tr>
          <td align='right'><?php echo $lang->user->wangwang;?></td>
          <td><?php echo html::input('wangwang', $user->wangwang, "class='text-3'");?></td>
        </tr>  
        <tr><td colspan='2' align='center'><?php echo html::submitButton() . html::resetButton();?></td></tr>
      </table>
    </form>
  </div>
</div>
<?php if(RUN_MODE == 'admin'): ?>
<?php include '../../common/view/footer.admin.html.php';?>
<?php endif;?>
<?php if(RUN_MODE == 'front'): ?>
<?php include '../../common/view/footer.html.php';?>
<?php endif;?>
