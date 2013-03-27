<?php
$config->webRoot = $this->install->getWebRoot();
$clientTheme     = $this->app->getClientTheme();
$webRoot         = $this->config->webRoot;
$jsRoot          = $webRoot . "js/";
$defaultTheme    = $webRoot . 'theme/default/';
?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dli'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
  <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
  <?php
  echo html::title($header->title);

  js::exportConfigVars();
  js::import($jsRoot . 'jquery/lib.js');
  js::import($jsRoot . 'my.js');

  css::import($defaultTheme . 'yui.css');
  css::import($defaultTheme . 'style.css');
  ?>
<style>
.ok{background:green; color:white}
.fail{background:red; color:white}
body, html{background:white}
th, td {padding:10px; font-size:16px}
</style>
<script type="text/javascript">loadFixedCSS();</script>
</head>
<body style='margin-top:50px'>
