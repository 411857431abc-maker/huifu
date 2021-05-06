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
    "huifu_id" => DemoConstants::DEMO_HUIFU_ID,
    "trans_amt" => "0.01",
);
# 调用钱包余额冻结接口
$trans = new BsPayClient();
$trans->postRequest("ssproxy.frzWalletBal", $trans_params);

if ($trans->isError()){
    //失败处理
    var_dump($trans->result);
} else {
    //成功处理
    var_dump($trans->result);
}
echo "<br>";
echo "<br>";


$unFrzReqSeqId = date("YmdHis") . "01234567890";
$trans_params = array(
    "req_seq_id" => $unFrzReqSeqId,
    "req_date" => $nowDate,
    "huifu_id" => DemoConstants::DEMO_HUIFU_ID,
    "trans_amt" => "0.01",
    "un_frz_infos" => array(
        array(
            "org_req_seq_id" => $reqSeqId,
            "org_req_date" => $nowDate,
            "org_sys_id" => DemoConstants::DEMO_SYS_ID,
        ),
    ),
);
# 调用钱包余额解冻接口
$trans = new BsPayClient();
$trans->postRequest("ssproxy.unFrzWalletBal", $trans_params);

if ($trans->isError()){
    //失败处理
    var_dump($trans->result);
} else {
    //成功处理
    var_dump($trans->result);
}
echo "<br>";
echo "<br>";



