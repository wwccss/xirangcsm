<?php
global $lang;
$config->request->search['module'] = 'request';

$config->request->search['fields']['title']       = $lang->request->title;
$config->request->search['fields']['id']          = $lang->request->id;
$config->request->search['fields']['customer']    = $lang->request->customer;
$config->request->search['fields']['assignedTo']  = $lang->request->assignedTo;
$config->request->search['fields']['status']      = $lang->request->status;
$config->request->search['fields']['product']     = $lang->request->product;
$config->request->search['fields']['addedDate']   = $lang->request->addedDate;
$config->request->search['fields']['repliedBy']   = $lang->request->repliedBy;
$config->request->search['fields']['repliedDate'] = $lang->request->repliedDate;
$config->request->search['fields']['closedBy']    = $lang->request->closedBy;
$config->request->search['fields']['closedDate']  = $lang->request->closedDate;

$config->request->search['params']['title']      = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->request->search['params']['id']         = array('operator' => '>=',      'control' => 'input',  'values' => '');
$config->request->search['params']['customer']   = array('operator' => '=',       'control' => 'select', 'values' => 'users');
$config->request->search['params']['assignedTo'] = array('operator' => '=',       'control' => 'select', 'values' => 'users');
$config->request->search['params']['closedBy']   = array('operator' => '=',       'control' => 'select', 'values' => 'users');
$config->request->search['params']['repliedBy']  = array('operator' => '=',       'control' => 'select', 'values' => 'users');
$config->request->search['params']['status']     = array('operator' => '=',       'control' => 'select', 'values' => array('' => '') + $lang->request->statusList);
$config->request->search['params']['product']    = array('operator' => '=',       'control' => 'select', 'values' => 'products');

$config->request->search['params']['addedDate']   = array('operator' => '>=',       'control' => 'input', 'values' => '', 'class' => 'date');
$config->request->search['params']['closedDate']  = array('operator' => '>=',       'control' => 'input', 'values' => '', 'class' => 'date');
$config->request->search['params']['repliedDate'] = array('operator' => '>=',       'control' => 'input', 'values' => '', 'class' => 'date');

$config->request->editor = new stdclass();
$config->request->editor->create    = array('id' => 'desc' , 'tools' => 'simpleTools');
$config->request->editor->edit      = array('id' => 'desc' , 'tools' => 'simpleTools');
$config->request->editor->view      = array('id' => 'comment,reply,evaluation' , 'tools' => 'simpleTools');
$config->request->editor->request   = array('id' => 'desc' , 'tools' => 'simpleTools');
$config->request->editor->valuate   = array('id' => 'comment' , 'tools' => 'simpleTools');
