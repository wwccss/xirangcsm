<?php
/**
 * The leftmenu view file of admin module of zentaocs.
 *
 * @copyright   Copyright 2009-2011 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     商业软件，未经授权，请立刻删除!
 * @author      Yangyang Shi <shiyangyang@cnezsoft.com>
 * @package     Admin 
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<style>
html{background:#727171;}
.w-200px{background:#727171;}
.w-200px div{background:url('<?php echo $defaultTheme?>images/default/left_title.png') repeat-x; height:41px; text-align:center; line-height:41px; color:#fff; font-size:18px; font-family:'黑体'; border:none;padding: 0px;}
.listmenu{margin:0px; margin-top:10px; text-align='center'}
.listmenu li{background:url('<?php echo $defaultTheme?>images/default/left_list.png') no-repeat center; height:33px; text-align:center; line-height:33px;padding: 0px;}
</style>
<div class='bd-none w-200px' align='left'>
  <div><?php echo $lang->admin->manage;?></div>
    <ul class='listmenu'>
     <?php
     echo '<li>' . html::a($this->createLink('request',  'browse'), $lang->admin->manageAnswers,  'mainwin') . '</li>';
     echo '<li>' . html::a($this->createLink('product',  'manage'), $lang->admin->manageProduct, 'mainwin') . '</li>' ;
     echo '<li>' . html::a($this->createLink('category', 'manage'), $lang->admin->manageCategory, 'mainwin') . '</li>' ;
     echo '<li>' . html::a($this->createLink('faq',      'manage'), $lang->admin->manageFAQ, 'mainwin') . '</li>';
     echo '<li>' . html::a($this->createLink('user',     'browse', 'type=inside'),   $lang->admin->manageInsideAccount, 'mainwin') . '</li>';
     echo '<li>' . html::a($this->createLink('user',     'browse', 'type=customer'), $lang->admin->manageCustomer, 'mainwin') . '</li>';
     echo '<li>' . html::a($this->createLink('group',    'browse'),    $lang->admin->groupMange, 'mainwin') . '</li>';
     echo '<li>' . html::a($this->createLink('setting',  'setConfig'), $lang->admin->config, 'mainwin') . '</li>';
     echo '<li>' . html::a($this->createLink('user',     'logout'),    $lang->admin->logout, '_top') . '</li>';
     ?>
    </ul>
</div>
</body>
</html>
