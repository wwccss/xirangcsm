<?php
$config->installed       = true;    //标志是否已经安装。
$config->debug           = false;   //是否打开debug功能。如果系统运行不正常，可将其设为true。
$config->requestType     = 'PATH_INFO'; //如何获取当前请求的信息，可选值：PATH_INFO|GET。
$config->db->host        = 'localhost'; //mysql主机。
$config->db->port        = '3306';  //mysql主机端口号。
$config->db->name        = 'zentaocs';  //数据库名称。
$config->db->user        = 'root';  //数据库用户名。
$config->db->password    = 'zentao';        //密码。
$config->db->prefix      = 'zt_';   //表前缀。
$config->webRoot         = '/';     //web网站的根目录。如果后面pms的目录有变化，需要修改此选项。
