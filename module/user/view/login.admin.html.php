<?php
/**
 * The html template file of login method of user module of XiRangCSM.
 *
 * @copyright   Copyright 2009-2011 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     XiRangCSM
 * @version     $Id$
 */
?>
<?php include '../../common/view/header.lite.html.php';?>
<script language='Javascript'>
$(document).ready(function(){$('#account').focus();})
</script>
<div class="container">
  <form class="form-signin" target='hiddenwin' method='post'>
    <h3 class="form-signin-heading"><?php echo $lang->xirangcsm?></h3>
    <input type="text" id='account' name='account' class="input-block-level" placeholder="<?php echo $lang->user->account?>">
    <input type="password" name='password' class="input-block-level" placeholder="<?php echo $lang->user->password?>">
    <button class="btn btn-primary" type="submit"><?php echo $lang->user->login->common?></button>
  </form>
</div>
<p align='center'><?php echo html::a('http://api.zentao.net/goto.php?item=xirangcsm', sprintf($lang->poweredBy, $config->version), '_blank');?></p>
<?php include '../../common/view/footer.admin.html.php';?>
