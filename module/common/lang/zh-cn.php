<?php
/**
 * The common simplified chinese file of ZenTaoASM.
 
 * @copyright   Copyright 2009-2011 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     ZenTaoASM
 * @version     $Id$
 * @link        http://www.zentao.net
 */
$lang->arrow        = ' » ';
$lang->colon        = '::';
$lang->at           = ' 于 ';
$lang->downArrow    = '↓';

$lang->zentaoasm    = '禅道售后管理软件';
$lang->easysoft     = '青岛易软天创网络科技有限公司';
$lang->poweredBy    = "powered by <a href='http://www.zentao.net/goto.php?item=zentaoasm' target='_blank'>zentaoASM %s</a>";
$lang->homePage     = '首页';
$lang->currentPos   = '当前位置：';

$lang->articleTree     = '分类浏览';
$lang->articleFull     = '正文 ';
$lang->articleViews    = '<i>%s次阅读</i> ';
$lang->articleComments = '<i>%s条评论</i> ';
$lang->articleAuthor   = '<i>%s 发表于 %s</i>';

$lang->welcome       = "欢迎您, <strong>%s</strong> ";
$lang->welcomeAdmin  = "欢迎您使用 禅道售后管理软件";
$lang->todayIs       = '今天是%s，';
$lang->dashboard     = '用户中心';
$lang->register      = '免费注册';
$lang->logout        = '退出';
$lang->login         = '登录';
$lang->loginAdmin    = '登录后台';
$lang->account       = '帐号';
$lang->password      = '密码';

$lang->reset        = '重填';
$lang->edit         = '编辑';
$lang->submitting   = '请稍候...';
$lang->copy         = '复制';
$lang->delete       = '删除';
$lang->close        = '关闭';
$lang->save         = '保存';
$lang->confirm      = '确认';
$lang->preview      = '预览';
$lang->goback       = '返回';
$lang->more         = '更多';
$lang->actions      = '操作';
$lang->feature      = '未来';
$lang->year         = '年';

$lang->selectAll    = '全选';
$lang->notFound     = '抱歉，您访问的对象并不存在！';
$lang->messages     = '未读消息(%s)';

$lang->runInfo      = "<div class='row'><div class='u-1 a-center' id='runinfo'>时间: %s 毫秒, 内存: %s KB, 查询: %s.  </div></div>";

/* The labels show in the positon bar. */
$lang->position['article'] = '文章';
$lang->position['forum']   = '论坛';
$lang->position['thread']  = '论坛';
$lang->position['user']    = '用户';

/* The optional features. */
$lang->features['user']  = '用户功能';

/* 主导航菜单。*/
$lang->menu = new stdclass();
$lang->menu->request  = '回答管理|request|browse|';
$lang->menu->product  = '产品管理|product|manage|';
$lang->menu->category = '分类管理|category|manage|';
$lang->menu->faq      = 'FAQ管理|faq|manage|';
$lang->menu->inside   = '内部管理|user|browse|type=inside|';
$lang->menu->customer = '客户管理|user|browse|type=customer|';
$lang->menu->group    = '权限管理|group|browse|';
$lang->menu->setting  = '系统设置|setting|setConfig|';

/* The error messages. */
$lang->error = new stdclass();
$lang->error->companyNotFound = "您访问的域名 %s 没有对应的公司。";
$lang->error->length          = array("『%s』长度错误，应当为『%s』", "『%s』长度应当不超过『%s』，且不小于『%s』。");
$lang->error->reg             = "『%s』不符合格式，应当为:『%s』。";
$lang->error->unique          = "『%s』已经有『%s』这条记录了。";
$lang->error->notempty        = "『%s』不能为空。";
$lang->error->equal           = "『%s』必须为『%s』。";
$lang->error->int             = array("『%s』应当是数字。", "『%s』最小值为%s",  "『%s』应当介于『%s-%s』之间。");
$lang->error->float           = "『%s』应当是数字，可以是小数。";
$lang->error->email           = "『%s』应当为合法的EMAIL。";
$lang->error->date            = "『%s』应当为合法的日期。";
$lang->error->account         = "『%s』应当为字母和数字的组合，至少三位";
$lang->error->passwordsame    = "两次密码应当相等。";
$lang->error->passwordrule    = "密码应该符合规则，长度至少为六位。";
$lang->error->syncConfig      = '同步功能没有打开，或者配置错误。';

/* The pager items. */
$lang->pager = new stdclass();
$lang->pager->noRecord  = "暂时没有记录";
$lang->pager->digest    = "共<strong>%s</strong>条记录,每页 <strong>%s</strong>条，页面：<strong>%s/%s</strong> ";
$lang->pager->first     = "首页";
$lang->pager->pre       = "上页";
$lang->pager->next      = "下页";
$lang->pager->last      = "末页";
$lang->pager->locate    = "GO!";

/* The datetime settings. */
define('DT_DATETIME1',  'Y-m-d H:i:s');
define('DT_DATETIME2',  'y-m-d H:i');
define('DT_MONTHTIME1', 'n/d H:i');
define('DT_MONTHTIME2', 'n月d日 H:i');
define('DT_DATE1',     'Y年m月d日');
define('DT_DATE2',     'Ymd');
define('DT_DATE3',     'Y年m月d日');
define('DT_TIME1',     'H:i:s');
define('DT_TIME2',     'H:i');

/* datepicker 时间*/
$lang->datepicker = new stdclass();

$lang->datepicker->dpText = new stdclass();
$lang->datepicker->dpText->TEXT_OR          = '或 ';
$lang->datepicker->dpText->TEXT_PREV_YEAR   = '去年';
$lang->datepicker->dpText->TEXT_PREV_MONTH  = '上月';
$lang->datepicker->dpText->TEXT_PREV_WEEK   = '上周';
$lang->datepicker->dpText->TEXT_YESTERDAY   = '昨天';
$lang->datepicker->dpText->TEXT_THIS_MONTH  = '本月';
$lang->datepicker->dpText->TEXT_THIS_WEEK   = '本周';
$lang->datepicker->dpText->TEXT_TODAY       = '今天';
$lang->datepicker->dpText->TEXT_NEXT_YEAR   = '明年';
$lang->datepicker->dpText->TEXT_NEXT_MONTH  = '下月';
$lang->datepicker->dpText->TEXT_CLOSE       = '关闭';
$lang->datepicker->dpText->TEXT_DATE        = '选择时间段';
$lang->datepicker->dpText->TEXT_CHOOSE_DATE = '选择日期';

$lang->datepicker->dayNames     = array('星期日', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六');
$lang->datepicker->abbrDayNames = array('日', '一', '二', '三', '四', '五', '六');
$lang->datepicker->monthNames   = array('一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月');

