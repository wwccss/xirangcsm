<?php
/**
 * The common simplified chinese file of ZenTaoCMS.
 *
 * @copyright   Copyright 2009-2011 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     商业软件，未经授权，请立刻删除!
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     ZenTaoCMS
 * @version     $Id$
 * @link        http://www.zentao.net
 */
$lang->arrow        = ' » ';
$lang->colon        = '::';
$lang->at           = ' at ';
$lang->downArrow    = '↓';

$lang->zentaoCMS    = 'ZenTao Customer Service System';
$lang->eayssoft     = 'QingDao Nature Easy Soft Network Technology Co,LTD';
$lang->homePage     = 'Home';
$lang->aboutus      = 'About us';
$lang->forumPage    = 'Forum';
$lang->currentPos   = 'Current';

$lang->articleTree     = 'Category';
$lang->articleFull     = 'Article body ';
$lang->articleViews    = '<i>%s views</i> ';
$lang->articleComments = '<i>%s comments</i> ';
$lang->articleAuthor   = '<i>%s posted at %s</i>';

$lang->welcome      = "Welcome, <strong>%s</strong> ";
$lang->welcomeAdmin = "Welcome to use ZenTaoCS";
$lang->todayIs      = 'Today is %s，';
$lang->dashboard    = 'Dashboard';
$lang->register     = 'Register';
$lang->logout       = 'Logout';
$lang->login        = 'Login';
$lang->account      = 'Account';
$lang->password     = 'Password';

$lang->reset        = 'Reset';
$lang->edit         = 'Edit';
$lang->copy         = 'Copy';
$lang->delete       = 'Delete';
$lang->close        = 'Close';
$lang->save         = 'Save';
$lang->confirm      = 'Confirm';
$lang->preview      = 'Preview';
$lang->goback       = 'Go back';
$lang->search       = 'Search';
$lang->more         = 'More';
$lang->actions      = 'Actions';
$lang->feature      = 'Feature';
$lang->year         = 'Year';

$lang->selectAll    = 'Select all';
$lang->notFound     = 'Sorry, the object not found.';
$lang->messages     = 'Unread message';

$lang->runInfo      = "<div class='row'><div class='u-1 a-center' id='runinfo'>Time: %s ms, Memory: %s KB, Queries: %s.  </div></div>";

/* The labels show in the positon bar. */
$lang->position['article'] = 'Article';
$lang->position['forum']   = 'Forum';
$lang->position['thread']  = 'Forum';
$lang->positon['rssSite']  = 'Rss';

/* The optional features. */
$lang->features['user']  = 'function for user';

/* The error messages. */
$lang->error = new stdclass();
$lang->error->companyNotFound = "The domain %s does not exist.";
$lang->error->length          = array("『%s』length should be『%s』", "『%s』length should between『%s』and 『%s』.");
$lang->error->reg             = "『%s』should like『%s』";
$lang->error->unique          = "『%s』has『%s』already.";
$lang->error->notempty        = "『%s』can not be empty.";
$lang->error->equal           = "『%s』must be『%s』。";
$lang->error->int             = array("『%s』should be interger", "『%s』should between『%s-%s』.");
$lang->error->float           = "『%s』should be a interger or float.";
$lang->error->email           = "『%s』should be email.";
$lang->error->date            = "『%s』should be date";
$lang->error->account         = "『%s』should be a valid account.";
$lang->error->passwordsame    = "Two passwords must be the same";
$lang->error->passwordrule    = "Password should more than six letters.";

/* The pager items. */
$lang->pager = new stdclass();
$lang->pager->noRecord  = "No records yet.";
$lang->pager->digest    = "<strong>%s</strong> records, <strong>%s</strong> per page, <strong>%s/%s</strong> ";
$lang->pager->first     = "First";
$lang->pager->pre       = "Previous";
$lang->pager->next      = "Next";
$lang->pager->last      = "Last";
$lang->pager->locate    = "GO!";

$lang->admin->basicManage         = 'BasicManage';
$lang->admin->manageModule        = 'ManageModule';
$lang->admin->manageInsideAccount = 'ManageInsideAccount';
$lang->admin->manageCustomer      = 'ManageCustomer';
$lang->admin->manageAnswers       = 'ManageAnswers';
$lang->admin->logout              = 'Logout';

/* The datetime settings. */
define('DT_DATETIME1',  'Y-m-d H:i:s');
define('DT_DATETIME2',  'y-m-d H:i');
define('DT_MONTHTIME1', 'n/d H:i');
define('DT_MONTHTIME2', 'F j, H:i');
define('DT_DATE1',     'Y-m-d');
define('DT_DATE2',     'Ymd');
define('DT_DATE3',     'F j, Y ');
define('DT_TIME1',     'H:i:s');
define('DT_TIME2',     'H:i');
