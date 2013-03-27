<?php
/**
 * The setting view file of setting module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2011 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     商业软件，未经授权，请立刻删除!
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     setting
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<form method='post' target='hiddenwin'>
<table class='table-1 fixed' align='center'>
  <caption><?php echo $lang->setting->syncConfig?></caption>
  <tr>
    <th class='w-100px'><?php echo $lang->setting->isSync?></th>
    <td><?php echo html::select('openSync', $lang->setting->syncType, $syncConfig->openSync, "class='select-3'")?></td>
  </tr>
  <tr>
    <th><?php echo $lang->setting->key?></th>
    <td><?php echo html::input('key', $syncConfig->key, "class='text-3'") . $lang->setting->keyNote?></td>
  </tr>
  <tr>
    <th><?php echo $lang->setting->IP?></th>
    <td><?php
    $defaultVal = empty($syncConfig->ip) ? "checked='on'" : '';
    echo html::input('ip', $syncConfig->ip, "class='text-3'") . "<input type='checkbox' name='noIP' $defaultVal />" . $lang->setting->noIP;
    ?>
    </td>
  </tr>
  <tr>
    <td colspan='2' align='center'><?php echo html::submitButton() . html::resetButton()?></td>
  </tr>
</table>
</form>
<?php include '../../common/view/footer.admin.html.php';?>

