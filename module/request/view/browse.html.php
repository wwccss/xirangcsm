<?php
/**
 * The browse view of request module of zentaoASM
 *
 * @copyright   Copyright 2009-2011 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Congzhi Chen<congzhi@cnezsoft.com>
 * @package     request
 * @version     $Id: buildform.html.php 1914 2011-06-24 10:11:25Z yidong@cnezsoft.com $
 * @link        http://www.zentao.net
 */
?>
<?php if(RUN_MODE == 'front'):?>
<?php include '../../common/view/header.html.php';?>
<style type='text/css'>
.nav-tabs{background:#ccc; padding-top:5px;}
</style>
<div class='row'>
<div class='span2'>
  <div class='cont-left'><?php include $this->app->getModulePath('user') . 'view/blockusermenu.html.php'?></div>
</div>
<div class='span10'>
<?php else: ?>
<?php include '../../common/view/header.admin.html.php';?>
<?php include '../../common/view/alert.html.php';?>
<style type='text/css'>
#select{height:auto;}
</style>
<?php endif;?>
<script type='text/javascript'>
var browseType='by<?php echo $type?>Tab';
$(function(){
     $('#' + browseType).addClass('active');
});
</script>
<ul class='nav nav-tabs'>
<?php
    if(RUN_MODE == 'admin') echo "<li id='byassignedToMeTab'>". html::a(inLink('browse', "type=assignedToMe"), $lang->request->assignedToMe) . '</li>';

    echo "<li id='byallTab'>" . html::a(inLink('browse', "type=all"), $lang->request->all) . '<li>';

    foreach($lang->request->statusList as $statusName => $statusLabel) echo "<li id='by$statusName" . "Tab'>" . html::a(inLink('browse', "type=$statusName"), $statusLabel) . '</li>';

    if(RUN_MODE == 'admin')
    {
      echo "<li id='byallowedClosedTab'>" . html::a(inLink('browse', "type=allowedClosed"), $lang->request->allowedClosed) . '</li>';
      echo "<li id='byrepliedByMeTab'>" . html::a(inLink('browse', "type=repliedByMe"), $lang->request->repliedByMe) . '</li>';
      echo "<li id='bysearchTab'>" . html::a(inLink('browse', "type=search"), $lang->request->search) . '<li>';
    }
?>
</ul>
<!-- show header of table. -->
<?php $vars = "type=$type&param=$param&orderBy=%s&recTotal=$recTotal&recPerPage=$recPerPage&userID=$userID"; ?>
<table align='center' class='table-1 fixed tablesorter table-bordered' id='requestData'>
<?php if(RUN_MODE != 'front'):?>
  <caption id='select' class='<?php if($type !='search') echo 'hidden';?>'>
    <div id='querybox' class='<?php if($type !='search') echo 'hidden';?>'><?php echo $searchForm;?></div>
  </caption>
<?php endif;?>
  <thead>
  <tr>
    <th class='w-id'>    <?php common::printOrderLink('id',        $orderBy, $vars, $lang->request->id);?></th>
    <th>                 <?php common::printOrderLink('title',     $orderBy, $vars, $lang->request->title);?></th>
    <th class='w-60px'>  <?php common::printOrderLink('product',   $orderBy, $vars, $lang->request->product);?></th>
    <th class='w-60px'>  <?php common::printOrderLink('category',  $orderBy, $vars, $lang->request->category);?></th>
    <th class='w-80px'>  <?php common::printOrderLink('addedDate', $orderBy, $vars, $lang->request->addedDate);?></th>
    <th class='w-status'><?php common::printOrderLink('status',    $orderBy, $vars, $lang->request->status);?></th>
    <?php if(RUN_MODE == 'admin'):?>
    <th class='w-user'>               <?php common::printOrderLink('customer',   $orderBy, $vars, $lang->request->customer);?></th>
    <th class='w-user' id='assigned'> <?php common::printOrderLink('assignedTo', $orderBy, $vars, $lang->request->assignedTo);?></th>
    <?php endif;?>
    <th class='w-80px'>  <?php common::printOrderLink('repliedDate', $orderBy, $vars, $lang->request->repliedDate);?></th>
    <th class='<?php echo RUN_MODE == 'front' ? 'w-100px' : 'w-200px'?>' {sorter:false}> <?php echo $lang->actions;?></th>
  </tr>
  </thead>
<!-- show request of content. -->
  <?php foreach($requests as $request):?>
  <tr class='a-center'>
    <td><?php echo $request->id;?></td>
    <td class='a-left'><?php echo html::a(inlink('view', "id=$request->id"), $request->title);?></td>
    <td><?php if(!empty($request->productName)) echo $request->productName;?></td>
    <td><?php if(!empty($request->category)) echo $request->category;?></td>
    <td><?php echo substr($request->addedDate, 5,11);?></td>
    <td><?php echo $lang->request->statusList[$request->status];?></td>
    <?php if(RUN_MODE == 'admin'):?>
    <td><?php echo $request->customer;?></td>
    <td id='<?php echo "assignedTo$request->id"?>'><?php echo $request->assignedTo;?></td>
    <?php endif;?>
    <td><?php echo substr($request->repliedDate, 5, 11);?></td> 
<!-- show actions -->
    <td class='a-left'>
    <?php 
    if($request->status != 'closed' and RUN_MODE == 'admin') 
    {
      echo html::a(inlink('view', "requestID=$request->id&editReplyID=0&viewType=reply") . '#replyDiv', $lang->request->reply);
      echo html::a("javascript:assignedTo($request->id, $request->assignedToID)", $lang->request->assign);
    }
    if($request->status != 'closed' && $request->status != 'wait' && RUN_MODE == 'admin' && $this->config->api->openSync)
    {
        if($request->status != 'transfered' && $request->status != 'storied' && $request->status != 'buged')
        {
            echo html::a(inlink('transfer', "requestID=$request->id"), $lang->request->transfer);
        }
        else if($request->status == 'transfered' || $request->status == 'storied' || $request->status == 'buged')
        {
            echo $lang->request->transfered;
        }
    }
    if($request->isAllowedClosed == 1 and RUN_MODE == 'admin')
    {
      echo html::a(inlink('close', "requestID=$request->id"), $lang->request->close);
    }
    if($request->status == 'wait' and RUN_MODE == 'front')
    {
      echo html::a(inlink('edit', "requestID=$request->id"), $lang->request->edit);
    }
    if($request->status == 'replied' and RUN_MODE == 'front')
    {
      echo html::a(inlink('view', "requestID=$request->id&editReplyID=0&viewType=doubt"), $lang->request->doubt);
      echo html::a(inlink('view', "requestID=$request->id&editReplyID=0&viewType=valuate"), $lang->request->valuate);
    }
    ?>
    </td>
  </tr>
  <?php endforeach;?>
  <tfoot>
    <?php if(RUN_MODE == 'front'):?>
    <tr><td class='a-right' colspan='8'><?php if($dbPager) $dbPager->show();?></td></tr>
    <?php else:?>
    <tr><td class='a-right' colspan='10'><?php if($dbPager) $dbPager->show();?></td></tr>
    <?php endif;?>
  </tfoot>
</table>
</div>
<?php if(RUN_MODE == 'admin'):?>
<script type='text/javascript'>
  $(function(){
      $('table tr:even').css({background:'#e0e0e0'});
      $('table tr:odd').css({background:'#ffffff'});
  })
</script>
<?php endif;?>
<?php if(RUN_MODE == 'front') echo "</div>";?>
<?php if(RUN_MODE == 'front') include '../../common/view/footer.html.php';?>
<?php if(RUN_MODE == 'admin') include '../../common/view/footer.admin.html.php';?>
