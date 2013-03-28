<?php if(isset($users[$action->actor])) $action->actor = $users[$action->actor];?>
<span><?php $this->action->printAction($action);?>
<?php if(!empty($action->comment)):?>
<div class='history'>
<?php echo nl2br($action->comment);?>
</div>
<?php endif;?>
<style>
del  {background:#fcc}
ins  {background:#cfc; text-decoration:none}
table, tr, th, td {border:1px solid gray; font-size:12px; border-collapse:collapse}
tr, th, td {padding:5px}
.history {border:1px solid gray; padding:10px; margin-top:10px; margin-bottom:10px}
.header  {background:#efefef}
</style>
