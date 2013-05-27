<?php
/**
 * The view view of request module of XiRangCSM
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
<div>
<?php else:?>
<?php include '../../common/view/header.admin.html.php';?>
<?php endif;?>
<?php include '../../common/view/kindeditor.html.php';?>
  <ul class='breadcrumb'>
    <li><?php $status = $request->status == 'viewed' ? 'wait' : $request->status; echo $lang->request->statusList[$status]?><span class="divider">/</span></li>
    <li><?php echo $request->productName?><span class="divider">/</span></li>
    <li><?php echo $request->categoryName?><span class="divider">/</span></li>
    <li class='active'><?php echo $request->title?></li>
    <?php echo html::linkButton($lang->goback, $this->inLink('browse', "type=" . $this->session->type), "class='f-right btn btn-inverse btn-small'");?>
  </ul>
  <table class='table-1 fixed bg-white' align='center' id='requestCont'>
    <tr>
      <td>
        <?php echo $request->desc;?><br />
        <?php echo $this->fetch('file', 'printFiles', array('files' => $request->files, 'fieldset' => 'false'));?><br />
        <?php if(RUN_MODE == 'front' and $this->app->user->id == $request->customer):?>
        <div>
        <?php
        if($request->status =='replied' || $request->status == 'doubted') echo html::commonButton($lang->request->doubt, "id='doubtButton' class='btn btn-info btn-small'");
        if($request->status =='replied') echo html::commonButton($lang->request->valuate, "id='valuateButton' class='btn btn-info btn-small'");
        if($request->status == 'wait') echo html::linkButton($lang->request->edit, $this->inLink('edit', "requestID=$request->id"), "class='btn btn-info btn-small'");
        ?>
        </div>
        <?php endif;?>
        <?php if(RUN_MODE == 'admin'):?>
        <div>
        <?php if($request->status != 'closed') echo html::commonButton($lang->request->reply, "onclick='showReply()' class='btn btn-info btn-small'");?> 
        <?php
        if($request->status != 'closed' && $this->config->api->openSync)
        {
            if($request->status != 'transfered' and $request->status != 'buged' and $request->status != 'storied') echo html::linkButton($lang->request->transfer, inlink('transfer', "requestID=$request->id"), "class='btn btn-small btn-info'");
        }

        if($request->status != 'wait' and $request->status != 'viewed' and $this->app->user->role == 'manager')
        {
            echo html::linkButton($lang->request->commentReply, inlink('view', "requestID=$request->id&editReply=0&viewType=view&faqID=0&comment=1"), "class='btn btn-info btn-small'");
        }
        ?>
        </div>  
        <?php endif;?>
      </td>
    </tr>
  </table>

  <fieldset> 
    <legend><?php echo $lang->request->actionList;?></legend>
    <ol id='historyItem'>
      <?php $i = 1; ?>
      <?php foreach($actions as $action):?>
      <?php
      if(RUN_MODE == 'front')
      {
          if($action->action == 'commented') continue;
          if($action->action == 'replied') $action->actor = $lang->request->servicer . $action->number;
      }
      ?>
      <li value='<?php echo $i ++;?>'>
        <?php
        if(isset($users[$action->actor])) $action->actor = $users[$action->actor];
        if(strpos($action->actor, ':') !== false) $action->actor = substr($action->actor, strpos($action->actor, ':') + 1);
        ?>
        <span><?php $this->action->printAction($action);?></span>
        <?php if(!empty($action->comment)):?>
        <div class='history'><?php echo nl2br($action->comment);?></div>
        <?php endif;?>
      </li>
      <?php endforeach;?>
    </ol>
  </fieldset>

  <!-- For comment -->
  <?php if($comment == 1):?>
  <div class='border'>
  <form method='post' target='hiddenwin' action='<?php echo inlink('comment', "requestID=$request->id&paramString=$paramString")?>'>
    <table class='table-1 fixed bd-none' align='center'>
      <tr>
        <th class='w-100px'><?php echo $lang->request->comment;?></th>
        <td><?php echo html::textarea('comment', '', 'style="width:100%" rows=10');?></td>
        <td class='w-100px'><?php echo html::submitButton();?></td>
      </tr>
    </table>
  </form>
  </div>
  <?php endif;?>

  <!-- For reply -->
  <?php if($request->status != 'closed'):?>
  <div id='replyDiv' class='border'>
    <form method='post' target='hiddenwin' action='<?php echo inlink('reply', "requestID=$request->id&editReplyID=$editReplyID")?>'>
    <table class='table-1 fixed bd-none' align='center'>
      <tr>
        <th class='w-100px'><?php echo $lang->request->selectFAQ;?></th>
        <td><?php echo html::select('faqID', $faqList, $faq ? $faq->id : 0, "class='w-p100' onchange='switchFAQ({$request->id}, $editReplyID, this.value)'");?></td>
        <td class='w-100px'></td>
      <tr>
      <tr>
        <th><?php echo $lang->request->reply;?></th>
        <td><?php echo html::textarea('reply', $faq ? $faq->answer : '', 'style="width:100%" rows=10');?></td>
        <td><?php echo html::submitButton();?></td>
      </tr>
    </table>
    </form>
  </div>
  <?php endif;?>

  <!-- For doubt -->
  <div id='doubt' class='border' style='display:<?php echo $viewType == 'doubt' ? '' : "none"?>'>
    <form method="post" action="<?php echo inlink('doubt');?>">
    <table class='table-1 fixed bd-none'>
      <tr>
        <td><?php echo html::textarea('comment', '', 'style="width:100%" rows=5')?></td>
        <td class='w-100px'><?php echo html::submitButton($lang->request->doubt). html::hidden('requestID', $request->id)?></td>
      </tr>
    </table>
    </form>
  </div>

  <!-- For valuate -->
  <div id='valuate' class='border' style='display:<?php echo $viewType == 'valuate' ? '' : "none"?>'>
    <form method="post" action="<?php echo inlink('valuate')?>">
    <table class='table-1 fixed bd-none' align='center'>
      <tr>
        <td><?php echo html::radio('valuate', $lang->request->valuates, '')?></td>
        <td class='w-100px'></td>
      </tr>
      <tr>
        <td><?php echo html::textarea('comment', '', 'style="width:99%" rows=5')?></td>
        <td><?php echo html::submitButton($lang->request->subRating). html::hidden('requestID', $request->id)?></td>
      </tr>
    </table>
    </form>
  </div>
<?php
js::set('viewType', $viewType);
js::set('run_mode', RUN_MODE);
?>
<?php if(RUN_MODE == 'front') include '../../common/view/footer.html.php';?>
<?php if(RUN_MODE == 'admin') include '../../common/view/footer.admin.html.php';?>
