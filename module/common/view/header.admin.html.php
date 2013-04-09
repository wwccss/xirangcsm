<?php include 'header.lite.html.php';?>
<div class='navbar navbar-fixed-top navbar-inverse'>
  <div class='navbar-inner'>
    <h2 id='logo' class='f-left'><?php echo $lang->zentaoasm?></h2>
    <?php commonModel::printMainmenu($this->moduleName);?>
    <div class='f-right' id='profile'>
      <?php
      echo html::a($this->createLink('user', 'profile', "userID={$this->app->user->id}&type=inside"), $this->app->user->realname);
      echo html::a($this->createLink('user', 'logout'), $lang->logout);
      ?>
    </div>
  </div>
</div>
