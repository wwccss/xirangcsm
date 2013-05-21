<?php include 'header.lite.html.php';?>
<div class='navbar navbar-fixed-top navbar-inverse'>
  <div class='navbar-inner'>
    <h2 id='logo' class='f-left'><?php echo $this->app->company->name . $lang->frontName?></h2>
    <ul class='nav'>
    <?php
    if(isset($lang->front->menu))
    {
        ksort($lang->front->menu);
        foreach($lang->front->menu as $menu)
        {
            $active ='';
            list($label, $module, $method) = explode('|', $menu);
            if($module == $this->moduleName)
            {
                if(strtolower($method) == strtolower($this->methodName))
                {
                    $active = "class='active'";
                }
                elseif($this->moduleName == 'request' and $this->methodName != 'create' and $method != 'create')
                {
                    $active = "class='active'";
                }
                elseif($this->moduleName == 'user' and $this->methodName == 'edit' and $method == 'profile')
                {
                    $active = "class='active'";
                }
            }
            echo "<li $active>" . html::a($this->createLink($module, $method), $label) . "</li>";
        }
    }
    ?>
    </ul>
    <div class='f-right' id='profile'>
      <?php
      if($this->app->user->account != 'guest')
      {
          echo html::a($this->createLink('user', 'profile'), $this->app->user->realname);
          echo html::a($this->createLink('user', 'logout'), $lang->logout);
      }
      ?>
    </div>
  </div>
</div>
<div id='docbody'>
