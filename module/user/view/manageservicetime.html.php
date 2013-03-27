<?php
/**
 * The modify password view file of user module of zentaoasm.
 *
 * @copyright   Copyright 2009-2011 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     商业软件，未经授权，请立刻删除!
 * @author      Yangyang Shi <shiyangyang@cnezsoft.com>
 * @package     User
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<table align='center' class='table-1'>
  <caption>
    <div class='f-left'><?php echo $lang->user->manageServiceTime . '&#160&#160&#160&#160&#160'. $lang->user->account . ':' . $user->account . '&#160&#160&#160&#160&#160' . $lang->user->realname . ':' . $user->realname;?></div>
    <div class='f-right'><?php echo html::a($this->createLink('user', 'addProductService', "userID=$user->id"), $lang->user->addProductService);?></div>
  </caption>
  <tr>
    <th class='w-100px'><?php echo $lang->user->serviceID;?></th>
    <th><?php echo $lang->user->product;?></th>
    <th class='w-120px'><?php echo $lang->user->serviceTime;?></th>
    <th class='w-160px'><?php echo $lang->user->extendServiceTime . $lang->user->lblExtendServiceTime;?></th>
  </tr>
  <?php foreach($serviceProducts as $serviceProduct):?>
  <tr>
    <td class='a-center'><strong><?php echo $serviceProduct->id;?></strong></td>
    <td class='a-center'><?php echo $serviceProduct->name; ?> </td>
    <td class='a-center'><?php echo $serviceProduct->serviceTime; ?> </td>
    <td class='a-center'>
      <?php 
      echo html::a($this->createLink('user', 'extendServiceTime', "date=onemonth&userID=$user->id&serviceProductID=$serviceProduct->id" ), $lang->user->customer->onemonth); 
      echo html::a($this->createLink('user', 'extendServiceTime', "date=twomonthes&userID=$user->id&serviceProductID=$serviceProduct->id"), $lang->user->customer->twomonthes); 
      echo html::a($this->createLink('user', 'extendServiceTime', "date=threemonthes&userID=$user->id&serviceProductID=$serviceProduct->id" ), $lang->user->customer->threemonthes); 
      echo html::a($this->createLink('user', 'extendServiceTime', "date=sixmonthes&userID=$user->id&serviceProductID=$serviceProduct->id" ), $lang->user->customer->sixmonthes); 
      echo html::a($this->createLink('user', 'extendServiceTime', "date=oneyear&userID=$user->id&serviceProductID=$serviceProduct->id" ), $lang->user->customer->oneyear); 
      ?>
    </td>
  </tr>
<?php endforeach;?>
</table>
<?php include '../../common/view/footer.admin.html.php';?>
