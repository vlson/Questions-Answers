<?php
/**
 * 
 * @authors 自动加载类
 * @date    2017-12-10 21:41:56
 * @version $Id$
 */
namespace framework\core;

class Framework {
    
    public function __construct(){
    	//初始化路径常量
    	$this->initConst();

    	//1.注册自动加载函数
    	$this->autoload();

    	//2.初始化MCA
    	$this->initMCA();

    	//3.加载配置文件
    	$this->initConfig();

    	//4.分发任务
    	$this->initDispatch();
        
    }

    //初始化路径常量
    private function initConst(){
    	//可以用__DIR__或者getcwd()获取当前工作目录
    	define('ROOT_PATH', str_replace('\\', '/', getcwd().'/'));

    	//定义应用程序目录
    	define('APP_PATH', ROOT_PATH . 'application/');

    	//定义框架目录路径
    	define('FRAMEWORK_PATH', ROOT_PATH . 'framework');

    	//定义公共资源的路径（绝对路径，从htdocs服务器的根目录出发）
    	define('PUBLIC_PATH', '/application/public/');
    }

    //自动加载函数(当我们访问一个类时，但这个类不存在的时候，就会出发自动加载机制):spl_autoload_register
	//会自动将需要的类名传递给设置的函数
    private function userAutoload($className){
		//echo '此时需要'.$className.'类'."<br>";
		//针对第三方类我们做特例处理
		if($className == 'Smarty'){
			require_once './framework/vendor/smarty/Smarty.class.php';
			return;
		}
		$classArr = explode('\\', $className);
		//如果需要加载的是框架类，会加上framework
		//确定根目录
		if($classArr[0] == 'framework'){
			$base_dir = './';//以index.php文件为参照
		}else{
			$base_dir = './application/';
		}
		//拼接子目录
		$sub_dir = str_replace('\\', '/', $className);
		//拼接文件后缀(有种特例：接口后缀，I_Dao.interface.php)
		if( substr($classArr[count($classArr)-1], 0, 2) == 'I_'){
			$fix = '.interface.php';
		}else{
			$fix = '.class.php';
		}

		$class_file = $base_dir.$sub_dir.$fix;
		if(file_exists($class_file)){
			require_once $class_file;
		}
	}

	//注册自动加载函数
	private function autoload(){
		//如果回调函数是是一个函数的话，直接写函数名接口
        //现在参数是对象的方法的话，需要传递一个数组的形式array(对象,"方法的名称")
		spl_autoload_register(array($this, "userAutoload"));
	}

	//初始化MCA
	private function initMCA(){
		//接收链接地址传递的参数
		//访问的前台还是后台
		$m = isset($_GET['m']) ? $_GET['m'] : 'home';
		define('MODULE', $m);
		//确定那个控制器
		$c = isset($_GET['c']) ? $_GET['c'] : 'index';
		define('CONTROLLER', $c);
		//确定具体操作
		$a = isset($_GET['a']) ? $_GET['a'] : 'index';
		define('ACTION', $a);
	}

	//初始化分发器
	private function initDispatch(){
		//因为每个类都有自己的命名空间，所以实例化对象的时候需要加上命名空间
		$controller_name = MODULE . '\\controller\\' . CONTROLLER . 'Controller';

		//实例化控制器对象
		$controller = new $controller_name;
		//调用控制器方法
		$a = ACTION . 'Action';
		$controller->$a();
	}

	//初始化配置文件
	private function initConfig(){
		$frame_config = $this->loadFrameConfig();
		$common_config = $this->loadCommonConfig();
		$GLOBALS['config'] = array_merge($frame_config, $common_config);
		$module_config = $this->loadModuleConfig();
		$GLOBALS['config'] = array_merge($GLOBALS['config'], $module_config);
	}

	//加载框架配置文件
	private function loadFrameConfig(){
		$config = require_once './framework/config/config.php';
		return $config;
	}
	//加载项目公共配置文件
	private function loadCommonConfig(){
		$config = require_once './application/common/config/config.php';
		return $config;
	}
	//加载项目模块配置文件
	private function loadModuleConfig(){
		$config = require_once './application/'. MODULE .'/config/config.php';
		return $config;
	}
}