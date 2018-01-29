<?php
namespace framework\dao;
use framework\dao\I_Dao;
use PDO;

/*
 * ����PDO��
 * ͨ��PDO���������ݿ�
 * */
//����ӿڣ�ʵ�ֽӿ�
//����ģʽʵ�������ݿ��ࣺ��˽һ��
class DaoPDO implements I_Dao {
    //1.˽�л���̬����
    private static $instance;
    //2.˽�л����췽��
    private function __construct($option){
        //��ʼ�����ԣ������Ը�ֵ
        $this->initOPtions($option);
        //��ʼ��PDO����
        $this->initPDO();
    }
    //3.˽�л�clone(��ֹ��¡����)
    private function __clone(){}
    //4.���л���̬����(���ⲿʵ��������ķ���)
    public static function getSingleton($option){
        //instanceof ����ȷ��һ�� PHP �����Ƿ�����ĳһ�� class ��ʵ��
        if(!self::$instance instanceof self){
            self::$instance = new self($option);
        }
        return self::$instance;
    }
    //��ʼ���������ݿ�����Եķ���
    private function initOptions($option){
        $this->host = $option['host'];
        $this->user = $option['user'];
        $this->pwd = $option['pwd'];
        $this->port = $option['port'];
        $this->dbname = $option['dbname'];
        $this->charset = $option['charset'];
    }
    //��ʼ��PDO����ķ���
    private function initPDO(){
        $dsn = "mysql:host={$this->host};dbname={$this->dbname};port={$this->port};charset={$this->charset}";
        $user = $this->user;
        $pwd = $this->pwd;
        $this->pdoObj = new PDO($dsn, $user, $pwd);
    }

    //��query���з�װһ��
    private function query($sql){
        return $this->pdoObj->query($sql);
    }
    //��ѯ���м�¼
    public function fetchAll($sql){
        //��sql����װ��query������
        $pdo_statement = $this->query($sql);
        //���ڷ��صĽ�������ж�
        if($pdo_statement == false){
            $err_arr = $this->pdoObj->errorInfo();
            $err_info = $err_arr[2];
            echo $err_info;
            return false;
        }
        return $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
    }
    //��ѯһ����¼
    public function fetchRow($sql){
        //��sql����װ��query������
        $pdo_statement = $this->query($sql);
        //���ڷ��صĽ�������ж�
        if($pdo_statement == false){
            $err_arr = $this->pdoObj->errorInfo();
            $err_info = $err_arr[2];
            echo $err_info;
            return false;
        }
        return $pdo_statement->fetch(PDO::FETCH_ASSOC);
    }
    //��ѯһ���ֶε�ֵ
    public function fetchColum($sql){
        //��sql����װ��query������
        $pdo_statement = $this->query($sql);
        //���ڷ��صĽ�������ж�
        if($pdo_statement == false){
            $err_arr = $this->pdoObj->errorInfo();
            $err_info = $err_arr[2];
            echo $err_info;
            return false;
        }
        return $pdo_statement->fetchColumn(PDO::FETCH_ASSOC);
    }
    //ִ����ɾ��
    public function exec($sql){
        //$this->pdoObj->exec�᷵����Ӱ��ļ�¼������
        $result = $this->pdoObj->exec($sql);
        if($result === false){
            $err_arr = $this->pdoObj->errorInfo();
            $err_info = $err_arr[2];
            echo $err_info;
            return false;
        }
        //����Ӱ��ļ�¼����������
        $this->affectedRows = $result;
        return true;
    }
    //�������ظ���Ӽ�¼��������ֵ
    public function lastInsertId(){
        return $this->pdoObj->lastInsertId();
    }
    //ɾ�ģ�������Ӱ��ļ�¼��
    public function affectedRows(){
        return $this->affectedRows;
    }
    //�Խ�Ҫ�������ݿ�����ݽ���ת�루��ע�룩
    public function quoteValues($data){
        return $this->pdoObj->quote($data);
    }
}