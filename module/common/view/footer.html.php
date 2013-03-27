  </div>
  <div class='a-left' id='copyright'><?php printf($lang->poweredBy, $config->version);?></div>
  <div class='row'><div class='u-1'><iframe name='hiddenwin' id='hiddenwin' class='<?php $config->debug ? print('debugwin') : print('hidden');?>'></iframe></div></div>
</div>
<script laguage='Javascript'>
<?php if(isset($pageJS)) echo $pageJS;?>
</script>
</body>
</html>
