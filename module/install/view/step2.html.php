<?php
/**
 * The html template file of step2 method of install module of XiRangCSM.
 *
 * @copyright   Copyright 2009-2011 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     XiRangCSM
 * @version     $Id$
 */
?>
<?php include '../../common/view/header.lite.html.php';?>
<form method='post' action='<?php echo $this->createLink('install', 'step3');?>'>
  <table align='center' class='table-6'>
    <caption><?php echo $lang->install->setConfig;?></caption>
    <tr>
      <th class='w-p20'><?php echo $lang->install->key;?></th>
      <th><?php echo $lang->install->value?></th>
    </tr>
    <tr>
      <th><?php echo $lang->install->requestType;?></th>
      <td><?php echo html::radio('requestType', $lang->install->requestTypes, 'GET');?></td>
    </tr>
    <tr>
      <th><?php echo $lang->install->dbHost;?></th>
      <td><?php echo html::input('dbHost', 'localhost');?><?php echo $lang->install->dbHostNote;?></td>
    </tr>
    <tr>
      <th><?php echo $lang->install->dbPort;?></th>
      <td><?php echo html::input('dbPort', '3306');?></td>
    </tr>
    <tr>
      <th><?php echo $lang->install->dbUser;?></th>
      <td><?php echo html::input('dbUser', 'root');?></td>
    </tr>
    <tr>
      <th><?php echo $lang->install->dbPassword;?></th>
      <td><?php echo html::input('dbPassword');?></td>
    </tr>
    <tr>
      <th><?php echo $lang->install->dbName;?></th>
      <td><?php echo html::input('dbName', 'xirangcsm');?></td>
    </tr>
    <tr>
      <th><?php echo $lang->install->dbPrefix;?></th>
      <td><?php echo html::input('dbPrefix', 'zt_') . html::checkBox('clearDB', $lang->install->clearDB);?></td>
    </tr>
    <tr>
      <td colspan='2' class='a-center'><?php echo html::submitButton('', "class='btn btn-primary'");?></td>
    </tr>
  </table>
</form>
<?php include '../../common/view/footer.html.php';?>
