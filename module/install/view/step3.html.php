<?php
/**
 * The html template file of step3 method of install module of ZenTaoASM.
 *
 * @copyright   Copyright 2009-2011 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     商业软件，未经授权，请立刻删除!
 * @author	  Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package	 ZenTaoASM
 * @version	 $Id: step3.html.php 824 2010-05-02 15:32:06Z wwccss $
 */
?>
<?php include './header.html.php';?>
<?php
if(!isset($error))
{
    $configContent = <<<EOT
<?php
\$config->installed       = true;
\$config->debug           = false;
\$config->requestType     = '$requestType';
\$config->db->host        = '$dbHost';
\$config->db->port        = '$dbPort';
\$config->db->name        = '$dbName';
\$config->db->user        = '$dbUser';
\$config->db->password    = '$dbPassword';
\$config->db->prefix      = '$dbPrefix';
\$config->webRoot         = getWebRoot();
EOT;
}
?>
<?php if(isset($error)):?>
<table class='table-6' align='center'>
  <caption><?php echo $lang->install->error;?></caption>
  <tr><td><?php echo $error;?></td></tr>
  <tr><td><?php echo html::commonButton($lang->install->pre, "onclick='javascript:history.back(-1)'");?></td></tr>
</table>
<?php else:?>
<table class='table-6' align='center'>
  <caption><?php echo $lang->install->saveConfig;?></caption>
  <tr>
    <td class='a-center'><?php echo html::textArea('config', $configContent, "rows='15' class='area-1 f-12px'");?></td>
  </tr>
  <tr>
    <td>
    <?php
    $configRoot   = $this->app->getConfigRoot();
    $myConfigFile = $configRoot . 'my.php';
    if(is_writable($configRoot))
    {
        if(@file_put_contents($myConfigFile, $configContent))
        {
            printf($lang->install->saved2File, $myConfigFile);
        }
        else
        {
            printf($lang->install->save2File, $this->app->getConfigRoot() . 'my.php');
        }
    }
    else
    {
        printf($lang->install->save2File, $this->app->getConfigRoot() . 'my.php');
    }
    echo "<br />";
    echo "<div class='a-center'>" . html::a($this->createLink('install', 'step4'), $lang->install->next) . '</div>';
    ?>
    </td>
  </tr>
</table>
<?php endif;?>
<?php include './footer.html.php';?>
