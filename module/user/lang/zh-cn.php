<?php
/**
 * The user module zh-cn file of ZenTaoCMS.
 *
 * @copyright   Copyright 2009-2011 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     商业软件，未经授权，请立刻删除!
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     user
 * @version     $Id: zh-cn.php 824 2010-05-02 15:32:06Z wwccss $
 * @link        http://www.zentao.net
 */
$lang->user->common         = '用户';
$lang->user->index          = "首页";
$lang->user->view           = "用户详情";
$lang->user->create         = "添加用户";
$lang->user->edit           = "编辑用户";
$lang->user->update         = "编辑用户";
$lang->user->delete         = "删除用户";
$lang->user->browse         = "浏览用户";
$lang->user->deny           = "访问受限";
$lang->user->reset          = "找回密码";
$lang->user->check          = "找回检查";
$lang->user->modifyPassword = "找回检查";
$lang->user->ajaxGetUser    = "接口：异步获取帐号";
$lang->user->confirmDelete   = "您确认删除该用户吗？";
$lang->user->confirmActivate = "您确认激活该用户吗？";
$lang->user->relogin         = "重新登录";
$lang->user->asGuest         = "游客访问";
$lang->user->goback          = "返回前一页";
$lang->user->allUsers        = '全部用户';

$lang->user->manageProductService = "管理服务";
$lang->user->extendProductService = "延长服务";

$lang->user->myService   = '我的服务';
$lang->user->profile     = '个人资料';
$lang->user->editProfile = '修改资料';

$lang->user->inputUserName  = '请输入用户名';
$lang->user->searchUser     = '搜索';
$lang->user->forgetPassword = '忘记密码？';

$lang->user->resetcaption    = "找回密码";
$lang->user->resetaccount    = "请输入您的账号";
$lang->user->resetemail      = "请输入您的密保邮箱";
$lang->user->resetsubmit     = "提交";
$lang->user->resetsuccess    = "密码更改链接已经发送到您的邮箱中";
$lang->user->resetfailed     = "您的密保邮箱错误，请重新输入";

