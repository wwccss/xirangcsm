<?php include '../../common/view/header.admin.html.php';?>
<style>
#footer{background:url('<?php echo $defaultTheme?>images/default/footer.png') repeat-x; height:37px; line-height:37px; color:#717171}
#footer a{color:#717171}
</style>
<body id='footer'>
  <div class='a-center'><?php printf($lang->poweredBy, $config->version);?></div>
</body>
</html>
