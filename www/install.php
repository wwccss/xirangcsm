<?php
/**
 * The install router file of ZenTaoASM.
 *
 * @copyright   Copyright 2009-2010 QingDao Nature Easy Soft Network Technology Co,LTD (www.cnezsoft.com)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     ZenTaoASM
 * @version     $Id$
 * @link        http://www.zentao.net
 */
error_reporting(0);
session_start();
define('RUN_MODE', 'install');

/* Load the framework. */
include '../framework/router.class.php';
include '../framework/control.class.php';
include '../framework/model.class.php';
include '../framework/helper.class.php';

/* Instance the app and run it. */
$app    = router::createApp('pms', dirname(dirname(__FILE__)));
$config = $app->config;

/* Check installed or not. */
if(!isset($_SESSION['installing']) and isset($config->installed) and $config->installed) die(header('location: index.php'));

/* Reset the config params. */
$config->set('requestType', 'GET');
$config->set('debug', true);
$config->set('default.module', 'install');
$config->set('default.method', 'index');
$app->setDebug();

/* Run the app. */
$app->parseRequest();
$app->loadModule();
