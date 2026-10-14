<?php
// 调试模式
define("DEBUG", true);
define("LOG", dirname(__FILE__) . "/log");
define("PROD_MODE", true); // true = 生产环境，false = 沙箱环境

// 加载SDK初始化文件
require_once dirname(__FILE__) . "/BsPaySdk/init.php";

// 导入商户系统参数
\BsPaySdk\core\BsPay::init(dirname(__FILE__) . '/config/config_merch_default.json', false);
