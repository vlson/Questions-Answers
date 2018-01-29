<?php
namespace admin\model;
use framework\core\Model;

class CategoryModel extends Model {
	//该控制器文件对应的表格
    public $logic_table = 'category';
    public $full_table = '';
    public function __construct(){
    	parent::__construct();
    	$this->full_table = $GLOBALS['config']['prefix_table'].$this->logic_table;
    }

    //定义查询数据方法
    public function fetch(){
        $sql = "select goods_id,goods_name,shop_price from ".$this->full_table;
        return $this->daoObj->fetchAll($sql);
    }
    //定义增删改方法
    public function exec(){
    	
    }
    public function selectAll(){
    	$sql = "select * from ".$this->full_table;
    	return $this->daoObj->fetchAll($sql);
    }
    //插入一个商品
    public function insertGoods(){
        $data = [
            '华为'    =>  'mate10',
            '荣耀'    =>  'v10',
        ];
        $insertId = $this->insert($data);
        return $insertId;
    }
    //删除一个商品
    public function deleteGoods(){
        $id = 0;
        $res = $this->delete($id);
        return $res;
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
}

