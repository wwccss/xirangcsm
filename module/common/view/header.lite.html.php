<?php
$webRoot      = $this->app->getWebRoot();
$jsRoot       = $webRoot . "js/";
$themeRoot    = $webRoot . "theme/";
$defaultTheme = $webRoot . 'theme/default/';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8'>
<?php
    $header = isset($header) ? (object)$header : new stdclass();
    if(!isset($header->title))    $header->title    = $lang->xirangcsm;
    if(!isset($header->keywords)) $header->keywords = '';
    if(!isset($header->desc))     $header->desc     = '';
    echo html::title($header->title);
    echo html::meta('keywords',    $header->keywords);
    echo html::meta('description', $header->desc);

  js::exportConfigVars();
  js::import($jsRoot . 'jquery/lib.js');
  js::import($jsRoot . 'jquery/bootstrap/bootstrap.min.js');
  js::import($jsRoot . 'my.js');

  css::import($defaultTheme . "bootstrap.css");
  css::import($defaultTheme . "style.css");
  if(isset($pageCss)) css::internal($pageCss);

  echo html::icon($webRoot . 'favicon.ico');
?>
</head>
<body><div id='docbox' class='container'>
