<?php
namespace BsPayDemo;

use BsPaySdk\BsPayClient;
 use BsPayDemo\constants\DemoConstants;
 
 /**
  * 聚合反扫调用实例
  */

 # 以下配置为开发联调时覆盖SDK的配置项，需在引入SDK的init.php之前配置以覆盖SDK初始配置
 # 设置是否调试模式，不配置默认关闭：false
define("DEBUG", true);
 
 # 设置调试日志路径，不配置默认为SDK同级的log目录下
define("LOG", dirname(__FILE__)."/log");
 
 # 设置生产模式，不配置默认生产模式：true
define("PROD_MODE", true);

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
// $merOrdId = $nowStr . "1234567890";
$merOrdId = $reqSeqId;
$timeExpire = date("YmdHis",strtotime(date("YmdHis") . " +2 minutes"));

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
    // 渠道号，若需使用自有渠道请联系业务对接人
    "bank_channel_no" => "",
    // 交易金额
    "trans_amt"=>"0.02",
    // 商品描述
    "goods_desc"=>"测试商品",
    "auth_code" => "283394822366188285",
    // 设备信息
    "terminal_device_info"=>array (
            "device_type"=>"4",
            "device_ip"=>"139.207.19.246"
     ),
    // 风控信息
    // 注意，风控信息为JSON字符串
    "risk_check_info" => json_encode(array(
        "riskMngInfo" => array(
            "subTradeType" => "4300"
        ),
        "ipAddr"=>"139.207.19.246"
    )),
    // 异步通知地址
    "notify_url"=>"virgo://http://www.vclinker.com",

    // 交易有效期
    "time_expire"=>$timeExpire,
    // 指定支付方式 是否禁止用户使用信用卡支付。默认不禁用，若禁止请填1
    "limit_pay"=>"1",
    // 延时标志 1为延迟 0为不延迟
    "is_delay_acct"=>"0",
    // 传入分帐遇到优惠的处理规则 1-按比例分 2-按顺序保障 3-只给交易商户
    "term_div_coupon_type"=>"3",
    // 分账串
    "acct_split_bunch"=>array(
        "acct_infos" => array(
            // 分账方1
            array(
                "huifu_id"=>DemoConstants::DEMO_HUIFU_ID,
                "div_amt"=>"0.01"
            ),
            // 分账方21
            array(
                "huifu_id"=>DemoConstants::DIV_HUIFU_ID,
                "div_amt"=>"0.01"
            )
        )
    ),
    // 商户私有域
    "mer_priv"=>"",
    // 微信扩展参数集合
    "wx_data"=>"",
    // 支付宝扩展参数集合
    "alipay_data"=>"",
    // 银联扩展参数集合
    "unionpay_data"=>"",
    // 手续费类型 01:标准费率线上,02:标准费率线下,03:非盈利费率,04:缴费费率,05:保险费率,06:行业活动费率,07:校园餐饮费率,08:K12中小幼费率
    // 不送时取业务入驻配置的默认费率
    "pay_scene"=>"02",
);

$trans = new BsPayClient();

# 请求聚合反扫接口
$trans->postRequest("top.trans.authCodePay", $trans_params);
# 如有多套配置，可指定使用哪套配置，指定merchanKey为初始化时设置的。
#$trans->postRequest($query_params, "top.trans.authCodePay", "merchantKey2");

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
     "req_seq_id"=> $reqSeqId
 );
 

 # 请求交易查询接口
 $trans->postRequest("topqur.transQuery", $query_params);
 # 如有多套配置，可指定使用哪套配置，指定merchanKey为初始化时设置的。
 #$trans->postRequest($query_params, "topqur.transQuery", "merchantKey2");
 # 对进件结果进行处理
 if ($trans->isError()){
     //失败处理
     var_dump($trans->result);
 } else {
     //成功处理
     var_dump($trans->result);
 }
 ?>