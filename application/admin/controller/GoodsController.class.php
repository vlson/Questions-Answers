<?php
namespace admin\controller;
use framework\core\Controller;
use framework\core\Factory;
/**
 * 
 * 商品控制器，负责商品的管理
 * 商品的增删改查
 */

class GoodsController extends Controller{
    
    public function __construct(){
        parent::__construct();
    }
    /**
     * 商品首页显示
     */
    public function indexAction(){
        $modelObj = Factory::M('GoodsModel');
        $goodsList = $modelObj->selectAll();
        $this->smartyObj->assign('goods', $goodsList);
        $this->smartyObj->display('goodsList.html');
    }
    /**
     * 增加商品
     */
    public function addAction(){
    	//命令模型处理数据
    	$modelObj = Factory::M('GoodsModel');
    	$insertId = $modelObj->insertGoods();

    	$goods = 'product test';
    	//$this->smartyObj->assign('goods', $goods);
    	//$this->smartyObj->display('goodsList.html');
    }
    /**
     * 删除商品
     */
    public function deleteAction(){
        $modelObj = Factory::M('GoodsModel');
        $res = $modelObj->deleteGoods();
        var_dump($res);
        $goods = 'product test';
    }
    /**
     * 更新商品
     */
    public function updateAction(){
        $modelObj = Factory::M('GoodsModel');
        $res = $modelObj->updateGoods();
        var_dump($res);
        $goods = 'product test';
    }
    /**
     * 查询商品
     */
    public function selectAction(){
        $modelObj = Factory::M('GoodsModel');
        $res = $modelObj->findGoods();
        var_dump($res);
        $goods = 'product test';
    }
}