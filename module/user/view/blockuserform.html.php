<?php if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>
<div class='box-title'><?php $this->session->user->account == 'guest' ? print($lang->dashboard) : printf($lang->welcome, $this->session->user->account);?></div>
<div class="box-content" id='userform'>
  <?php 
  if($this->session->user->account != 'guest')
  {
      $myServiceLink = html::a($this->createLink('user', 'myService'), $lang->dashboard);
      $logoutLink  = html::a($this->createLink('user', 'logout'), $lang->logout);
      echo $myServiceLink . ' ' . $logoutLink;
  }
  ?>
  <?php if($this->session->user->account == 'guest'):?>
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
  <form method='post' target='hiddenwin' class='bd-none'>
    <table class='table-1' style='border:none'>
      <tr>
        <th class='w-100px'><nobr><?php echo $lang->account;?></nobr></th>
        <td><input type='text' name='account' class='text-2' /></td>
      </tr>
      <tr>
        <th><?php echo $lang->password;?></th>
        <td><nobr><input type='password' name='password' class='text-2' /></nobr></td>
      </tr>
      <tr>
        <td>
          <input type='hidden' value='<?php echo $referer;?>' name='referer' />
        </td>
        <td><?php echo html::submitButton($lang->login);?></td>
      </tr>
    </table>
  </form>
  <?php endif;?>
</div>
