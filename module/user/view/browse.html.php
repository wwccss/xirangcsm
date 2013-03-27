<?php
/**
 * The browse view file of user module of zentaocs.
 *
 * @copyright   Copyright 2009-2011 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     商业软件，未经授权，请立刻删除!
 * @author      Yangyang Shi <shiyangyang@cnezsoft.com>
 * @package     User 
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.admin.html.php'?>
<table align='center' class='table-1'>
  <caption>
    <div class='f-left'><?php if($type == 'customer') echo $lang->user->customer->manage; else echo $lang->user->inside->manage;?></div>
    <div class='f-right'><?php if($type == 'customer' and $this->app->user->role != 'support') echo html::a($this->createLink('user', 'create', "type=$type"), $lang->user->customer->create); elseif($type == 'inside' and $this->app->user->role == 'admin') echo html::a($this->createLink('user', 'create', "type=$type"), $lang->user->inside->create);?></div>
  </caption>
  <tr>
    <th class='w-id'><?php echo $lang->user->id;?></th>
    <th class='w-80px'><?php echo $lang->user->realname;?></th>
    <th class='w-80px'><?php echo $lang->user->account;?></th>
    <?php if($type == 'inside'): ?>
    <th class='w-80px'><?php echo $lang->user->role;?></th>
    <?php endif;?>
    <th class='w-40px'><?php echo $lang->user->gendar;?></th>
    <?php if($type == 'customer'): ?>
    <th><?php echo $lang->user->company;?></th>
    <?php endif;?>
    <th class='w-80px'><?php echo $lang->user->visits;?></th>
    <th class='w-120px'><?php echo $lang->user->last;?></th>
    <th class='w-130px'><?php echo $lang->user->operate;?></th>
  </tr>
  <?php foreach($users as $user):?>
  <tr>
    <td class='a-center'><strong><?php echo $user->id;?></strong></td>
    <td class='a-center'><?php echo $user->realname; ?> </td>
    <td class='a-center'><?php echo $user->account; ?> </td>
    <?php if($type == 'inside'): ?>
    <td class='a-center'><?php echo $lang->user->roleList[$user->role]; ?> </td>
    <?php endif;?>
    <td class='a-center'><?php echo $lang->user->gendarList[$user->gendar]; ?> </td>
    <?php if($type == 'customer'): ?>
    <td class='a-center'><?php echo $user->company; ?> </td>
    <?php endif;?>
    <td class='a-center'><?php echo $user->visits; ?> </td>
    <td class='a-center'><?php echo $user->last; ?> </td>
    <?php if($type == 'customer'): ?>
    <td class='a-center'>
      <?php 
      if($type == 'customer') echo $this->app->user->role != 'support' ? html::a($this->createLink('user', 'manageServiceTime', "userID=$user->id"), $lang->user->manageServiceTime) : $lang->user->manageServiceTime;
      echo $this->app->user->role != 'support' ? html::a($this->createLink('user', 'edit', "userID=$user->id&type=$type"), $lang->user->edit) : $lang->user->edit;
      if(!$user->forbid)
      {
          echo $this->app->user->role != 'support' ? html::a($this->createLink('user', 'forbid', "userID=$user->id&type=$type"), $lang->user->forbid) : $lang->user->forbid;
      }
      else
      {
          echo $this->app->user->role != 'support' ? html::a($this->createLink('user', 'allow', "userID=$user->id&type=$type"), $lang->user->allow) : $lang->user->allow;
      }
      ?>
    </td>
    <?php endif;?>
    <?php if($type == 'inside'): ?>
    <td class='a-center'>
      <?php 
      if($this->app->user->role == 'admin' or $this->app->user->id == $user->id or ($this->app->user->role == 'manager' and $user->role == 'servicer'))
      {
          echo html::a($this->createLink('user', 'edit', "userID=$user->id&type=$type"), $lang->user->edit);
      }
      else
      {
          echo $lang->user->edit;
      }
      if($this->app->user->role == 'admin')
      {
          if($user->forbid == 0)
          {
              echo html::a($this->createLink('user', 'forbid', "userID=$user->id&type=$type"), $lang->user->forbid);
          }
          else
          {
              echo html::a($this->createLink('user', 'allow', "userID=$user->id&type=$type"), $lang->user->allow);
          }
      }
      ?>
    </td>
    <?php endif;?>
  </tr>
  <?php endforeach;?>
  <tr><td colspan='8' class='a-right'><?php $pager->show();?></td></tr>
</table>
<?php include '../../common/view/footer.admin.html.php'?>
