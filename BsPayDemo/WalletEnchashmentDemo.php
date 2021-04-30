<?php
namespace BsPayDemo;

use BsPaySdk\BsPayClient;
use BsPayDemo\constants\DemoConstants;

define("DEBUG", true);
define("PROD_MODE", true);
define("LOG", dirname(__FILE__)."/log");
// 加载基础 adapay 基础类
// SDK 初始化文件加载
require_once  dirname(__FILE__). "/../BsPaySdk/init.php";
// 配置商户信息
require_once  dirname(__FILE__). "/config.php";
// 配置商户信息
require_once  dirname(__FILE__). "/constants/DemoConstants.php";

$nowStr = date("YmdHis");
$nowDate = date("Ymd");
$reqSeqId = $nowStr . "01234567890";

$trans_params = array(
    "req_seq_id" => $reqSeqId,
    "req_date" => $nowDate,
    "product_id"=> DemoConstants::DEMO_PRODUCT_ID,
    "sys_id" => DemoConstants::DEMO_SYS_ID,
    "huifu_id" => DemoConstants::DEMO_HUIFU_ID,
    "token_no" => "5252255",
    "cash_amt" => "0.01",
    "into_acct_date_type" => "T1",
    "notify_url" => "virgo://http://www.xxx.com/getResp",
);

# 调用钱包取现接口
$trans = new BsPayClient();
$trans->postRequest("ssproxy.walletEnchashment", $trans_params);

if ($trans->isError()){
    //失败处理
    var_dump($trans->result);
} else {
    //成功处理
    var_dump($trans->result);
}
echo "<br>";
echo "<br>";

$queryReqSeqId = date("YmdHis") . "01234567890";
$query_params = array(
    "req_seq_id" => $queryReqSeqId,
    "req_date" => $nowDate,
    "product_id"=> DemoConstants::DEMO_PRODUCT_ID,
    "huifu_id" => DemoConstants::DEMO_HUIFU_ID,
    "org_sys_id" => DemoConstants::DEMO_SYS_ID,
    "org_req_seq_id" => $reqSeqId,
    "org_req_date" => $nowDate,
);
# 调用钱包取现查询接口
$trans = new BsPayClient();
$trans->postRequest("ssproxy.walletEnchashmentQuery", $query_params);

if ($trans->isError()){
    //失败处理
    var_dump($trans->result);
} else {
    //成功处理
    var_dump($trans->result);
}
echo "<br>";
echo "<br>";
