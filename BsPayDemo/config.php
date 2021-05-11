<?php

namespace BsPayDemo;
use BsPaySdk\BsPay;
use BsPayDemo\constants\DemoConstants;

# 以下配置为开发联调时覆盖SDK的配置项，需在引入SDK的init.php之前配置以覆盖SDK初始配置
# 设置是否调试模式，不配置默认关闭：false
define("DEBUG", true);

# 设置调试日志路径，不配置默认为SDK同级的log目录下
define("LOG", dirname(__FILE__)."/log");

# 设置生产模式，不配置默认生产模式：true
define("PROD_MODE", true);

// SDK 初始化文件加载
require_once  dirname(__FILE__). "/../BsPaySdk/init.php";

// 配置商户信息
require_once dirname(__FILE__) . "/constants/DemoConstants.php";

/**
 * init方法参数介绍
 * 第一个是配置文件路径或者配置数组对象
 * 第二个参数是是标识第一个参数的类型 true为数组对象 false为文件路径，默认false
 * 第三个是标识配置信息的key，可自定义，保证多套配置不重复即可，默认default，只有一套配置可不传
 **/
BsPay::init(dirname(__FILE__). '/config/config.json', false);

$merConfig = array(
    "product_id" => DemoConstants::DEMO_PRODUCT_ID,
    "sys_id" => DemoConstants::DEMO_SYS_ID,
    "rsa_private_key" => DemoConstants::RSA_PRIVATE_KEY,
    "rsa_public_key" => DemoConstants::RSA_PUBLIC_KEY
);

BsPay::init($merConfig, true, "merchantKey2");
