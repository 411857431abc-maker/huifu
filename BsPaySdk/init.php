<?php

namespace BsPaySdk;

ini_set('date.timezone','Asia/Shanghai');
if (!defined("SDK_BASE")) {
    define("SDK_BASE", dirname(__FILE__));
}
if (!defined("BSPAY_CORE")) {
    define("BSPAY_CORE", SDK_BASE."/../BsPayCore");
}
if (!defined("SDK_VERSION")) {
    define("SDK_VERSION", "php#v1.0.0");
}

# 设置是否调试模式
if (!defined("DEBUG")) {
    define("DEBUG", false);
}

# 设置调试日志路径
if (!defined("LOG")) {
    define("LOG", dirname(SDK_BASE)."/log");
}

# 设置生产模式
if (!defined("PROD_MODE")) {
    define("PROD_MODE", true);
}

require_once BSPAY_CORE."/BsPay.php";
require_once BSPAY_CORE."/BsLoader.php";

# 交易类 Trans
require_once SDK_BASE."/BsPayClient.php";




