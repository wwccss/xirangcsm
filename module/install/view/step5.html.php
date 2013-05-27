<?php
/**
 * The html template file of step4 method of install module of XiRangCSM.
 *
 * @copyright   Copyright 2009-2011 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author	  Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package	  XiRangCSM
 * @version	  $Id: step4.html.php 867 2010-06-17 09:32:58Z wwccss $
 */
?>
<?php include '../../common/view/header.lite.html.php';?>
<table class='table-6' align='center'>
  <caption><?php echo $lang->install->success;?></caption>
  <tr>
    <td>
      <?php
      echo '<p  class="a-center">';
      echo html::a($this->createLink($config->default->module, $config->default->method), $lang->install->visitFront, '_blank');
      echo html::a('admin.php', $lang->install->visitAdmin, '_blank');
      echo '</p>';
      ?>
    </td>
  </tr>
</table>
  </div>
  <div class='a-center'><?php printf($lang->poweredBy, $config->version);?></div>
</div>
</body>
</html>
