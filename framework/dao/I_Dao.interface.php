<?php
namespace framework\dao;
/**
 * PDO�ӿ�
 * User: lxj
 */
interface I_Dao{
    //��ѯ���м�¼
    public function fetchAll($sql);
    //��ѯһ����¼
    public function fetchRow($sql);
    //��ѯһ���ֶε�ֵ
    public function fetchColum($sql);
    //ִ����ɾ��
    public function exec($sql);
    //�������ظ���Ӽ�¼��������ֵ
    public function lastInsertId();
    //ɾ�ģ�������Ӱ��ļ�¼��
    public function affectedRows();
    //�Խ�Ҫ�������ݿ�����ݽ���ת�루��ע�룩
    public function quoteValues($data);
}