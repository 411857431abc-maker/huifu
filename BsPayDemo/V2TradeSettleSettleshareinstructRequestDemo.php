<?php

/**
 * 多方结算-发起 - 示例
 *
 * @author sdk-generator
 * @Description
 */
namespace BsPayDemo;

// 1. 资源及配置加载
require_once dirname(__FILE__) . "/loader.php";
require_once  dirname(__FILE__). "/../BsPaySdk/request/V2TradeSettleSettleshareinstructRequest.php";

use BsPaySdk\core\BsPayClient;
use BsPaySdk\request\V2TradeSettleSettleshareinstructRequest;

// 2.组装请求参数
$request = new V2TradeSettleSettleshareinstructRequest();
// 请求日期
$request->setReqDate(date("Ymd"));
// 请求流水号
$request->setReqSeqId(date("YmdHis").mt_rand());
// 操作者客户Id
$request->setOperatorHuifuId("6666000108180147");
// 出金方客户Id
$request->setHuifuId("6666000000884810");
// 可分配金额
$request->setTransAmt("23.21");
// 分账信息
$request->setShareAccounts(getShareAccounts());

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

function getShareAccounts() {
    $dto = array();
    // 客户号
    $dto["huifu_id"] = "6666000108180147";
    // 分配金额
    $dto["share_amt"] = "23.21";
    // 账户号
    $dto["acct_id"] = "C02622450";

    $dtoList = array();
    array_push($dtoList, $dto);
    return $dtoList;
}


