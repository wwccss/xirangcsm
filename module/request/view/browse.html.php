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
<div class='row'>
<div class='u-24-5'>
  <div class='cont-left'><?php include 'blockusermenu.html.php'?></div>
</div>
<div class='u-24-19'>
<?php else: ?>
<?php include '../../common/view/header.admin.html.php';?>
<?php include '../../common/view/alert.html.php';?>
<style>
#select{height:auto;}
</style>
<?php endif;?>
<script type='text/javascript'>
var browseType='by<?php echo $type?>Tab';
$(function(){
     $('#' + browseType).addClass('active');
});
</script>
<table align='center' class='table-1 fixed mb-zero'>
  <caption class='f-14px'>
<!-- Show tag of request. -->
    <div class='f-left' id='tag'>
    <?php
    if(RUN_MODE == 'admin')
    {
      echo html::a(inLink('browse', "type=assignedToMe"), $lang->request->assignedToMe, '', "id='byassignedToMeTab'");
    }
    echo html::a(inLink('browse', "type=all"), $lang->request->all, '', "id='byallTab'");
    foreach($lang->request->statusList as $statusName => $statusLabel)
    {
      echo html::a(inLink('browse', "type=$statusName"), $statusLabel, '', "id='by$statusName" . 'Tab' . "'");
    }
    if(RUN_MODE == 'admin')
    {
      echo html::a(inLink('browse', "type=allowedClosed"), $lang->request->allowedClosed, '', "id='byallowedClosedTab'");
      echo html::a(inLink('browse', "type=repliedByMe"), $lang->request->repliedByMe, '',  "id='byrepliedByMeTab'");
      echo html::a(inLink('browse', "type=search"), $lang->request->search, '', "id='bysearchTab'");
    }
    ?>
    </div>
<!-- end show tag. -->
  </caption>
</table>
<!-- show search. -->
<?php if(RUN_MODE != 'front'):?>
<table align='center' class='table-1 fixed <?php if($type !='search') echo 'hidden';?>' id='select'>
  <tr>
    <td>
      <div id='querybox' class='<?php if($type !='search') echo 'hidden';?>'><?php echo $searchForm;?></div>
    </td>
  </tr>
</table>
<?php endif;?>
</table>
<!-- show header of table. -->
<table align='center' class='table-1 fixed'>
  <tr>
    <th class='w-id'><?php echo $lang->request->id;?></th>
    <th><?php echo $lang->request->title;?></th>
    <th class='w-60px'><?php echo $lang->request->product;?></th>
    <th class='w-60px'><?php echo $lang->request->category;?></th>
    <th class='w-80px'><?php echo $lang->request->addedDate;?></th>
    <th class='w-status'><?php echo $lang->request->status;?></th>
    <?php if(RUN_MODE == 'admin'):?>
    <th class='w-user'><?php echo $lang->request->customer;?></th>
    <th class='w-user' id='assigned'><?php echo $lang->request->assignedTo;?></th>
    <?php endif;?>
    <th class='w-80px'><?php echo $lang->request->repliedDate;?></th>
    <th class='w-200px'><?php echo $lang->actions;?></th>
  </tr>
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
      echo html::a(inlink('view', "requestID=$request->id&editReplyID=0&viewType=reply"), $lang->request->reply);
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
