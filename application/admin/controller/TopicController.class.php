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
		// var_dump($_FILES);
		// var_dump($_POST);die;
		//接受数据并验证
		$dataPost = $_POST;
		$checkRes = $this->modelObj->checkData($dataPost);
		if($checkRes){
			//上传图片并产生压缩图片
			//先接收上传的文件内容，对其进行压缩等操作
			$uploadObj = new Upload();
			//var_dump(UPLOAD_PATH);die;
			$uploadObj->setUploadPath(UPLOAD_PATH.'topic/');
			//var_dump($_FILES);
			$fileName = $uploadObj->doUpload($_FILES['topicLogo']);
			//var_dump($fileName);die;

			//生成缩略图
			$thumbObj = new Thumb($fileName);
			$thumbObj->setThumbPath(THUMB_PATH.'topic/');
			$thumbPath = $thumbObj->makeThumb(50,50);

			$dataPost['topicLogo'] = $thumbPath;
			$dataPost['addTime'] = date("Y-m-d H:i:s");
			$dataPost['focusNums'] = 0;
			$dataPost['talkNums'] = 0;

			$addRes = $this->modelObj->topicAdd($dataPost);
			if($addRes){
				$this->jump('恭喜您，添加成功！', '?m=admin&c=topic&a=index');
			}else{
				$this->jump('很遗憾，添加失败，失败原因为：'.$this->modelObj->showError(), "?m=admin&c=topic&a=add");
			}
		}else{
			$this->jump('很遗憾，添加失败，失败原因为：传递数据不符合要求,'.$this->modelObj->showError(), "?m=admin&c=topic&a=add");
		}
	}
	//4.显示话题修改的页面
	public function editAction(){
		//查询话题信息
		$topicId = $_GET['topicId'];

		$field = array('topicId','topicTitle','topicDesc', 'topicLogo');
		$where = array('topicId'=>$topicId);
		$topicInfo = $this->modelObj->findTopic($field, $where);

		$this->smartyObj->assign('topicInfo', $topicInfo);
		$this->smartyObj->display('topic/edit.html');
	}
	//5.执行话题修改的方法
	public function updateAction(){
		$topicId = $_POST['topicId'];
		$topicTitle = $_POST['topicTitle'];
		$topicDesc = $_POST['topicDesc'];
		$oldTopicLogo = $_POST['oldTopicLogo'];

		// var_dump($_POST);
		// var_dump($_FILES['catLogo']);die;
		$data = array('topicTitle'=>$topicTitle, 'topicDesc'=>$topicDesc);
		$where = array('topicId'=>$topicId);

		if($_FILES['topicLogo']['error'] == 0){
			//
			//先接收上传的文件内容，对其进行压缩等操作
			$uploadObj = new Upload();
			$uploadObj->setUploadPath(UPLOAD_PATH.'topic/');
			$fileName = $uploadObj->doUpload($_FILES['topicLogo']);

			//生成缩略图
			$thumbObj = new Thumb($fileName);
			$thumbObj->setThumbPath(THUMB_PATH.'topic/');
			$thumbPath = $thumbObj->makeThumb(50,50);

			//再删除旧的图片(原图&缩略图)
			@unlink(THUMB_PATH.'topic/'.$oldTopicLogo);
			$logoPath = str_replace('thumb_', '', $oldTopicLogo);
			@unlink(UPLOAD_PATH.'topic/'.$logoPath);

			$data['topicLogo'] = $thumbPath;

		}
		$res = $this->modelObj->updateTopic($data, $where);
		if($res){
			$this->jump("修改成功！", "index.php?m=admin&c=topic&a=index", 3);
		}else{
			$this->jump("修改失败！错误信息为：".$this->modelObj->showError(), "index.php?m=admin&c=topic&a=index", 3);
		}
	}
	//6.删除话题的方法
	public function deleteAction(){
		$topicId = $_GET['topicId'];
		//首先查询该话题i的信息
		$field = array('topicId', 'topicTitle', 'topicLogo');
		$where = array('topicId'=>$topicId);
		$topicInfo = $this->modelObj->findTopic($field, $where);

		//删除图片和压缩图
		@unlink(THUMB_PATH.'topic/'.$topicInfo['topicLogo']);
		$logoPath = str_replace('thumb_', '', $topicInfo['topicLogo']);
		@unlink(UPLOAD_PATH.'topic/'.$logoPath);

		//删除数据
		$delRes = $this->modelObj->topicDelete($topicId);
		if($delRes){
			$this->jump('恭喜您，删除成功！', '?m=admin&c=topic&a=index');
		}else{
			$this->jump('很遗憾，删除失败，失败原因为：'.$this->modelObj->showError(), "?m=admin&c=topic&a=add");
		}
	}
}