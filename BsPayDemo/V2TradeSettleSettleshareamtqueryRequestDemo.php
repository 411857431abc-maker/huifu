<?php

/**
 * 多方结算-资金查询 - 示例
 *
 * @author sdk-generator
 * @Description
 */
namespace BsPayDemo;

// 1. 资源及配置加载
require_once dirname(__FILE__) . "/loader.php";
require_once  dirname(__FILE__). "/../BsPaySdk/request/V2TradeSettleSettleshareamtqueryRequest.php";

use BsPaySdk\core\BsPayClient;
use BsPaySdk\request\V2TradeSettleSettleshareamtqueryRequest;

// 2.组装请求参数
$request = new V2TradeSettleSettleshareamtqueryRequest();
// 请求日期
$request->setReqDate(date("Ymd"));
// 请求流水号
$request->setReqSeqId(date("YmdHis").mt_rand());
// 操作者客户Id
$request->setOperatorHuifuId("6666000108180147");
// 被查询者客户Id
$request->setHuifuId("6666000000884810");

// 设置非必填字段
$extendInfoMap = getExtendInfos();
$request->setExtendInfo($extendInfoMap);

// 3. 发起API调用
$client = new BsPayClient();
$result = $client->postRequest($request);
if (!$result || $result->isError()) {  //失败处理
    var_dump($result -> getErrorInfo());
} else {    //成功处理
    var_dump($result);
}

/**
 * 非必填字段
 *
 */
function getExtendInfos() {
    // 设置非必填字段
    $extendInfoMap = array();
    // 账户号
    $extendInfoMap["acct_id"]= "B00025871";
    return $extendInfoMap;
}


