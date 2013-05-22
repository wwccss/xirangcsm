  </div>
  <div class='a-center' id='copyright'><?php printf($lang->poweredBy, $config->version);?></div>
  <iframe frameborder='0' scrolling='no' name='hiddenwin' id='hiddenwin' class='<?php $config->debug ? print('debugwin') : print('hidden');?>'></iframe>
</div>
<script laguage='Javascript'>
<?php if(isset($pageJS)) echo $pageJS;?>
</script>
</body>
</html>