$lang->user->resetmail = new stdclass();
$lang->user->resetmail->subject = "密码修改";
$lang->user->resetmail->notice  = "系统发信，请勿回复";
$lang->user->resetmail->content = "
<html>
<head>
<style>
body{font-size:14px;font-family:arial,verdana,sans-serif;line-height:25px;padding:8px 10px;margin:0;}
a{color:#005590}
pre {
white-space: pre-wrap;
white-space: -moz-pre-wrap;
white-space: -pre-wrap;
white-space: -o-pre-wrap;
word-wrap: break-word;
font-size:14px;font-family:arial,verdana,sans-serif;line-height:25px;padding:8px 10px;margin:0;
}
.rm_line{border-top:2px solid #F1F1F1; font-size:0; margin:15px 0}
.atchImg img{border:2px solid #c3d9ff;}
.lnkTxt{ color:#0066CC}
.rm_PicArea *{ font-family:Arial, sans-serif; font-size:14px;font-weight:700;}
.fbk3{ color:#333; line-height:160%}
.fTip{ font-size:11px; font-weight:normal}
</style>
<style type='text/css'>
body{
margin:0;
padding:0;
}
div{
    padding-left:30px;
}
</style>
</head>
<body>
<div style='padding-top:20px;height:60px;background:#fafafa;border-bottom:1px solid #ddd;font-size:18px;font-weight:bold'> 密码修改 </div>
<div style='margin-top:20px;'>
<p>
尊敬的用户 %account%
<br>
您的注册信息：
<br>
安全邮箱:
<a href='mailto:%safeMail%' target='_blank'>%safeMail%</a>
<br>
请点击下面的链接，进行密码修改:
<br>
<a href='%resetURL%' target='_blank'>%resetURL%</a>
</p>
<p>重置码：%resetKey%</p>
</div>
<div style='height:20px;border-bottom:1px solid #ddd;'></div>
<div style='line-height:160%;margin:20px 0 0 0 ;'>
%notice%
</div>
<script language='javascript'>
try{parent.JS.modules[window.name].content.setHeight();}catch(e){}
</script>
</body>
</html>";

$lang->user->errorDeny     = "抱歉，您无权访问『<b>%s</b>』模块的『<b>%s</b>』功能。请联系管理员获取权限。点击后退返回上页。";
$lang->user->loginFailed   = "登录失败，请检查您的用户名或密码是否填写正确。";
$lang->user->lblRegistered = '恭喜您，已经成功注册。';
$lang->user->submit   = '提交';

$lang->user->gendarList['m'] = '男';
$lang->user->gendarList['f'] = '女';

$lang->user->register = new stdclass();
$lang->user->register->welcome    = '欢迎注册成为会员';
$lang->user->register->why        = '欢迎注册成为我们的会员，您可以享受更多的服务。';
$lang->user->register->lblUserInfo= '用户信息';
$lang->user->register->lblAccount = '请设置您的用户名，英文字母和数字的组合';
$lang->user->register->lblPassword= '请设置您的密码。数字和字母的组合，六位以上。';

/* front of zentaoasm */
$lang->user->login = new stdclass();
$lang->user->login->common  = "登录";
$lang->user->login->welcome = '欢迎登录';
$lang->user->login->why     = '欢迎登陆我们的系统，这样您可以使用我们为注册会员提供的各种服务。';

$lang->user->control = new stdclass();
$lang->user->control->common      = '用户中心';
$lang->user->control->welcome     = '欢迎您，<strong>%s</strong>';
$lang->user->control->lblPassword = "留空，则保持不变。";

$lang->user->modifyPassword = '修改密码';
$lang->user->oldPassword    = '原密码';
$lang->user->password       = '新密码';
$lang->user->password2      = '请重复密码';
$lang->user->diffPassword   = '2次密码输入不同';
$lang->user->oldPasswordIsWrong    = '原密码错误';
$lang->user->insideNotLoginFront   = '内部账号不能登录前台!';
$lang->user->customerNotLoginAdmin = '客户账户不能登录后台!';
$lang->user->lblAccount            = '应当为字母和数字的组合，至少三位';
$lang->user->lblExtendServiceTime  = '(可累加)';

$lang->user->control->menus[5]   = '我的服务|user|myService';
$lang->user->control->menus[10]  = '提出问题|request|request';
$lang->user->control->menus[20]  = '我的问题|request|browse';
$lang->user->control->menus[40]  = '个人资料|user|profile';
$lang->user->control->menus[50]  = '修改密码|user|modifyPassword';
$lang->user->control->menus[60]  = '退出登录|user|logout';

/* customers of zentaoasm */
$lang->user->customer = new stdclass(); 
$lang->user->inside   = new stdclass(); 
$lang->user->customer->manage  = '客户账户管理'; 
$lang->user->inside->manage    = '内部账户管理'; 
$lang->user->id                = '编号';
$lang->user->account           = '用户名';
$lang->user->password          = '密码';
$lang->user->password2         = '请重复密码';
$lang->user->realname          = '真实姓名';
$lang->user->nickname          = '昵称';
$lang->user->role              = '角色';
$lang->user->avatar            = '头像';
$lang->user->birthday          = '出生月日';
$lang->user->gendar            = '性别';
$lang->user->email             = '邮箱';
$lang->user->msn               = 'MSN';
$lang->user->qq                = 'QQ';
$lang->user->yahoo             = '雅虎通';
$lang->user->gtalk             = 'GTalk';
$lang->user->wangwang          = '旺旺';
$lang->user->mobile            = '手机';
$lang->user->phone             = '电话';
$lang->user->company           = '公司/组织';
$lang->user->address           = '通讯地址';
$lang->user->zipcode           = '邮编';
$lang->user->join              = '加入日期';
$lang->user->visits            = '访问次数';
$lang->user->ip                = '最后IP';
$lang->user->last              = '最后登录时间';
$lang->user->manageServiceTime = '服务期限管理';
$lang->user->serviceTime       = '服务截止时间';
$lang->user->status            = '状态';
$lang->user->alert             = '您的帐号已被禁用';
$lang->user->extendServiceTime = '延长服务时间';
$lang->user->operate           = '操作';
$lang->user->product           = '产品';
$lang->user->serviceID         = '产品服务编号';
$lang->user->addProductService = '添加产品服务';

$lang->user->roleList['servicer'] = '客服';
$lang->user->roleList['manager']  = '客服经理';
$lang->user->roleList['support']  = '技术人员';
$lang->user->roleList['admin']    = '系统管理员';

$lang->user->customer->onemonth     = '一个月';
$lang->user->customer->twomonthes   = '两个月';
$lang->user->customer->threemonthes = '三个月';
$lang->user->customer->sixmonthes   = '半年';
$lang->user->customer->oneyear      = '一年';

$lang->user->forbid = '禁用';
$lang->user->allow  = '激活';
$lang->user->edit   = '编辑';
$lang->user->modifySelf = '你只能编辑自己的资料，如果你执行此操作三次，将被放入黑名单!';

$lang->user->inside->create          = '添加内部帐户';
$lang->user->inside->created         = '添加内部帐户成功';
$lang->user->inside->editProfile     = '修改内部帐户资料';
$lang->user->inside->createProfile   = '添加内部帐户资料';
$lang->user->customer->create        = '添加客户';
$lang->user->customer->created       = '添加客户成功';
$lang->user->customer->editProfile   = '修改客户资料';
$lang->user->customer->createProfile = '添加客户资料';

/* backyard of zentaoasm*/
$lang->user->admin = new stdclass();
$lang->user->admin->account  = '用户名';
$lang->user->admin->password = '密码';

$lang->user->sync = new stdclass();
$lang->user->sync->noPostData  = '没有数据';
$lang->user->cannotCreate      = '同步功能已经打开，为了数据的安全，不能直接添加内部帐号！';
