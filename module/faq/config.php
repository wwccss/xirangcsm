<?php
global $lang;

$config->faq         = new stdclass();
$config->faq->editor = new stdclass();
$config->faq->editor->edit      = array('id' => 'answer' , 'tools' => 'simpleTools');
$config->faq->editor->create    = array('id' => 'answer' , 'tools' => 'simpleTools');

$config->faq->create->requiredFields = 'category,request,answer';
$config->faq->edit->requiredFields   = 'category,request,answer';
