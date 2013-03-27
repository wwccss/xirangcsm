<?php if($config->features->user) include $app->getModuleRoot(). 'user/view/blockuserform.html.php';?>
<div class='box-title'><?php echo $lang->articleTree;?></div>
<div class='box-content'><?php echo $articleTree;?></div>
<?php $this->block->printBlock($layouts, 'left');?>
