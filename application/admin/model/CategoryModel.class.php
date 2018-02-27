<?php
namespace admin\model;
use framework\core\Model;

class CategoryModel extends Model {
	//该控制器文件对应的表格
    public $logic_table = 'category';
    public function __construct(){
    	parent::__construct();
    }

    //定义查询数据方法
    public function fetch(){
        $sql = "select goods_id,goods_name,shop_price from ".$this->full_table;
        return $this->daoObj->fetchAll($sql);
    }
    //定义增删改方法
    public function exec(){
    	
    }
    public function getAllCategory(){
    	return $this->findAll();
    }
    //插入一个商品
    public function cat_add($data){
        //验证数据的合法性
        if($data['catName'] == ''){
            $this->error[] = '分类标题不能为空';
        }else if((int)$data['catName'] != 0){
            $this->error[] = '分类标题不能为数字';
        }else if($this->isExits($data['catName'], $data['parentId'])){
            $this->error[] = '该分类名称已存在';
        }

        if(!empty($this->error)){
            return false;
        }

        $insertId = $this->insert($data);
        return $insertId;
    }
    //删除一个分类
    public function cat_delete($catId){
        //判断该分类是否为叶子分类
        $sql = "select * from $this->true_table where parentId=$catId";
        $res = $this->daoObj->fetchColum($sql);
        if($res){
            $this->error[] = "该分类下面还有小弟呢，可不能删除！<br>";
            return false;
        }else{
            $sql = "delete from $this->true_table where catId=$catId";
            return $this->daoObj->exec($sql);
        }
    }
    //更新一个商品
    public function updateGoods(){
        $data = array('goods_name'=>'荣耀V9');
        $where = array('goods_id'=>1);
        $res = $this->update($data, $where);
        return $res;
    }
    //查询商品
    public function findGoods(){
        $field = array('goods_name');
        $where = array('goods_id'=>1);
        $res = $this->find($field, $where);
        return $res;
    }
    //判断某个分类是否存在
    public function isExits($catName, $parentId){
        $sql = "select * from $this->true_table where catName='$catName' and parentId=$parentId";
        $res = $this->daoObj->fetchColum($sql);
        if($res){
            return true;
        }else{
            return false;
        }
    }
}

