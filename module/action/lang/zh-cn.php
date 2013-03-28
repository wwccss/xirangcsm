<?php
/**
 * The action module zh-cn file of zentaoASM
 *
 * @copyright   Copyright 2009-2011 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Congzhi Chen <congzhi@cnezsoft.com>
 * @package     action
 * @version     $Id: zh-cn.php 1914 2011-06-24 10:11:25Z yidong@cnezsoft.com $
 * @link        http://www.zentao.net
 */
$lang->action->common   = '系统日志';

$lang->action->objectType = '对象类型';
$lang->action->objectID   = '对象ID';
$lang->action->objectName = '对象名称';
$lang->action->actor      = '操作者';
$lang->action->action     = '动作';
$lang->action->date       = '日期';

$lang->action->dynamic = new stdclass();
$lang->action->dynamic->today      = '今天';
$lang->action->dynamic->yesterday  = '昨天';
$lang->action->dynamic->twoDaysAgo = '前天';
$lang->action->dynamic->thisWeek   = '本周';
$lang->action->dynamic->lastWeek   = '上周';
$lang->action->dynamic->thisMonth  = '本月';
$lang->action->dynamic->lastMonth  = '上月';
$lang->action->dynamic->all        = '所有';

$lang->action->objectTypes['request'] = '问题';
$lang->action->objectTypes['reply']   = '回复';
$lang->action->objectTypes['FAQ']     = 'FAQ';

/* 用来描述操作历史记录。*/
$lang->action->desc = new stdclass();
$lang->action->desc->common      = '$date, <strong>$action</strong> by <strong>$actor</strong>' . "\n";
$lang->action->desc->created     = '$date, 由 <strong>$actor</strong> 创建。' . "\n";
$lang->action->desc->replied     = '$date, 由 <strong>$actor</strong> 回复。' . "\n";
$lang->action->desc->doubted     = '$date, 由 <strong>$actor</strong> 追问。' . "\n";
$lang->action->desc->edited      = '$date, 由 <strong>$actor</strong> 编辑。' . "\n";
$lang->action->desc->closed      = '$date, 由 <strong>$actor</strong> 关闭。' . "\n";
$lang->action->desc->transfered  = '$date, 由 <strong>$actor</strong> 转交产品。' . "\n";
$lang->action->desc->valuated    = '$date, 由 <strong>$actor</strong> 评价。' . "\n";
$lang->action->desc->commented   = '$date, 由 <strong>$actor</strong> 点价。' . "\n";
$lang->action->desc->processed   = '$date, 由产品部门 <strong>$actor</strong> 回复。' . "\n";
$lang->action->desc->assignedto  = '$date, 由 <strong>$actor</strong> 指派给你。' . "\n";

/* 用来显示动态信息。*/
$lang->action->label = new stdclass();
$lang->action->label->created     = '创建了';
$lang->action->label->doubted     = '追问了';
$lang->action->label->replied     = '回复了';
$lang->action->label->edited      = '编辑了';
$lang->action->label->closed      = '关闭了';
$lang->action->label->transfered  = '转交了';
$lang->action->label->login       = '登录系统';
$lang->action->label->logout      = "退出登录";

$lang->action->valuate            = "评价等级为：";

$lang->action->label->space = '　';
