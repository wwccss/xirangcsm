<div class='box-title'><?php echo $lang->user->control->common;?></div>
<div class='box-content a-center'>
  <ul class='listmenu'>
  <?php
  ksort($lang->user->control->menus);
  foreach($lang->user->control->menus as $menu)
  {
      list($label, $module, $method) = explode('|', $menu);
      echo '<li>' . html::a($this->createLink($module, $method), $label) . '</li>';
  }
  ?>
  </ul>
</div>
