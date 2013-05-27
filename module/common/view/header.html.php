<?php include 'header.lite.html.php';?>
<div class='navbar navbar-fixed-top navbar-inverse'>
  <div class='navbar-inner'>
    <?php echo html::a($this->config->webRoot, $this->app->company->name . $lang->frontName, '', "class='brand'")?>
    <ul class='nav'>
    <?php
    js::set('methodName', $methodName);
    echo "<li id='showfaqMenu'>" . html::a($this->createLink('faq', 'showFAQ'), $lang->frontMenu->faq) . "</li>";
    echo "<li id='createMenu'>"  . html::a($this->createLink('request', 'create'), $lang->frontMenu->createRequest) . "</li>";
    if($this->app->user->account != 'guest')
    {
        echo "<li id='browseMenu'>"    . html::a($this->createLink('request', 'browse'), $lang->frontMenu->browseRequest) . "</li>";
        echo "<li id='myserviceMenu'>" . html::a($this->createLink('user', 'myService'), $lang->frontMenu->myService) . "</li>";
    }
    ?>
    </ul>
    <div class='f-right' id='profile'>
      <?php
      if($this->app->user->account != 'guest')
      {
          echo html::a($this->createLink('user', 'profile'), $this->app->user->realname, '', "class='navbar-link'");
          echo html::a($this->createLink('user', 'logout'), $lang->logout, '', "class='navbar-link'");
      }
      else
      {
          echo html::a($this->createLink('user', 'login'), $lang->login, '', "class='navbar-link'");
      }
      ?>
    </div>
  </div>
</div>
<div id='docbody'>
