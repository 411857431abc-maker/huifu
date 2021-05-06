<?php
namespace BsPayDemo;

use BsPaySdk\BsPayClient;
use BsPayDemo\constants\DemoConstants;

// 配置商户信息
require_once  dirname(__FILE__). "/config.php";

$nowStr = date("YmdHis");
$nowDate = date("Ymd");
$reqSeqId = $nowStr . "01234567890";

$timeExpire = date("YmdHis",strtotime(date("YmdHis") . " +2 minutes"));

$trans_params = array(
    "req_seq_id" => $reqSeqId,
    "req_date"=> $nowDate,
    "huifu_id" => DemoConstants::DEMO_HUIFU_ID,
    "card_no" => "6226**********0124",
    "trans_amt" => "200.00",
    "mer_notice_url" => "virgo://http://www.xxx.com/getResp",
    "business_url" => "virgo://http://www.xxx.com/getResp",
    "time_expire" => $timeExpire,
    "extend_pay" => array(
        "pyer_trx_trm_tp" => "02",
    ),
    "device_info" => array(
        "trx_device_type" => "01",
        "trx_device_ip" => "139.207.19.246",

    ),
    "risk_check_info" => array(
        "riskMngInfo" => array(
            "subTradeType" => "4300",
        ),
        "ipAddr" => "139.207.19.246",
    ),
    "acct_split_bunch" => array(
        "acct_infos" => array(
            array(
                "huifu_id" => DemoConstants::DEMO_HUIFU_ID,
                "div_amt" => "200.00",
            ),
        ),
    ),
);

$trans = new BsPayClient();

# 请求手机网页支付接口
$trans->postRequest("top-online-ser.wapPay", $trans_params);

if ($trans->isError()){
    //失败处理
    var_dump($trans->result);
} else {
    //成功处理
    var_dump($trans->result);
}

echo "<br>";
echo "<br>";

# 线上交易查询
$query_params = array(
    "huifu_id"=> DemoConstants::DEMO_HUIFU_ID,
    "req_date"=> $nowDate,
    "product_id"=> DemoConstants::DEMO_PRODUCT_ID,
    "req_seq_id"=> $reqSeqId
);

# 请求线上交易查询接口
$trans->postRequest("top-online-ser.transQuery", $query_params);

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
    "mer_ord_id" => $refundReqSeqId,
    "sys_id" => DemoConstants::DEMO_SYS_ID,
    "org_req_seq_id" => $reqSeqId,
    "org_req_date" => $nowDate,
    "ord_amt" => "200.00",
    "notify_url" => "virgo://http://www.xxx.com/getResp",

    "device_info" => array(
        "trx_device_type" => "04",
        "trx_device_ip" => "139.207.19.246",

    ),
    "risk_check_info" => array(
        "riskMngInfo" => array(
            "subTradeType" => "4300",
        ),
        "ipAddr" => "139.207.19.246",
    ),
);
# 请求线上退款接口
$trans->postRequest("top-online-ser.refund", $refund_params);

if ($trans->isError()){
    //失败处理
    var_dump($trans->result);
} else {
    //成功处理
    var_dump($trans->result);
}

echo "<br>";
echo "<br>";


$refundQuery_params = array (
    "huifu_id"=> DemoConstants::DEMO_HUIFU_ID,
    "req_date"=> $nowDate,
    "sys_id"=> DemoConstants::DEMO_SYS_ID,
    "req_seq_id"=> $refundReqSeqId
);
# 请求线上退款查询接口
$trans->postRequest("top-online-ser.refundQuery", $refundQuery_params);

if ($trans->isError()){
    //失败处理
    var_dump($trans->result);
} else {
    //成功处理
    var_dump($trans->result);
}
