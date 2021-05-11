<?php
namespace BsPayDemo;

use BsPaySdk\BsPayClient;
 use BsPayDemo\constants\DemoConstants;

 // 配置商户信息
require_once  dirname(__FILE__). "/config.php";

$nowStr = date("YmdHis");
$nowDate = date("Ymd");
$reqSeqId = $nowStr . "01234567890";
// $merOrdId = $nowStr . "1234567890";
$merOrdId = $reqSeqId;
// $timeExpire = date("YmdHis",strtotime(date("YmdHis") . " +2 minutes"));

$trans_params = array(
    // 请求流水号，需保证当天商户下唯一，推荐采用日期时间+几位流水号的形式
    "req_seq_id" => $reqSeqId,
    // 请求日期，请求接口的日期，因服务器时间可能有差异，允许前后1天
    "req_date"=> date("Ymd"),
    // 系统号，由汇付分配
    "sys_id"=>DemoConstants::DEMO_SYS_ID,
    // 商户订单号，需保证商户下唯一，推荐采用日期时间+几位流水号的形式，可与req_seq_id相同
    "mer_ord_id"=>$merOrdId,
    // 分配商户号
    "huifu_id"=>DemoConstants::DEMO_HUIFU_ID,
    // 取现卡序列号
    "token_no" => DemoConstants::TOKEN_NO,
    // 取现金额.单位:元
    "cash_amt"=>"0.01",
    // 入账类型，T0：当日到账；T1：T1次工作日到账；D1：次自然日到账；
    "into_acct_date_type"=>"T1",
    // 异步通知地址
    "notify_url" => "virgo://http://www.vclinker.com",
    // 风控信息
    // 注意，风控信息为JSON字符串
    "risk_check_info"=> json_encode(array(
        "riskMngInfo"=> array(
            "subTradeType"=>"4300"
        ),
        "ipAddr"=>"139.207.19.246"
    )),
    
);

$trans = new BsPayClient();

# 请求取现交易接口
$trans->postRequest("toppas.enchashment", $trans_params);
# 如有多套配置，可指定使用哪套配置，指定merchanKey为初始化时设置的。
#$trans->postRequest("toppas.enchashment", $trans_params, "merchantKey2");

if ($trans->isError()){
    //失败处理
    var_dump($trans->result);
} else {
    //成功处理
    var_dump($trans->result);
}

 $query_params = array(
     "huifu_id"=> DemoConstants::DEMO_HUIFU_ID,
     "req_date"=> $nowDate,
     "sys_id"=> DemoConstants::DEMO_SYS_ID,
     "req_seq_id"=> $reqSeqId,
     "trans_req_date"=> $nowDate,
	 // 原交易的商户订单号，trans_mer_ord_id和hf_seq_id二选一
     "trans_mer_ord_id"=> "2021042915052901234567890",
	 // 原交易的汇付流水号，trans_mer_ord_id和hf_seq_id二选一
	 #"hf_seq_id" => $reqSeqId
 );
 

 # 请求取现查询接口
 $trans->postRequest("topqur.cashQuery", $query_params);
 # 如有多套配置，可指定使用哪套配置，指定merchanKey为初始化时设置的。
 #$trans->postRequest("topqur.cashQuery", $query_params, "merchantKey2");
 # 对取现查询结果进行处理
 if ($trans->isError()){
     //失败处理
     var_dump($trans->result);
 } else {
     //成功处理
     var_dump($trans->result);
 }
 ?>