<?php include '../../common/view/header.admin.html.php';?>
<style>
html{background:#403d3c}
#topmenu{ width:100%;margin-top:4px; background:url('<?php echo $defaultTheme?>images/default/topmenu_bg.png') repeat-x; color:#000;padding:20px 5px;}
#topmenu img{ padding:0 10px;}
</style>
<body>
<div id='topmenu'>
<img src='<?php echo $defaultTheme?>images/default/admin_logo.png'/>
<?php printf($lang->welcome, $app->user->realname);?>
</div>
</body>
</html>
