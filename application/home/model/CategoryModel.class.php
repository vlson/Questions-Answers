<?php
namespace home\model;
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
    //获取分类下的子分类
    //1.操作的数组
    //2.用来指定哪个分类下的子类，如果走默认值，表示查询所有分类
    public function getTreeCategory($arr, $p_id=0, $level=0){
        static $result = array();
        foreach($arr as $k=>$v){
            if($v['parentId'] == $p_id){
                $v['level'] = $level;
                $result[] = $v;
                $this->getTreeCategory($arr, $v['catId'], $level+1);
            }
        }
        return $result;
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
    public function updateCategory($data, $where){
        $res = $this->update($data, $where);
        if($res){
            return true;
        }else{
            return false;
        }
    }
    //查询商品
    public function findCategory($field, $where){
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

