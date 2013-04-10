<?php
/**
 * The all avaliabe actions in ZenTaoASM.
 *
 * @copyright   Copyright 2009-2011 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     group
 * @version     $Id$
 * @link        http://www.zentao.net
 */
/* Request. */
$lang->resource          = new stdclass();
$lang->resource->request = new stdclass();
$lang->resource->request->create       = 'request';
$lang->resource->request->edit         = 'edit';
$lang->resource->request->doubt        = 'doubt';
$lang->resource->request->valuate      = 'valuate';
$lang->resource->request->browse       = 'browse';
$lang->resource->request->view         = 'view';
$lang->resource->request->reply        = 'reply';
$lang->resource->request->editReply    = 'editReply';
$lang->resource->request->assignedTo   = 'assignedTo';
$lang->resource->request->transfer     = 'transfer';
$lang->resource->request->close        = 'close';
$lang->resource->request->changeStatus = 'changeStatus';
$lang->resource->request->comment      = 'comment';

/* Product. */
$lang->resource->product = new stdclass();
$lang->resource->product->manage      = 'manage';
$lang->resource->product->updateorder = 'updateorder';
$lang->resource->product->stop        = 'stop';
$lang->resource->product->online      = 'online';

/* Category.*/
$lang->resource->category = new stdclass();
$lang->resource->category->manage      = 'manage';
$lang->resource->category->updateOrder = 'updateOrder';
$lang->resource->category->delete      = 'delete';

/* FAQ. */
$lang->resource->faq = new stdclass();
$lang->resource->faq->manage       = 'manage';
$lang->resource->faq->create       = 'create';
$lang->resource->faq->delete       = 'delete';
$lang->resource->faq->edit         = 'edit';

/* User. */
$lang->resource->user = new stdclass();
$lang->resource->user->index  = 'index';
$lang->resource->user->profile= 'profile';
$lang->resource->user->edit   = 'edit';
$lang->resource->user->reset  = 'reset';
$lang->resource->user->check  = 'check';
$lang->resource->user->create = 'create';
$lang->resource->user->browse = 'browse';
$lang->resource->user->view   = 'view';
$lang->resource->user->delete = 'delete';
$lang->resource->user->forbid = 'forbid';
$lang->resource->user->allow  = 'allow';
$lang->resource->user->modifyPassword       = 'modifyPassword';
$lang->resource->user->myService            = "myService";
$lang->resource->user->addProductService    = "addProductService";
$lang->resource->user->manageServiceTime    = "manageServiceTime";
$lang->resource->user->extendServiceTIme    = "extendServiceTime";
$lang->resource->user->ajaxGetUser          = 'ajaxGetUser';

/* Group. */
$lang->resource->group = new stdclass();
$lang->resource->group->browse       = 'browse';
$lang->resource->group->managePriv   = 'managePriv';

/* Setting. */
$lang->resource->setting = new stdclass();
$lang->resource->setting->setConfig = 'setConfig';

/* Company. */
$lang->resource->company = new stdclass();
$lang->resource->company->edit = 'edit';

/* Search. */
$lang->resource->search = new stdclass();
$lang->resource->search->buildForm    = 'buildForm';
$lang->resource->search->buildQuery   = 'buildQuery';
$lang->resource->search->saveQuery    = 'saveQuery';
$lang->resource->search->deleteQuery  = 'deleteQuery';
$lang->resource->search->select       = 'select';

/* Others. */
$lang->resource->misc = new stdclass();
$lang->resource->api  = new stdclass();
$lang->resource->file = new stdclass();
$lang->resource->api->getModel     = 'getModel';
$lang->resource->file->download    = 'download';
$lang->resource->file->delete      = 'delete';
$lang->resource->file->ajaxUpload  = 'ajaxUpload';
$lang->resource->misc->ping        = 'ping';
