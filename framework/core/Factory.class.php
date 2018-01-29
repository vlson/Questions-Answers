<?php
namespace framework\core;
/**
 * ����������
 * User: lxj
 */
class Factory{
    public static function M($moduleName){
        static $model_list = array();
        if(!isset($model_list[$moduleName])){
        	$moduleName = MODULE.'\\model\\'.$moduleName;
            $model_list[$moduleName] = new $moduleName;
        }
        return $model_list[$moduleName];
    }
}