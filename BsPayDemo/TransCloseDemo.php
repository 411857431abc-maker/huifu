<?php
namespace BsPayDemo;

use BsPaySdk\BsPayClient;
use BsPayDemo\constants\DemoConstants;
 
// 配置商户信息
require_once  dirname(__FILE__). "/config.php";

 /**
  * 聚合扫码关单调用实例
  */
$trans = new BsPayClient();
$orgReqDate = "20210508";
$orgReqSeqId = "202105081004031234567890";
$closeParams = array (
    // 请求流水号，需保证当天商户下唯一，推荐采用日期时间+几位流水号的形式
    "req_seq_id" => date("YmdHis") . "1234567890c",
    // 请求日期，请求接口的日期，因服务器时间可能有差异，允许前后1天
    "req_date" => date("Ymd"),
    // 系统编号，由汇付分配
    "sys_id" =>DemoConstants::DEMO_SYS_ID,
    // 分配商户号
    "huifu_id" =>DemoConstants::DEMO_HUIFU_ID,
    // 原交易请求流水号
    "org_req_seq_id" =>$orgReqSeqId,
    // 原交易请求日期
    "org_req_date"=> $orgReqDate
);

# 请求关单接口
$trans->postRequest("toprrc.close", $closeParams);
# 如有多套配置，可指定使用哪套配置，指定merchanKey为初始化时设置的。
#$trans->postRequest("toprrc.close", $closeParams, "merchantKey2");


if ($trans->isError()){
    //失败处理
    var_dump($trans->result);
} else {
    //成功处理
    var_dump($trans->result);
}

$query_params = array(
    "huifu_id"=> DemoConstants::DEMO_HUIFU_ID,
    "req_date"=> $orgReqDate,
    "sys_id"=> DemoConstants::DEMO_SYS_ID,
    "req_seq_id"=> $orgReqSeqId
);


# 请求交易查询接口
$trans->postRequest("topqur.transQuery", $query_params);
# 如有多套配置，可指定使用哪套配置，指定merchanKey为初始化时设置的。
#$trans->postRequest("topqur.transQuery", $query_params, "merchantKey2");
# 对进件结果进行处理
if ($trans->isError()){
    //失败处理
    var_dump($trans->result);
} else {
    //成功处理
    var_dump($trans->result);
}
 ?>