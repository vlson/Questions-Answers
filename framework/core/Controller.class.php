<?php
namespace framework\core;
use Smarty;

/**
 * 
 * 基础控制器类
 * 封装各种控制器公共的操作
 */

class Controller{
    
    protected $smartyObj;
    public function __construct(){
    	//初始化smarty
        $this->initSmarty();
    }
    private function initSmarty(){
        $this->smartyObj = new Smarty();
        //配置模板所在目录
        $this->smartyObj->setTemplateDir(APP_PATH . MODULE . '/view/');
        //设置编译文件目录
        $this->smartyObj->setCompileDir(APP_PATH . 'runtime/tpls_c/');
        //设置模板定界符
        $this->smartyObj->left_delimiter = '<{';
        $this->smartyObj->right_delimiter = '}>';
    }
    //封装公共跳转的方法
    /*
    *参数一：跳转前提示的信息
    *参数二：跳转到的链接
    *参数三：跳转延迟的时间
    **
     */
    public function jump($message, $url, $delay = 3){
        echo $message;
        header("Refresh:$delay;url=$url");
        die;
    }
}