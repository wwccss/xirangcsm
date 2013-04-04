<?php
/**
 * The user module english file of ZenTaoASM.
 *
 * @copyright   Copyright 2009-2011 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     user
 * @version     $Id$
 * @link        http://www.zentao.net
 */
$lang->user->common        = 'User';
$lang->user->view          = "User info";
$lang->user->create        = "Add a user";
$lang->user->edit          = "Edit user";
$lang->user->update        = "Edit user";
$lang->user->delete        = "Delete user";
$lang->user->browse        = "Borwse";
$lang->user->deny          = "Access denied";
$lang->user->confirmDelete   = "Are you sure to delete this user?";
$lang->user->confirmActivate = "Are you sure to activate this user?";
$lang->user->relogin         = "Relogin";
$lang->user->asGuest         = "Visits as guest";
$lang->user->goback          = "Go back";
$lang->user->allUsers        = 'All users';

$lang->user->profile     = 'Profile';
$lang->user->editProfile = 'Edit profile';
$lang->user->thread      = 'My threads';
$lang->user->reply       = 'My replies';
$lang->user->message     = 'My message';

$lang->user->errorDeny   = "Sorry, you don't have the permission to access <b>%s</b>'s<b>%s</b>. Please contact the administrator.";
$lang->user->loginFailed = "Login failed, please check you account and password.";

$lang->user->genderList['m'] = 'Male';
$lang->user->genderList->['f'] = 'Female';

$lang->user->register->welcome    = 'Welcome to register as a member.';
$lang->user->register->why        = 'After register, you can achieve mor features and services.';
$lang->user->register->lblUserInfo= 'User info';
$lang->user->register->lblAccount = 'The account must be a series of letters and/or numbers';
$lang->user->register->lblPassword= 'Please set you password, at lest six leeters or numbers.';

/* front of zentaoasm */
$lang->user->login->common  = "Login";
$lang->user->login->welcome = 'Welcom';
$lang->user->login->why     = 'Login, and use more feature.';

$lang->user->control->common      = 'User dashboard';
$lang->user->control->welcome     = 'Welcome, <strong>%s</strong>';
$lang->user->control->lblPassword = "Keep empty, will not change password.";

$lang->user->modifyPassword = 'Modify Password';
$lang->user->oldPassword    = 'Old Password';
$lang->user->password       = 'New Password';
$lang->user->password2      = 'Repeat it';
$lang->user->diffPassword   = 'Password is not same';
$lang->user->oldPasswordIsWrong    = 'Old password is wrong!';
$lang->user->insideNotLoginFront   = 'Inside Account can not login front!';
$lang->user->customerNotLoginAdmin = 'Customer can not login admin!';
$lang->user->lblAccount            = 'Should be interger and float, and least at three letters.';
$lang->user->lblExtendServiceTime  = '(Could be added)';

global $config;
$lang->user->control->menus[10]  = 'Profile|profile';
$lang->user->control->menus[20]  = 'Edit|edit';
$lang->user->control->menus[28]  = 'My message|user|message';
if($config->features->forum)
{
    $lang->user->control->menus[30] = 'My threads|thread';
    $lang->user->control->menus[40] = 'My replies|reply';
}
$lang->user->control->menus[45]  = 'ModifyPassword|user|modifyPassword';
$lang->user->control->menus[50]  = 'Logout|logout';

/* zentaoasm */
$lang->user->customer->manage            = 'Manage customers'; 
$lang->user->inside->manage              = 'Manage inside accounts'; 
$lang->user->id                = 'ID';
$lang->user->account           = 'Account';
$lang->user->password          = 'Password';
$lang->user->password2         = 'Repeat it';
$lang->user->realname          = 'Real name';
$lang->user->nickname          = 'Nick name';
$lang->user->role              = 'Role';
$lang->user->avatar            = 'Avatar';
$lang->user->birthday          = 'Birthday';
$lang->user->gender            = 'Gender';
$lang->user->email             = 'Email';
$lang->user->msn               = 'MSN';
$lang->user->qq                = 'QQ';
$lang->user->yahoo             = 'Y!';
$lang->user->gtalk             = 'GTalk';
$lang->user->wangwang          = 'Wangwang';
$lang->user->mobile            = 'Mobile';
$lang->user->phone             = 'Phone';
$lang->user->company           = 'Company'; 
$lang->user->address           = 'Address';
$lang->user->zipcode           = 'Zipcode';
$lang->user->join              = 'Join date';
$lang->user->visits            = 'Visits';
$lang->user->ip                = 'Last ip address';
$lang->user->last              = 'Last login time';
$lang->user->serviceTime       = 'Service Time';
$lang->user->status            = 'Status';
$lang->user->alert             = 'Forbid login';
$lang->user->extendServiceTime = 'Extend service time';
$lang->user->operate           = 'Action';

$lang->user->roleList['servicer'] = 'Servicer';
$lang->user->roleList['manager']  = 'Manager';
$lang->user->roleList['admin']    = 'admin';

$lang->user->customer->onemonth     = 'One month';
$lang->user->customer->twomonthes   = 'Two monthes';
$lang->user->customer->threemonthes = 'Three monthes';
$lang->user->customer->sixmonthes   = 'Six monthes';
$lang->user->customer->oneyear      = 'One year';

$lang->user->forbid = 'Forbid';
$lang->user->allow  = 'Allow';
$lang->user->edit   = 'Edit';
$lang->user->modifySelf = 'You can and only can edit your profile';

$lang->user->inside->create          = 'Create inside account';
$lang->user->inside->created         = 'Create inside account success';
$lang->user->inside->editProfile     = 'Edit profile of inside account';
$lang->user->inside->createProfile   = 'Create profile of inside account';
$lang->user->customer->create        = 'Create';
$lang->user->customer->created       = 'Create customer success';
$lang->user->customer->editProfile   = 'Edit profile of customer';
$lang->user->customer->createProfile = 'Create profile of customer';

/* backyard of zentaoasm*/
$lang->user->admin->account  = 'Account';
$lang->user->admin->password = 'Password';
