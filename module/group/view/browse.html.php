<?php
/**
 * The browse view file of group module of ZenTaoASM.
 *
 * @copyright   Copyright 2009-2011 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     group
 * @version     $Id: browse.html.php 1914 2011-06-24 10:11:25Z yidong@cnezsoft.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<table align='center' class='table-1'>
  <caption><?php echo $lang->group->managePriv?></caption>
  <thead>
  <tr>
   <th><?php echo $lang->group->id;?></th>
   <th><?php echo $lang->group->name;?></th>
   <th><?php echo $lang->group->desc;?></th>
   <th class='{sorter:false}'><?php echo $lang->actions;?></th>
  </tr>
  </thead>
  <tbody>
  <?php foreach($groups as $group):?>
  <tr class='a-center'>
    <td class='strong'><?php echo $group->id;?></td>
    <td><?php echo $group->name;?></td>
    <td class='a-left'><?php echo $group->desc;?></td>
    <td> <?php common::printLink('group', 'managepriv',   "param=$group->id", $lang->group->managePrivByGroup);?> </td>
  </tr>
  <?php endforeach;?>
  </tbody>
</table>
<?php include '../../common/view/footer.admin.html.php';?>
