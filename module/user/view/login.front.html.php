<?php include '../../common/view/header.html.php';?>
<script language='Javascript'>
$(document).ready(function(){$('#account').focus();})
</script>
<div class="container">
  <?php
  if(empty($referer))
  {
     if(!$this->server->http_referer or 
         strpos($this->server->http_referer, $app->site->domain) == false or 
         strpos($this->server->http_referer, 'log') != false)
     {
         $referer = urlencode($this->createLink('user', 'myService'));
     }    
     else
     {
         $referer = $this->server->http_referer;
     }
  }   
  ?>
  <form class="form-signin" target='hiddenwin' method='post'>
    <h3 class="form-signin-heading"><?php $this->session->user->account == 'guest' ? print($lang->dashboard) : printf($lang->welcome, $this->session->user->account);?></h3>
    <input type="text" id='account' name='account' class="input-block-level" placeholder="<?php echo $lang->user->account?>">
    <input type="password" name='password' class="input-block-level" placeholder="<?php echo $lang->user->password?>">
    <button class="btn btn-primary" type="submit"><?php echo $lang->user->login->common?></button>
    <span class='help-inline'><?php echo html::a(inlink('reset'), $lang->user->forgetPassword)?></span>
    <input type='hidden' value='<?php echo $referer;?>' name='referer' />
  </form>
</div>
<?php include '../../common/view/footer.html.php';?>
