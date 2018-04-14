<?php
namespace home\controller;
use framework\core\Controller;
use framework\core\Factory;

/*
**前台首页显示
*/
class IndexController extends Controller{
	public function __construct(){
		parent::__construct();
		$this->modelObj = Factory::M("CategoryModel");
	}
	//显示首页
	public function indexAction(){
		$cateList = $this->modelObj->getAllCategory();

		//分配到视图中
		$this->smartyObj->assign('cateList', $cateList);
		$this->smartyObj->display('index/index.html');
	}



}