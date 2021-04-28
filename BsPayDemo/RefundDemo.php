<?php
namespace BsPayDemo;

use BsPaySdk\BsPayClient;
use BsPayDemo\constants\DemoConstants;

# 以下配置为开发联调时覆盖SDK的配置项，需在引入SDK的init.php之前配置以覆盖SDK初始配置
# 设置是否调试模式，不配置默认关闭：false
define("DEBUG", true);

# 设置调试日志路径，不配置默认为SDK同级的log目录下
define("LOG", dirname(__FILE__) . "/log");

# 设置生产模式，不配置默认生产模式：true
define("PROD_MODE", true);

// 加载基础 adapay 基础类
// SDK 初始化文件加载
require_once dirname(__FILE__) . "/../BsPaySdk/init.php";
// 配置商户信息
require_once dirname(__FILE__) . "/config.php";
// 配置商户信息
require_once dirname(__FILE__) . "/constants/DemoConstants.php";

$nowStr = date("YmdHis");
$nowDate = date("Ymd");
$reqSeqId = $nowStr . "01234567890";
// $merOrdId = $nowStr . "1234567890";
$merOrdId = $reqSeqId;

$trans_params = array(
    // 请求流水号，需保证当天商户下唯一，推荐采用日期时间+几位流水号的形式
    "req_seq_id" => $reqSeqId,
    // 请求日期，请求接口的日期，因服务器时间可能有差异，允许前后1天
    "req_date" => $nowDate,
    // 商户订单号，需保证商户下唯一，推荐采用日期时间+几位流水号的形式，可与req_seq_id相同
    "mer_ord_id" => $merOrdId,
    // 系统号，由汇付分配
    "sys_id" => DemoConstants::DEMO_SYS_ID,
    // 分配商户号
    "huifu_id" => DemoConstants::DEMO_HUIFU_ID,
    // 分账串，原路径退回无需上送
    /*
    "acct_split_bunch" => array(
        "acct_infos" => array(
            // 分账方1
            array(
                "huifu_id" => DemoConstants::DEMO_HUIFU_ID,
                "div_amt" => "0.01"
            ),
            // 分账方21
            array(
                "huifu_id" => DemoConstants::DIV_HUIFU_ID,
                "div_amt" => "0.01"
            )
        )
    ),*/
    // 以下指定原交易的唯一标识，org_req_seq_id、hf_seq_id、party_order_id中3选1
    // 原交易请求流水号
    "org_req_seq_id" => "2021042715001701234567890",
    // 原交易请求日期，指原交易的请求日期，当根据原交易流水号退货时必送
    "org_req_date" => "20210427",
    // 退款金额
    "ord_amt" => "0.02",
    // 设备信息
    "terminal_device_info" => array(
        "device_type" => "4",
        "device_ip" => "139.207.19.246"
    ),
    // 备注
    "mark" => "交易退货",
    // 扩展域
    "mer_priv" => "扩展域",
    // 风控信息
    // 注意，风控信息为JSON字符串
    "risk_check_info" => array(
        "riskMngInfo" => array(
            "subTradeType" => "4300"
        ),
        "ipAddr" => "139.207.19.246"
    ),
    // 异步通知地址
    "notify_url" => "virgo://http://www.vclinker.com"
);

$trans = new BsPayClient();

# 请求交易退货接口
$trans->postRequest("toprrc.refund", $trans_params);
# 如有多套配置，可指定使用哪套配置，指定merchanKey为初始化时设置的。
# $trans->postRequest($query_params, "toprrc.refund", "merchantKey2");

if ($trans->isError()) {
    // 失败处理
    var_dump($trans->result);
} else {
    // 成功处理
    var_dump($trans->result);
}

$query_params = array(
    "huifu_id" => DemoConstants::DEMO_HUIFU_ID,
    "req_date" => $nowDate,
    "sys_id" => DemoConstants::DEMO_SYS_ID,
    // 以下上送原退款的唯一标识、mer_ord_id、req_seq_id、hf_seq_id、out_ord_id可4选1
    // 原退款请求流水号
    "req_seq_id" => $reqSeqId
);

# 请求交易查询接口
$trans->postRequest("topqur.refundQuery", $query_params);
# 如有多套配置，可指定使用哪套配置，指定merchanKey为初始化时设置的。
# $trans->postRequest($query_params, "topqur.refundQuery", "merchantKey2");
# 对进件结果进行处理
if ($trans->isError()) {
    // 失败处理
    var_dump($trans->result);
} else {
    // 成功处理
    var_dump($trans->result);
}
?>