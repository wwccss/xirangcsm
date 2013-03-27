<?php
/**
 * The manage privilege view of group module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2011 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     商业软件，未经授权，请立刻删除!
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     group
 * @version     $Id: managepriv.html.php 1914 2011-06-24 10:11:25Z yidong@cnezsoft.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<form method='post' target='hiddenwin'>
  <table class='table-1 a-left' align='center'> 
    <caption><?php echo $group->desc . $lang->colon . $lang->group->managePriv;?> </caption>
    <tr>
      <th><?php echo $lang->group->module;?></th>
      <th><?php echo $lang->group->method;?></th>
    </tr>  
    <?php foreach($lang->resource as $moduleName => $moduleActions):?>
    <tr class='f-14px <?php echo cycle('even, bg-yellow');?>'>
      <th class='a-right'><?php echo $this->lang->$moduleName->common;?> <input type='checkbox' onclick='check(this, "<?php echo $moduleName;?>")'></td>
      <td id='<?php echo $moduleName;?>' class='pv-10px'>
        <?php $i = 1;?>
        <?php foreach($moduleActions as $action => $actionLabel):?>
        <div class='w-p20 f-left'>
          <input type='checkbox' name='actions[<?php echo $moduleName;?>][]' value='<?php echo $action;?>' <?php if(isset($groupPrivs[$moduleName][$action])) echo "checked";?> />
          <span class='priv' id=<?php echo $moduleName . '-' . $actionLabel;?>><?php echo $lang->$moduleName->$actionLabel;?></span>
        </div>
        <?php if(($i %  4) == 0) echo "<div class='c-both'></div>"; $i ++;?>
        <?php endforeach;?>
      </td>
    </tr>
    <?php endforeach;?>
    <tr>
      <th class='rowhead'><?php echo $lang->group->checkall;?><input type='checkbox' onclick='checkall(this);'></th>
      <td class='a-center'>
        <?php 
        echo html::submitButton($lang->save);
        echo html::linkButton($lang->goback, $this->createLink('group', 'browse'));
        echo html::hidden('foo'); // Just a hidden var, to make sure $_POST is not empty.
        ?>
      </td>
    </tr>
  </table>
</form>
<?php include '../../common/view/footer.admin.html.php'?>
