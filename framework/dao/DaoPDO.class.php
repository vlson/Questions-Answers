<?php
namespace framework\dao;
use framework\dao\I_Dao;
use PDO;

/*
 * 这是PDO类
 * 通过PDO，操作数据库
 * */
//引入接口，实现接口
//单例模式实例化数据库类：三私一公
class DaoPDO implements I_Dao {
    //1.私有化静态属性
    private static $instance;
    //2.私有化构造方法
    private function __construct($option){
        //初始化属性，给属性赋值
        $this->initOPtions($option);
        //初始化PDO对象
        $this->initPDO();
    }
    //3.私有化clone(禁止克隆该类)
    private function __clone(){}
    //4.公有化静态方法(供外部实例化对象的方法)
    public static function getSingleton($option){
        //instanceof 用于确定一个 PHP 变量是否属于某一类 class 的实例
        if(!self::$instance instanceof self){
            self::$instance = new self($option);
        }
        return self::$instance;
    }
    //初始化连接数据库的属性的方法
    private function initOptions($option){
        $this->host = $option['host'];
        $this->user = $option['user'];
        $this->pwd = $option['pwd'];
        $this->port = $option['port'];
        $this->dbname = $option['dbname'];
        $this->charset = $option['charset'];
    }
    //初始化PDO对象的方法
    private function initPDO(){
        $dsn = "mysql:host={$this->host};dbname={$this->dbname};port={$this->port};charset={$this->charset}";
        $user = $this->user;
        $pwd = $this->pwd;
        $this->pdoObj = new PDO($dsn, $user, $pwd);
    }

    //将query进行封装一下
    private function query($sql){
        return $this->pdoObj->query($sql);
    }
    //查询所有记录
    public function fetchAll($sql){
        //将sql语句封装到query方法中
        $pdo_statement = $this->query($sql);
        //对于返回的结果进行判断
        if($pdo_statement == false){
            $err_arr = $this->pdoObj->errorInfo();
            $err_info = $err_arr[2];
            echo $err_info;
            return false;
        }
        return $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
    }
    //查询一条记录
    public function fetchRow($sql){
        //将sql语句封装到query方法中
        $pdo_statement = $this->query($sql);
        //对于返回的结果进行判断
        if($pdo_statement == false){
            $err_arr = $this->pdoObj->errorInfo();
            $err_info = $err_arr[2];
            echo $err_info;
            return false;
        }
        return $pdo_statement->fetch(PDO::FETCH_ASSOC);
    }
    //查询一个字段的值
    public function fetchColum($sql){
        //将sql语句封装到query方法中
        $pdo_statement = $this->query($sql);
        //对于返回的结果进行判断
        if($pdo_statement == false){
            $err_arr = $this->pdoObj->errorInfo();
            $err_info = $err_arr[2];
            echo $err_info;
            return false;
        }
        return $pdo_statement->fetchColumn(PDO::FETCH_ASSOC);
    }
    //执行增删改
    public function exec($sql){
        //$this->pdoObj->exec会返回受影响的记录的条数
        $result = $this->pdoObj->exec($sql);
        if($result === false){
            $err_arr = $this->pdoObj->errorInfo();
            $err_info = $err_arr[2];
            echo $err_info;
            return false;
        }
        //将受影响的记录数保存起来
        $this->affectedRows = $result;
        return true;
    }
    //增：返回刚添加记录的主键的值
    public function lastInsertId(){
        return $this->pdoObj->lastInsertId();
    }
    //删改：返回受影响的记录数
    public function affectedRows(){
        return $this->affectedRows;
    }
    //对将要插入数据库的数据进行转译（防注入）
    public function quoteValues($data){
        return $this->pdoObj->quote($data);
    }
}