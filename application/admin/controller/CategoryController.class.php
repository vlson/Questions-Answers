<?php
namespace admin\controller;
use framework\core\Controller;
use framework\core\Factory;

/*
*分类控制器，负责分类的管理
*分类的增删改查
*/
class CategoryController extends Controller{
	public function __construct(){
		parent::__construct();
		$this->modelObj = Factory::M("CategoryModel");
	}
	//商品显示首页
	public function indexAction(){
		$categoryList = $this->modelObj->selectAll();
		$this->smartyObj->assign('category', $categoryList);
		$this->smartyObj->display('CategoryList.html');
	}

}