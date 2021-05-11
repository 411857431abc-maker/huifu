<?php

namespace BsPayDemo;

use BsPaySdk\BsPayClient;
use BsPayDemo\constants\DemoConstants;

// 配置商户信息
require_once  dirname(__FILE__). "/config.php";

$nowStr = date("YmdHis");
$nowDate = date("Ymd");
$reqSeqId = $nowStr . "01234567890";

$trans_params = array(
    "req_seq_id" => $reqSeqId,
    "req_date"=> $nowDate,
    "huifu_id" => DemoConstants::DEMO_HUIFU_ID,
    "out_huifu_id" => DemoConstants::DEMO_HUIFU_ID,
    "ord_amt" => "0.01",
    "device_info" => array(
        "device_type" => "1",
        "device_ip" => "139.207.19.246",
    ),
    "risk_check_info" => array(
        "transferType" => "余额支付",
    ),
    "acct_payment_split_bunch" => array(
        "acct_infos" => array(
            array(
                "in_huifu_id" => DemoConstants::DEMO_HUIFU_ID,
                "div_amt" => "0.01",
            ),
        ),
    ),
);
# 调用余额支付接口
$trans = new BsPayClient();
$trans->postRequest("topat.acctPayment", $trans_params);

if ($trans->isError()){
    //失败处理
    var_dump($trans->result);
} else {
    //成功处理
    var_dump($trans->result);
}
echo "<br>";
echo "<br>";

$transQuery_params = array(
    "org_req_seq_id" => $reqSeqId,
    "org_req_date" => $nowDate,
    "huifu_id" => DemoConstants::DEMO_HUIFU_ID,
);

# 调用余额支付查询接口
$trans->postRequest("topat.acctPaymentQuery", $transQuery_params);

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
    "org_req_seq_id" => $reqSeqId,
    "org_req_date" => $nowDate,
    "ord_amt" => "0.01",
    "risk_check_info" => array(
        "transferType" => "余额支付退款",
    ),
    "acct_payment_split_bunch" => array(
        "acct_infos" => array(
            array(
                "in_huifu_id" => DemoConstants::DEMO_HUIFU_ID,
                "div_amt" => "0.01",
            ),
        ),
    ),
);


# 调用余额支付退款接口
$trans = new BsPayClient();
$trans->postRequest("topat.acctPaymentRefund", $refund_params);

if ($trans->isError()){
    //失败处理
    var_dump($trans->result);
} else {
    //成功处理
    var_dump($trans->result);
}
echo "<br>";
echo "<br>";

$refundQuery_params = array(
    "req_seq_id" => $refundReqSeqId,
    "req_date" => $nowDate,
    "huifu_id" => DemoConstants::DEMO_HUIFU_ID,
);

# 调用余额支付退款查询接口
$trans->postRequest("topat.acctPaymentRefundQuery", $refundQuery_params);

if ($trans->isError()){
    //失败处理
    var_dump($trans->result);
} else {
    //成功处理
    var_dump($trans->result);
}
echo "<br>";
echo "<br>";