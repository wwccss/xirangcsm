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
?>
<?php include '../../common/view/header.lite.html.php';?>
<style type="text/css">
  body {
    padding-top: 40px;
    padding-bottom: 40px;
    background-color: #f5f5f5;
   }
  .form-signin {
    max-width: 300px;
    padding: 19px 29px 29px;
    margin: 0 auto 20px;
    background-color: #fff;
    border: 1px solid #e5e5e5;
    -webkit-border-radius: 5px;
       -moz-border-radius: 5px;
            border-radius: 5px;
    -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
       -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
            box-shadow: 0 1px 2px rgba(0,0,0,.05);
  }
  .form-signin .form-signin-heading,
  .form-signin .checkbox {
    margin-bottom: 10px;
  }
  .form-signin input[type="text"],
  .form-signin input[type="password"] {
    font-size: 16px;
    height: auto;
    margin-bottom: 15px;
    padding: 7px 9px;
  }
</style>
<script language='Javascript'>
$(document).ready(function(){$('#account').focus();})
</script>
<div class="container">
  <form class="form-signin" target='hiddenwin' method='post'>
    <h2 class="form-signin-heading"><?php echo $lang->zentaoasm?></h2>
    <input type="text" name='account' class="input-block-level" placeholder="<?php echo $lang->user->account?>">
    <input type="password" name='password' class="input-block-level" placeholder="<?php echo $lang->user->password?>">
    <button class="btn btn-large btn-primary" type="submit"><?php echo $lang->user->login->common?></button>
  </form>
</div>
<p align='center'><?php echo html::a('http://www.zentao.net/goto.php?item=zentaoasm', sprintf($lang->poweredBy, $config->version), '_blank');?></p>
<?php include '../../common/view/footer.admin.html.php';?>
