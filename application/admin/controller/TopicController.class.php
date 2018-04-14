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
class TopicController extends Controller{
	public function __construct(){
		parent::__construct();
		$this->modelObj = Factory::M("TopicModel");
	}
	//1.显示话题的页面
	public function indexAction(){
		//查询所有的话题
		$topicList = $this->modelObj->getAllTopic();
		//var_dump($topicList);die;

		$this->smartyObj->assign('topicList', $topicList);
		$this->smartyObj->display('topic/index.html');
	}
	//2.显示话题添加的页面
	public function addAction(){
		$this->smartyObj->display('topic/add.html');
	}
	//3.执行话题添加的方法
	public function addHandleAction(){
		var_dump($_POST);die;
	}
	//4.显示话题修改的页面
	public function editAction(){}
	//5.执行话题修改的方法
	public function updateAction(){}
	//6.删除话题的方法
	public function deleteAction(){}
}