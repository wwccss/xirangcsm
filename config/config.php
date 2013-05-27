<?php
/**
 * The config file of XiRangCSM
 *
 * @copyright   Copyright 2009-2010 QingDao Nature Easy Soft Network Technology Co,LTD (www.cnezsoft.com)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     XiRangCSM
 * @version     $Id$
 * @link        http://www.zentao.net
 */
/* The basic settings. */
$config->version     = '1.2.beta';           // The version number, don't change.
$config->encoding    = 'UTF-8';           // The encoding.
$config->cookiePath  = '/';               // The path of cookies.
$config->cookieLife  = time() + 2592000;  // The lifetime of cookies.
$config->timezone    = 'Asia/Shanghai';   // Time zone setting, more plese visit http://www.php.net/manual/en/timezones.php
$config->webRoot     = '';                // The root path of the CSM.

/* The request settins. */
$config->requestType = 'PATH_INFO';       // PATH_INFO or GET.
$config->pathType    = 'clean';           // RequestType=PATH_INFO: clean or full, if full, keys and values are passed in url, if clean, only values.
$config->requestFix  = '-';               // RequestType=PATH_INFO: the divider of the params, can be - _ or /
$config->moduleVar   = 'm';               // RequestType=GET: the name of the module var.
$config->methodVar   = 'f';               // RequestType=GET: the name of the method var.
$config->viewVar     = 't';               // RequestType=GET: the name of the view var.
$config->sessionVar  = 'sid';             // requestType=GET: the session var name.

/* Views and themes. */
$config->views       = ',html,json,xml,';  // Supported view types.
$config->themes      = 'default,blue';     // Supported themes.

/* Suported languags. */
$config->langs['zh-cn'] = 'Chinese Simplified';
$config->langs['en']    = 'English';

/* Default params. */
$config->default->view   = 'html';             // Default view.
$config->default->lang   = 'zh-cn';            // Default language.
$config->default->theme  = 'default';          // Default theme.
$config->default->module = 'faq';            // Default module.
$config->default->method = 'showfaq';            // Default metho.d

/* Upload settings. */
$config->file->dangers = 'php,jsp,py,rb,asp,'; // Dangerous file types.
$config->file->maxSize = 1024 * 1024;          // Max size allowed(Byte).

/* Database settings. */
$config->db->persistant = false;               // Persistant connection or not.
$config->db->driver     = 'mysql';             // The driver of pdo, only mysql yet.
$config->db->encoding   = 'UTF8';              // The encoding of the database.
$config->db->strictMode = false;               // Turn off the strict mode.
$config->db->prefix     = 'zt_';               // The prefix of the table name.

/* The optional features. */
$config->features->user  = false;
$config->features->forum = false;
$config->features->logo  = true;
$config->features->tree  = true;

/* The copyright info. */
$config->copyright->start = 2011;
$config->copyright->about = '';

/* Include the custom config file. */
$configRoot = dirname(__FILE__) . DIRECTORY_SEPARATOR;
$myConfig   = $configRoot . 'my.php';
if(file_exists($myConfig)) include $myConfig;

/* Include extension config files. */
$extConfigFiles = glob($configRoot . 'ext/*.php');
foreach($extConfigFiles as $extConfigFile) include $extConfigFile;

/* Set default table prefix. */
if(!isset($config->db->prefix)) $config->db->prefix = 'zt_';

/* The tables. */
define('TABLE_ACTION',         $config->db->prefix . 'action');
define('TABLE_USER',           $config->db->prefix . 'user');
define('TABLE_GROUP',          $config->db->prefix . 'group');
define('TABLE_MODULE',         $config->db->prefix . 'module');
define('TABLE_FILE',           $config->db->prefix . 'file');
define('TABLE_CATEGORY',       $config->db->prefix . 'category');
define('TABLE_FAQ',            $config->db->prefix . 'faq');
define('TABLE_REQUEST',        $config->db->prefix . 'request');
define('TABLE_USERQUERY',      $config->db->prefix . 'userQuery');
define('TABLE_PRODUCT',        $config->db->prefix . 'product');
define('TABLE_CONFIG',         $config->db->prefix . 'config');
define('TABLE_SERVICETIME',    $config->db->prefix . 'serviceTime');
define('TABLE_GROUPPRIV',      $config->db->prefix . 'groupPriv');
define('TABLE_COMPANY',        $config->db->prefix . 'company');
