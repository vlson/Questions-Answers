<?php
namespace framework\dao;
/**
 * PDO接口
 * User: lxj
 */
interface I_Dao{
    //查询所有记录
    public function fetchAll($sql);
    //查询一条记录
    public function fetchRow($sql);
    //查询一个字段的值
    public function fetchColum($sql);
    //执行增删改
    public function exec($sql);
    //增：返回刚添加记录的主键的值
    public function lastInsertId();
    //删改：返回受影响的记录数
    public function affectedRows();
    //对将要插入数据库的数据进行转译（防注入）
    public function quoteValues($data);
}