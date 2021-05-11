<?php
namespace BsPayDemo;

use BsPaySdk\BsPayClient;
use BsPayDemo\constants\DemoConstants;

// 配置商户信息
require_once dirname(__FILE__) . "/config.php";

$nowStr = date("YmdHis");
$nowDate = date("Ymd");
$reqSeqId = $nowStr . "01234567890";
// $merOrdId = $nowStr . "1234567890";
// $merOrdId = $reqSeqId;

$req_params = array(
    // 请求流水号，需保证当天商户下唯一，推荐采用日期时间+几位流水号的形式
    "req_seq_id" => $reqSeqId,
    // 请求日期，请求接口的日期，因服务器时间可能有差异，允许前后1天
    "req_date" => $nowDate,
    // 产品号
    "product_id" => DemoConstants::DEMO_PRODUCT_ID,
    // 系统号，由汇付分配
    "sys_id" => DemoConstants::DEMO_SYS_ID,
    // 分配商户号
    "huifu_id" => DemoConstants::DEMO_HUIFU_ID
);

$req = new BsPayClient();

# 请求交易退货接口
$req->postRequest("ssproxy.queryFqMerFeeDetail", $req_params);
# 如有多套配置，可指定使用哪套配置，指定merchanKey为初始化时设置的。
# $req->postRequest("ssproxy.queryFqMerFeeDetail", $req_params, "merchantKey2");

if ($req->isError()) {
    // 失败处理
    var_dump($req->result);
} else {
    // 成功处理
    var_dump($req->result);
}

?>