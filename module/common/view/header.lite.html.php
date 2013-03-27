<?php
$webRoot      = $this->app->getWebRoot();
$jsRoot       = $webRoot . "js/";
$themeRoot    = $webRoot . "theme/";
$defaultTheme = $webRoot . 'theme/default/';
?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dli'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
  <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<?php
    $header = isset($header) ? (object)$header : new stdclass();
    if(!isset($header->title))    $header->title    = $lang->zentaocs;
    if(!isset($header->keywords)) $header->keywords = '';
    if(!isset($header->desc))     $header->desc     = '';
    echo html::title($header->title);
    echo html::meta('keywords',    $header->keywords);
    echo html::meta('description', $header->desc);

  js::exportConfigVars();
  js::import($jsRoot . 'jquery/lib.js');
  js::import($jsRoot . 'my.js');

  css::import($defaultTheme . "yui.css");
  css::import($defaultTheme . "style.css");
  if(RUN_MODE == 'front') css::import($themeRoot . 'default/front.css');
  if(RUN_MODE == 'admin') css::import($themeRoot . 'default/admin.css');
  if(isset($pageCss)) css::internal($pageCss);

  echo html::icon($webRoot . 'favicon.ico');
?>
<script type="text/javascript">loadFixedCSS();</script>
</head>
<body><div id='docbox'>
