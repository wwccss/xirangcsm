<?php
/**
 * The view view of request module of zentaoASM
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
  <div class='span2'>
    <div class='cont-left'><?php include $this->app->getModulePath('user') . 'view/blockusermenu.html.php';?></div>
  </div>
<div class='span10'>
<?php else:?>
<?php include '../../common/view/header.admin.html.php';?>
<?php endif;?>
<?php include '../../common/view/kindeditor.html.php';?>
  <table class='table-1 fixed' align='center'>
    <caption class='a-left blue'>
    <?php 
    if($request->status == 'viewed')
    {
      echo $lang->request->statusList['wait'] . $lang->arrow . $request->productName . $lang->arrow . $request->categoryName . $request->title;
    }
    else
    {
      echo $lang->request->statusList[$request->status] . $lang->arrow . $request->productName . $lang->arrow . $request->categoryName . $lang->arrow . $request->title;
    }
    ?>
    </caption>
    <tr>
      <td>
        <?php echo $request->desc;?><br />
        <?php echo $this->fetch('file', 'printFiles', array('files' => $request->files, 'fieldset' => 'false'));?><br />
        <?php if(RUN_MODE == 'front'):?>
        <div class='a-right'>
        <?php if($request->status =='replied' || $request->status == 'doubted') echo html::commonButton($lang->request->doubt, "id='doubtButton'");?>
        <?php if($request->status=='replied') echo html::commonButton($lang->request->valuate, "id='valuateButton'");?> 
        </div>
        <?php endif;?>
        <?php if(RUN_MODE == 'admin'):?>
        <div class='a-right'>
        <?php if($request->status != 'closed') echo html::commonButton($lang->request->reply, "onclick='showReply()'");?> 
        <?php
        if($request->status != 'closed' && $this->config->api->openSync)
        {
            if($request->status != 'transfered' and $request->status != 'buged' and $request->status != 'storied') echo html::linkButton($lang->request->transfer, inlink('transfer', "requestID=$request->id"));
        }
        ?>
        <?php 
        if($request->status != 'wait' and $request->status != 'viewed' and $this->app->user->role == 'manager')
        {
            echo html::linkButton($lang->request->commentReply, inlink('view', "requestID=$request->id&editReply=0&viewType=view&faqID=0&comment=1"));
        }
        ?>
        <?php echo html::linkButton($lang->goback, $this->inLink('browse', "type=" . $this->session->type));?> 
        </div>  
        <?php elseif(RUN_MODE =='front' and $this->app->user->id == $request->customer):?>
        <div class='a-right'>
        <?php if($request->status == 'wait') echo html::linkButton($lang->request->edit, $this->inLink('edit', "requestID=$request->id"));?> 
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
        <span>
          <?php $this->action->printAction($action);?>
        </span>
        <?php if(!empty($action->comment)):?>
        <div class='history'>
        <?php echo nl2br($action->comment);?>
        </div>
        <?php endif;?>
      </li>
      <?php endforeach;?>
    </ol>
  </fieldset>
  <?php if($comment == 1):?>
  <div>
  <form method='post' target='hiddenwin' action='<?php echo inlink('comment', "requestID=$request->id&paramString=$paramString")?>'>
    <table class='table-1 fixed' align='center'>
      <caption><?php echo $lang->request->commentReply;?></caption>
      <tr>
        <th class='w-100px'><?php echo $lang->request->comment;?></th>
        <td><?php echo html::textarea('comment', '', 'style="width:90%" rows=10');?></td>
      </tr>
      <tr><td colspan='2' class='a-center'><?php echo html::submitButton();?></td></tr>
    </table>
  </form>
  </div>
  <?php endif;?>
  <?php if($request->status != 'closed'):?>
  <div id='replyDiv'>
    <form method='post' target='hiddenwin' action='<?php echo inlink('reply', "requestID=$request->id&editReplyID=$editReplyID")?>'>
    <table class='table-1 fixed' align='center'>
      <caption><?php echo $lang->request->reply;?></caption>
      <tr>
        <th class='w-100px'><?php echo $lang->request->selectFAQ;?></th>
        <td><?php echo html::select('faqID', $faqList, $faq ? $faq->id : 0, "class=select-1 onchange='switchFAQ({$request->id}, $editReplyID, this.value)'");?></td>
      <tr>
      <tr>
        <th><?php echo $lang->request->reply;?></th>
        <td><?php echo html::textarea('reply', $faq ? $faq->answer : '', 'style="width:90%" rows=10');?></td>
      </tr>
      <tr><td colspan='2' class='a-center'><?php echo html::submitButton();?></td></tr>
    </table>
    </form>
  </div>
  <?php endif;?>
<div id='doubt' <?php echo $viewType == 'doubt' ? '' : "class='hidden'"?>>
  <form method="post" action="<?php echo inlink('doubt');?>">
  <table class='table-1 fixed'>
    <caption class='a-left blue'><?php echo $lang->request->doubt;?></caption>
    <tr><td><?php echo html::textarea('comment', '', 'style="width:90%" rows=10')?></td></tr>
    <tr><td><?php echo html::submitButton($lang->request->doubt). html::hidden('requestID', $request->id)?></td></tr>
  </table>
  </form>
</div>
<div id='valuate' <?php echo $viewType == 'valuate' ? '' : "class='hidden'"?>>
  <form method="post" action="<?php echo inlink('valuate')?>">
  <table class='table-1 fixed' align='center'>
    <caption class='a-left blue'><?php echo $lang->request->valuate. $lang->request->valuateNotice;?></caption>
    <tr><td><?php echo html::radio('valuate', $lang->request->valuates, '')?></td></tr>
    <tr><td><?php echo html::textarea('comment', '', 'style="width:90%" rows=10')?></td></tr>
    <tr><td><?php echo html::submitButton($lang->request->subRating). html::hidden('requestID', $request->id)?></td></tr>
  </table>
  </form>
</div>
</div>
<script type='text/javascript'>
var viewType    = '<?php echo $viewType?>';
</script>
<?php if(RUN_MODE == 'front') include '../../common/view/footer.html.php';?>
<?php if(RUN_MODE == 'admin') include '../../common/view/footer.admin.html.php';?>
