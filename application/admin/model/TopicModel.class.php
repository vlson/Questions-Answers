<?php
namespace admin\model;
use framework\core\Model;

class TopicModel extends Model {
	//该控制器文件对应的表格
    public $logic_table = 'topic';
    public function __construct(){
    	parent::__construct();
    }

    //定义查询数据方法
    public function fetch(){
        $sql = "select goods_id,goods_name,shop_price from ".$this->full_table;
        return $this->daoObj->fetchAll($sql);
    }
    
    public function getAllTopic(){
    	return $this->findAll();
    }
    //校验数据是否已经存在
    public function checkData($data){
        if($data['topicTitle'] == ''){
            $this->error[] = '分类标题不能为空';
        }else if((int)$data['topicTitle'] != 0){
            $this->error[] = '分类标题不能为数字';
        }else if($this->isExits($data['topicTitle'])){
            $this->error[] = '该话题名称已存在';
        }
        if($data['topicDesc'] == ''){
            $this->error[] = '话题描述不能为空';
        }
        if(!empty($this->error)){
            return false;
        }else{
            return true;
        }

    }
    //插入一个话题
    public function topicAdd($data){
        //添加数据
        $insertId = $this->insert($data);
        return $insertId;
    }
    //删除一个话题
    public function topicDelete($topicId){
        $sql = "delete from $this->true_table where topicId=$topicId";
        return $this->daoObj->exec($sql);
        
    }
    //更新一个话题
    public function updateTopic($data, $where){
        $res = $this->update($data, $where);
        if($res){
            return true;
        }else{
            return false;
        }
    }
    //查询话题
    public function findTopic($field, $where){
        $res = $this->find($field, $where);
        return $res;
    }
    //判断某个话题是否存在
    public function isExits($topicTitle){
        $sql = "select * from $this->true_table where topicTitle='$topicTitle'";
        $res = $this->daoObj->fetchColum($sql);
        if($res){
            return true;
        }else{
            return false;
        }
    }
}

