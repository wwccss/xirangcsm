<html>
<head>
  <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
  <title><?php echo $lang->zentaocs;?></title>
</head>
<frameset rows='85, *, 37' framespacing='0' frameborder='0'>
  <frame src='<?php echo inlink('topmenu');?>' scrolling='no'>
  <frameset cols='200, *' framespacing='0' frameborder='0'>
    <frame src='<?php echo inlink('leftmenu');?>' scrolling='auto' name='leftwin'>
    <frame src='<?php echo $this->createLink('request', 'browse');?>' name='mainwin' id='mainwin'>
  </frameset>
  <frame src='<?php echo inlink('footer');?>' scrolling='no'>
</frameset>
</html>
