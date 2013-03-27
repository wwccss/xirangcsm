<?php
/**
 * The html template file of deny method of user module of ZenTaoCMS.
 *
 * @copyright   Copyright 2009-2011 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     商业软件，未经授权，请立刻删除!
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     ZenTaoCMS
 * @version     $Id: deny.html.php 824 2010-05-02 15:32:06Z wwccss $
 */
include '../../common/view/header.lite.html.php';
?>
<div class='row' style='margin-top:100px'>
  <div class='u-1'>
  <table align='center' class='table-3 bg-white'> 
    <caption><?php echo $app->user->account, ' ', $lang->user->deny;?></caption>
    <tr>
      <td>
        <?php
        $moduleName = isset($lang->$module->common)  ? $lang->$module->common:  $module;
        $methodName = isset($lang->$module->$method) ? $lang->$module->$method: $method;

        printf($lang->user->errorDeny, $moduleName, $methodName);
        echo "<br />";
        echo html::a($this->createLink('user', 'control'), $lang->user->control->common);
        if($refererBeforeDeny) echo html::a(helper::safe64Decode($refererBeforeDeny), $lang->user->goback);
        $target = RUN_MODE == 'admin' ? '_top' : '';
        echo html::a($this->createLink('user', 'logout', "referer=" . helper::safe64Encode($denyPage)), $lang->user->relogin, $target);
        ?>
      </td>
    </tr>  
  </table>
  </div>
</div>  
</body>
</html>
