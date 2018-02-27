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
	//分类显示首页
	public function indexAction(){
		$categoryList = $this->modelObj->getAllCategory();
		$this->smartyObj->assign('category', $categoryList);
		$this->smartyObj->display('category/index.html');
	}
	//分类添加页
	public function addAction(){
		$categoryList = $this->modelObj->getAllCategory();
		$this->smartyObj->assign('category', $categoryList);
		$this->smartyObj->display('category/add.html');
	}
	//分类添加
	public function addHandleAction(){
		$dataPost = $_POST;
		//插入到数据库
		$lastInsertId = $this->modelObj->cat_add($dataPost);
		if($lastInsertId){
			$this->jump("添加成功，分类ID为【 $lastInsertId 】", "index.php?m=admin&c=category&a=index", 3);
		}else{
			$this->jump("添加失败！错误信息为：".$this->modelObj->showError(), "index.php?m=admin&c=category&a=add", 3);
		}
	}
	//分类删除
	public function deleteAction(){
		$catId = $_GET['id'];
		$res = $this->modelObj->cat_delete($catId);
		if($res){
			$this->jump("删除成功！", "index.php?m=admin&c=category&a=index", 3);
		}else{
			$this->jump("删除失败！错误信息为：".$this->modelObj->showError(), "index.php?m=admin&c=category&a=index", 3);
		}
	}

}