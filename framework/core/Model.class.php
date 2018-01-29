<?php
namespace framework\core;
use framework\dao\DaoPDO;
/*
 * 这是基础模型类
 * 主要封装其他模型公共的代码
 * */

class Model{
    protected $daoObj;
    protected $true_table;//真实的表名：前缀+表名
    protected $pk;//表的主键字段

    public function __construct(){
    	//初始化DAO
        $this->initDAO();
        //初始化表名
        $this->initTable();
        //初始化表的主键字段
        $this->initField();
    }
    private function initDAO(){
        $option = $GLOBALS['config'];
        $this->daoObj = DaoPDO::getSingleton($option);
    }
    private function initTable(){
    	$this->true_table = $GLOBALS['config']['prefix_table'].$this->logic_table;
    }
    private function initField(){
    	$sql = "desc `{$this->true_table}`";
    	$result = $this->daoObj->fetchAll($sql);
    	foreach ($result as $key => $value) {
    		if ($value['Key'] == 'PRI') {
    			$this->pk = $value['Field'];
    		}
    	}
    }

    //封装自动插入操作
    public function insert($data){
    	//获取字段名和字段值
    	$sql = "insert into {$this->true_table}";
    	$field = array_keys($data);
    	$value = array_values($data);
    	
    	//字段名加上反引号
    	$field_list = array_map(function($v){
    		return '`'. $v .'`';
    	}, $field);
    	$field_list = ' ('.implode(',', $field_list).')';
    	$sql .= $field_list;

    	//拼接value部分，需使用pdo提供的quote方法对引号转译并包裹
    	$value_list = array_map(array($this->daoObj, 'quoteValues'), $value);
    	$value_list = 'values ('.implode(',', $value_list).')';
    	$sql .= $value_list;

    	$this->daoObj->exec($sql);
    	return $this->daoObj->lastInsertId();
    }
    //封装自动删除的操作
    public function delete($id){
    	$sql = "delete from `$this->true_table` where `$this->pk` = $id";
    	return $this->daoObj->exec($sql);
    }
    //封装自动更新的操作
    public function update($data, $where){
    	//判断条件是否为空为空则不更新
    	if (!$where) {
    		return false;
    	}else{
    		//不为空，组sql条件
    		$field = array_keys($where);
    		$value = array_values($where);
    		$where = " where  `$field[0]` = {$value[0]}";
    	}
    	$field = array_keys($data);
    	$value = array_values($data);

    	//字段名加上反引号
    	$field_list = array_map(function($v){
    		return '`'. $v .'`';
    	}, $field);
    	//拼接value部分，需使用pdo提供的quote方法对引号转译并包裹
    	$value_list = array_map(array($this->daoObj, 'quoteValues'), $value);

    	//拼接字段名字和字段的值
    	$field = '';
    	foreach ($field_list as $key => $value) {
    		$field .= $value.'='.$value_list[$key].',';
    	}
    	$field = substr($field, 0, -1);

    	$sql = "update `$this->true_table` set $field $where";
    	//die($sql);
    	return $this->daoObj->exec($sql);
    }
    //封装自动查询操作
    public function find($field=null, $where=null){
    	//判断要查询的字段是否为空为空则查询全部字段
    	if (!$field) {
    		$fields = '*';
    	}else{
    		//字段名加上反引号
	    	$fields = array_map(function($v){
	    		return '`'. $v .'`';
	    	}, $field);
	    	$fields = implode(',', $fields);
    	}

    	//拼接where条件
    	if(!$where){
    		$where_str = '';
    	}else{
    		foreach ($where as $key => $value) {
    			$where_str = "where `$key` = {$this->daoObj->quoteValues($value)} ";
    		}
    	}

    	$sql = "select $fields from `$this->true_table` $where_str";
    	//die($sql);
    	return $this->daoObj->fetchRow($sql);
    }
    
}