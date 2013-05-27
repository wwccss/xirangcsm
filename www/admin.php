<?php
/**
 * The router file of XiRangCSM.
 *
 * @copyright   Copyright 2009-2010 QingDao Nature Easy Soft Network Technology Co,LTD (www.cnezsoft.com)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     XiRangCSM
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
define('RUN_MODE', 'admin');

/* Instance the app. */
$app = router::createApp('csm', dirname(dirname(__FILE__)));

/* Change the request settings. */
$config->frontRequestType = $config->requestType;
$config->requestType = 'GET';
$config->default->module = 'request'; 
$config->default->method = 'browse';

/* Return the config. */
if(isset($_GET['mode']) and $_GET['mode'] == 'getconfig') die($app->exportConfig());  // 
if(!isset($config->installed) or !$config->installed) die(header('location: install.php'));

/* Run it. */
$common = $app->loadCommon();
$app->parseRequest();
$common->checkPriv();
$app->loadModule();
