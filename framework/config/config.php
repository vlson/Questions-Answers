<?php
/**
 * 框架配置文件
 */
return array(
	//数据库信息
	'host'					=>	'127.0.0.1',
	'dbname'				=>	'ask',
	'port'					=>	'3306',
	'user'					=>	'root',
	'pwd'					=>	'root',
	'charset'				=>	'UTF8',
	'prefix_table'			=>	'ask_',//数据表前缀
	//框架信息
	'default_moudle'		=>	'home',//默认模块是前台
	'default_controller'	=>	'index',//默认控制器是index控制器
	'default_action'		=>	'index',//默认的动作时index方法	
);