<?php
global $lang;
$config->request->search['module'] = 'request';

$config->request->search['fields']['title']    = $lang->request->title;
$config->request->search['fields']['category'] = $lang->request->category;
$config->request->search['fields']['id']       = $lang->request->id;
$config->request->search['fields']['customer'] = $lang->request->customer;

$config->request->search['params']['title']    = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->request->search['params']['category'] = array('operator' => '=',       'control' => 'select', 'values' => '');
$config->request->search['params']['id']       = array('operator' => '>=',      'control' => 'input',  'values' => '');
$config->request->search['params']['customer'] = array('operator' => '=',       'control' => 'select', 'values' => 'users');

$config->request->editor = new stdclass();
$config->request->editor->edit      = array('id' => 'desc' , 'tools' => 'simpleTools');
$config->request->editor->view      = array('id' => 'comment,reply,evaluation' , 'tools' => 'simpleTools');
$config->request->editor->request   = array('id' => 'desc' , 'tools' => 'simpleTools');
$config->request->editor->valuate   = array('id' => 'comment' , 'tools' => 'simpleTools');
