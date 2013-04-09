<style type='text/css'>
#sidenav.affix{top:10px;}
</style>
<div class='affix-top' id='sidenav'>
<div class='box-title'><?php echo $lang->user->control->common;?></div>
<div class='box-content a-center'>
  <ul class='listmenu affix-top'>
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
</div>
<script type='text/javascript'>
$(function(){
     $('#sidenav').width($('#sidenav').width()); 
     $('#sidenav').affix({ offset: { top: 90 } });
})
</script>
