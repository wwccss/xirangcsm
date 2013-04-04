<?php
/**
 * The html template file of login method of user module of ZenTaoASM.
 *
 * @copyright   Copyright 2009-2011 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     ZenTaoASM
 * @version     $Id$
 */
include '../../common/view/header.lite.html.php';
?>
<style>
html{background:#080404;}
body{background:#080404;}
#box-login{ background:url('<?php echo $defaultTheme?>images/default/login_top.jpg') no-repeat center top #080404; padding-top:11px;}
#welcome{ background:url('<?php echo $defaultTheme?>images/default/login_center1.jpg') repeat-y center;border:none; height:120px; text-align:center; margin:0px;}
#welcome img{margin-top:25px;}
#box-login tbody{background:url('<?php echo $defaultTheme?>images/default/login_center2.jpg') repeat-y center; color:#fff; font-size:16px;}
#box-login tbody a{color:#fff; font-size:12px; margin:10px;}
#box-login tbody th{text-indent:-120px;}
#box-login tbody input{background:url('<?php echo $defaultTheme?>images/default/login_input.png') no-repeat center; border:none; height:27px; width:182px;line-height:27px; margin-bottom:10px; padding-left:10px;}
#box-login tbody #submit{width:102px; height:27px; margin:0px;}
#box-login form{ background:url('<?php echo $defaultTheme?>images/default/login_bottom.jpg') no-repeat center bottom; padding-bottom:4px;}
#box-login p{margin-top:5px; font-size:14px; color:#fff;word-spacing:0.001em;}
#box-login p a{ color:#fff; text-decoration:none}
#hiddenwin{background:#080404;}
</style>
<script language='Javascript'>
$(document).ready(function(){
    $('#account').focus();
})
</script>
<div id='box-login' class='row' style='margin-top:240px;'>
  <form method='post' target='hiddenwin'>
    <table align='center' class='bd-none table-5'> 
    <caption id='welcome'><img src='<?php echo $defaultTheme?>images/default/logo.jpg' /></caption>
    <tbody class='a-center'>
      <tr>
        <th><?php echo $lang->user->admin->account;?>：</th>  
      </tr>  
      <tr>
        <td><?php echo html::input('account', '', "'class=text-1'");?></td>
      </tr>  
      <tr>
        <th><?php echo $lang->user->admin->password;?>：</th> 
      </tr>
      <tr>
        <td><?php echo html::password('password', '', "'class=text-1'");?></td>
      </tr>
      <tr>
        <td colspan='2' valign='top'>
          <input id='submit' type="image" src='<?php echo $defaultTheme?>images/default/submit_img.png' style='padding-left:0px;'/>
          <?php 
          echo html::a(inlink('reset'), $lang->user->forgetPassword);
          echo html::hidden('referer', $referer);
          ?>
        </td>
      </tr>  
    </tbody>
    </table>
  </form>
  <p align='center'><?php echo html::a('http://www.zentao.net/goto.php?item=zentaoasm', sprintf($lang->poweredBy, $config->version), '_blank');?></p>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
