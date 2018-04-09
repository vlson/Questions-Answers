<?php
namespace admin\controller;
use framework\core\Controller;
use framework\core\Factory;
use framework\tools\Upload;
use framework\tools\Thumb;
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

		$res = $this->modelObj->getTreeCategory($categoryList);

		$this->smartyObj->assign('category', $res);
		$this->smartyObj->display('category/add.html');
	}
	//分类添加
	public function addHandleAction(){
		$dataPost = $_POST;

		//先接收上传的文件内容，对其进行压缩等操作
		$uploadObj = new Upload();
		//var_dump(UPLOAD_PATH);die;
		$uploadObj->setUploadPath(UPLOAD_PATH.'category/');
		//var_dump($_FILES);
		$fileName = $uploadObj->doUpload($_FILES['catLogo']);
		//var_dump($fileName);die;

		//生成缩略图
		$thumbObj = new Thumb($fileName);
		$thumbObj->setThumbPath(THUMB_PATH.'category/');
		$thumbObj->makeThumb(50,50);

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
	//分类编辑
	public function editAction(){
		$catId = $_GET['id'];
		$field = array('catId','catName','parentId');
		$where = array('catId'=>$catId);
		$catInfo = $this->modelObj->findCategory($field, $where);

		$this->smartyObj->assign('catInfo', $catInfo);
		$categoryList = $this->modelObj->getAllCategory();
		$this->smartyObj->assign('category', $categoryList);
		$this->smartyObj->display('category/edit.html');
	}
	//分类编辑保存
	public function updateAction(){
		$catId = $_POST['catId'];
		$catName = $_POST['catName'];
		$parentId = $_POST['parentId'];

		$data = array('catName'=>$catName, 'parentId'=>$parentId);
		$where = array('catId'=>$catId);

		$res = $this->modelObj->updateCategory($data, $where);
		if($res){
			$this->jump("修改成功！", "index.php?m=admin&c=category&a=index", 3);
		}else{
			$this->jump("修改失败！错误信息为：".$this->modelObj->showError(), "index.php?m=admin&c=category&a=index", 3);
		}


	}

}