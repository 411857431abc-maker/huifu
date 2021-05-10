<?php
namespace BsPayDemo;

use BsPaySdk\BsPayClient;
use BsPayDemo\constants\DemoConstants;

// 配置商户信息
require_once  dirname(__FILE__). "/config.php";

$nowStr = date("YmdHis");
$nowDate = date("Ymd");
$reqSeqId = $nowStr . "01234567890";

$payConfirm_params = array(
    "req_seq_id" => $reqSeqId,
    "req_date"=> $nowDate,
    "huifu_id" => DemoConstants::DEMO_HUIFU_ID,
    "sys_id" => DemoConstants::DEMO_SYS_ID,
    "mer_ord_id" => $nowDate . $reqSeqId,
    "org_req_seq_id" => "2021042214110401234567890",
    "org_req_date" => "20210422",
    "acct_split_bunch" => array(
        "acct_infos" => array(
            array(
                "huifu_id" => DemoConstants::DIV_HUIFU_ID,
                "div_amt" => "0.01",
            ),
        ),
    ),
);

$trans = new BsPayClient();

# 请求交易确认接口
$trans->postRequest("topat.payConfirm", $payConfirm_params);

if ($trans->isError()){
    //失败处理
    var_dump($trans->result);
} else {
    //成功处理
    var_dump($trans->result);
}

echo "<br>";
echo "<br>";


$query_params = array(
    "huifu_id"=> DemoConstants::DEMO_HUIFU_ID,
    "req_date"=> $nowDate,
    "sys_id"=> DemoConstants::DEMO_SYS_ID,
    "req_seq_id"=> $reqSeqId,
);
# 请求交易确认查询接口
$trans->postRequest("topqur.payConfirmQuery", $payConfirm_params);

if ($trans->isError()){
    //失败处理
    var_dump($trans->result);
} else {
    //成功处理
    var_dump($trans->result);
}

echo "<br>";
echo "<br>";


$refundReqSeqId = date("YmdHis") . "01234567890";
$refund_params = array(
    "req_seq_id" => $refundReqSeqId,
    "req_date"=> $nowDate,
    "huifu_id" => DemoConstants::DEMO_HUIFU_ID,
    "sys_id" => DemoConstants::DEMO_SYS_ID,
    "mer_ord_id" => $nowDate . $refundReqSeqId,
    "org_req_seq_id" => $reqSeqId,
    "org_req_date" => $nowDate,
    "acct_split_bunch" => array(
        "acct_infos" => array(
            array(
                "huifu_id" => DemoConstants::DIV_HUIFU_ID,
                "div_amt" => "0.01",
            ),
        ),
    ),
);
# 请求交易确认退款接口
$trans->postRequest("toprrc.payConfirmRefund", $payConfirm_params);

if ($trans->isError()){
    //失败处理
    var_dump($trans->result);
} else {
    //成功处理
    var_dump($trans->result);
}

echo "<br>";
echo "<br>";


$query_params = array(
    "huifu_id"=> DemoConstants::DEMO_HUIFU_ID,
    "trans_req_seq_id"=> "2021042214110401234567890",
    "trans_req_date"=> "20210422",
);
# 请求交易确认批量查询接口
$trans->postRequest("topqur.payConfirmListQuery", $payConfirm_params);

if ($trans->isError()){
    //失败处理
    var_dump($trans->result);
} else {
    //成功处理
    var_dump($trans->result);
}


