<?php
/**
 * The upgrade module English file of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     upgrade
 * @version     $Id: en.php 4615 2013-03-18 08:24:21Z wyd621@gmail.com $
 * @link        http://www.zentao.net
 */
$lang->upgrade->common  = 'Upgrade';
$lang->upgrade->result  = 'Result';
$lang->upgrade->fail    = 'Fail';
$lang->upgrade->success = 'Success';
$lang->upgrade->tohome  = 'Go to index';
$lang->upgrade->warnning= 'Warning';
$lang->upgrade->warnningContent = <<<EOT
Warning! Upgradinng is dangeous, backup your database first.<br />
EOT;






$lang->upgrade->setStatusFile = "<p>For security reason, we will check file <strong>%s</strong><br />
                                 But this file doesn't exist or out of date. You can use the flowing command to create(update)it <br />
                                 For linux:<strong>touch %s;</strong> <br />
                                 For windows:<strong>echo ok > %s</strong></p>
                                 I have done this work, <a href='upgrade.php'>continue upgrade</a>";


$lang->upgrade->selectVersion = 'Select version';
$lang->upgrade->noteVersion   = "Must select the correct version";
$lang->upgrade->fromVersion   = 'From version';
$lang->upgrade->toVersion     = 'To version';
$lang->upgrade->confirm       = 'Confirm the sql to executed.';
$lang->upgrade->sureExecute   = 'Execute';

$lang->upgrade->fromVersions['1_1']       = '1.1';
