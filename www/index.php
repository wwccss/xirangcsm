<?php
/**
 * The router file of ZenTaoASM.
 *
 * @copyright   Copyright 2009-2010 QingDao Nature Easy Soft Network Technology Co,LTD (www.cnezsoft.com)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     ZenTaoASM
 * @version     $Id$
 * @link        http://www.zentao.net
 */
error_reporting(0);

/* Load the framework. */
include '../framework/router.class.php';
include '../framework/control.class.php';
include '../framework/model.class.php';
include '../framework/helper.class.php';

/* Log the time and define the run mode. */
$startTime = getTime();
define('RUN_MODE', 'front');

/* Instance the app and run it. */
$app = router::createApp('pms', dirname(dirname(__FILE__)));
if(isset($_GET['mode']) and $_GET['mode'] == 'getconfig') die($app->exportConfig());  // 
if(!isset($config->installed) or !$config->installed) die(header('location: install.php'));

$common = $app->loadCommon();
$app->parseRequest();
$common->checkPriv();
$app->loadModule();
//$common->printRunInfo($startTime);
