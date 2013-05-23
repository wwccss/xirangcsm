<?php include 'header.lite.html.php';?>
<div class='navbar navbar-fixed-top navbar-inverse'>
  <div class='navbar-inner'>
    <?php echo html::a($this->createLink($config->default->module, $config->default->method), $lang->zentaoasm, '', "class='brand'")?>
    <?php commonModel::printMainmenu($this->moduleName);?>
    <div class='f-right' id='profile'>
      <?php
      echo html::a($this->createLink('user', 'profile', "userID={$this->app->user->id}&type=inside"), $this->app->user->realname, '', "class='navbar-link'");
      echo html::a($this->createLink('user', 'logout'), $lang->logout, '', "class='navbar-link'");
      ?>
    </div>
  </div>
</div>
