<?php
namespace BsPayDemo;

 use BsPaySdk\Trans;

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

$query_params = array(
    // 请求流水号，需保证当天商户下唯一，推荐采用日期时间+几位流水号的形式
    dataMap.put("req_seq_id", nowStr + "01234567890");
    // 请求日期，请求接口的日期，因服务器时间可能有差异，允许前后1天
    dataMap.put("req_date", new SimpleDateFormat("yyyyMMdd").format(cl.getTime()));
    // 系统号，由汇付分配
    dataMap.put("sys_id", DemoConstants.DEMO_SYS_ID);
    // 商户订单号，需保证商户下唯一，推荐采用日期时间+几位流水号的形式
    dataMap.put("mer_ord_id", nowStr + "1234567890");
    // 分配商户号
    dataMap.put("huifu_id", DemoConstants.DEMO_HUIFU_ID);
    // 交易类型
    // 微信公众号-T_JSAPI 小程序-T_MINIAPP 支付宝JS-A_JSAPI 支付宝正扫-A_NATIVE 银联正扫-U_NATIVE 银联JS-U_JSAPI
    dataMap.put("trade_type", "A_NATIVE");
    // 交易金额
    dataMap.put("trans_amt", "0.02");
    // 商品描述
    dataMap.put("goods_desc", "测试商品");
    // 设备信息
    JSONObject terminalDeviceInfo = new JSONObject();
    terminalDeviceInfo.put("device_type", "4");
    terminalDeviceInfo.put("device_ip", "139.207.19.246");
    dataMap.put("terminal_device_info", terminalDeviceInfo);
    // 风控信息
    Map<String, String> riskMngInfo = new HashMap<>();
    riskMngInfo.put("subTradeType", "4300");
    Map<String, Object> riskCheckInfo = new HashMap<>();
    riskCheckInfo.put("riskMngInfo", riskMngInfo);
    riskCheckInfo.put("ipAddr", "139.207.19.246");
    // 注意，风控信息为JSON字符串
    // dataMap.put("risk_check_info", JSON.toJSONString(riskCheckInfo));
    dataMap.put("risk_check_info", riskCheckInfo);
    // 异步通知地址
    dataMap.put("notify_url", "virgo://http://www.vclinker.com");
    // 微信用户子标识 微信JS支付此参数必传
    dataMap.put("sub_openid", "");
    // 买家的支付宝唯一用户号 支付宝JS支付，buyer_id必送
    dataMap.put("buyer_id", "");
    // 用户在云闪付APP上的标识号，用来提供给收款方， 并在收款方发起交易时回传给付款方。（银联JS支付必填）
    // 通过获取银联用户标识获取
    dataMap.put("user_id", "");
    // 持卡人确认付款时的IP地址，用于防钓鱼。（银联JS支付必填）
    dataMap.put("client_ip", "");
    // 交易有效期
    cl.add(Calendar.MINUTE, 2);
    dataMap.put("time_expire", sdf.format(cl.getTime()));
    // 指定支付方式 是否禁止用户使用信用卡支付。默认不禁用，若禁止请填1
    dataMap.put("limit_pay", "1");
    // 延时标志 1为延迟 0为不延迟
    dataMap.put("is_delay_acct", "0");
    // 传入分帐遇到优惠的处理规则 1-按比例分 2-按顺序保障 3-只给交易商户
    dataMap.put("term_div_coupon_type", "3");
    // 分账串
    JSONObject acctSplitBunch = new JSONObject();
    JSONArray acctInfos = new JSONArray();
    // 分账方1
    JSONObject acctInfo = new JSONObject();
    acctInfo.put("huifu_id", DemoConstants.DEMO_HUIFU_ID);
    acctInfo.put("div_amt", "0.01");
    acctInfos.add(acctInfo);
    // 分账方2
    acctInfo = new JSONObject();
    acctInfo.put("huifu_id", DemoConstants.DIV_HUIFU_ID);
    acctInfo.put("div_amt", "0.01");
    acctInfos.add(acctInfo);
    acctSplitBunch.put("acct_infos", acctInfos);
    dataMap.put("acct_split_bunch", acctSplitBunch);
    // 商户私有域
    dataMap.put("mer_priv", "");
    // 微信扩展参数集合
    dataMap.put("wx_data", "");
    // 支付宝扩展参数集合
    dataMap.put("alipay_data", "");
    // 银联扩展参数集合
    dataMap.put("unionpay_data", "");
    // 手续费类型 01:标准费率线上,02:标准费率线下,03:非盈利费率,04:缴费费率,05:保险费率,06:行业活动费率,07:校园餐饮费率,08:K12中小幼费率
    // 不送时取业务入驻配置的默认费率
    dataMap.put("pay_scene", "02");
    // 分期贴息类型，1:商户贴息，默认商户不贴息。注意：当此处填1时，花呗商户承担比例hb_fq_seller_percent只能填0
    dataMap.put("fq_mer_discount_flag", 0);
    // 交易备注
    dataMap.put("remark", "");
    
);

 
 $query_params = array(
     "huifu_id"=> "6666000106120347",
     "req_date"=> "20210422",
     "sys_id"=> "6666000018269234",
     "out_trans_id"=> "4200001025202104226317337994"
 );
 
 $trans = new Trans();
 # 请求交易查询接口
 $trans->request("topqur.transQuery", $query_params);
 # 如有多套配置，可指定使用哪套配置，指定merchanKey为初始化时设置的。
 #$trans->request($query_params, "topqur.transQuery", "merchantKey2");
 # 对进件结果进行处理
 if ($trans->isError()){
     //失败处理
     var_dump($trans->result);
 } else {
     //成功处理
     var_dump($trans->result);
 }
 ?>