<?php
namespace BsPayDemo;

use BsPaySdk\BsPayClient;
 use BsPayDemo\constants\DemoConstants;

  // 配置商户信息
require_once  dirname(__FILE__). "/config.php";

$nowStr = date("YmdHis");
$nowDate = date("Ymd");
$reqSeqId = $nowStr . "01234567890";
$reqSeqId_sign = $nowStr . "01234567891";
$reqSeqId_payment = $nowStr . "01234567892";
$reqSeqId_payment_confirm = $nowStr . "01234567893";
$reqSeqId_refund = $nowStr . "01234567894";
$reqSeqId_payment_confirm_delay = $nowStr . "01234567895";
// $merOrdId = $nowStr . "1234567890";
$merOrdId = $reqSeqId;
$merOrdId_payment = $reqSeqId_payment;
$merOrdId_payment_confirm = $reqSeqId_payment_confirm;
$merOrdId_refund = $reqSeqId_refund;
$merOrdId_payment_confirm_delay = $reqSeqId_payment_confirm_delay;
$timeExpire = date("YmdHis",strtotime(date("YmdHis") . " +2 minutes"));

$sign_params = array(
    // 请求流水号，需保证当天商户下唯一，推荐采用日期时间+几位流水号的形式
    "req_seq_id" => $reqSeqId_sign,
    // 请求日期，请求接口的日期，因服务器时间可能有差异，允许前后1天
    "req_date"=> date("Ymd"),
    // 系统号，由汇付分配
    "sys_id"=>DemoConstants::DEMO_SYS_ID,
    // 分配商户号
    "huifu_id"=>DemoConstants::DEMO_HUIFU_ID,
	
    // 银行编号，具体参见参数附录--银行卡分期支持银行
    "bank_no" => "03050000",
    // 持卡人姓名
    "card_name"=>"张三",
    // 银行卡号,注需要替换为真实卡号明文
    "card_no"=>"622**********0124",
	// 银行卡手机号，注需要替换为真实卡号明文
    "card_mobile" => "186****4498",
	// 证件类型  01：身份证
    "id_type"=>"01",
	// 证件号
    "id_no"=>"230*************13",
	// CVV2,银行卡背面后三位
    "cvv2"=>"123",
	// 有效期 月年格式（4位，示例：0535）
    "valid_date"=>"0635",
	 // 卡类型 D:借记卡 C:信用卡 P:存折 Y:预付费卡 V:虚拟账户 Z:借贷合一卡
    "card_type"=>"D",
	// 银行账户类型 E：对公，P：对私
    "card_acct_type"=>"P",
	// 交易金额 单位元，需保留小数点后两位
    "trans_amt"=>"100.00",
    // 订单有效期即订单失效时间
    "time_expire"=>$timeExpire,
    // 设备信息
    "terminal_device_info"=>array (
			// 设备类型 1:手机2:平板3:手表4:PC
            "device_type"=>"4",
			// 交易设备IP(公网IP,目前暂传IPv4格式)
            "device_ip"=>"139.207.19.246"
     ),
    // 异步通知地址
    "notify_url"=>"virgo://http://www.vclinker.com",
	// 页面跳转地址(支付成功后，前端跳转地址)
    "business_url"=>"http://www.baidu.com",
    // 请求类型 0:pc 1:安卓 2：ios
    "request_type"=>"0",
    // 业务地址 6位地区编码
    "place_id"=>"200000"
);

$trans = new BsPayClient();

# 请求银行卡分期签约接口
$trans->postRequest("top.bccredit.sign", $sign_params);
# 如有多套配置，可指定使用哪套配置，指定merchanKey为初始化时设置的。
#$trans->postRequest("top.bccredit.sign", $sign_params, "merchantKey2");

if ($trans->isError()){
    //失败处理
    var_dump($trans->result);
} else {
    //成功处理
    var_dump($trans->result);
}





$payment_params = array(
    // 请求流水号，需保证当天商户下唯一，推荐采用日期时间+几位流水号的形式
    "req_seq_id" => $reqSeqId_payment,
    // 请求日期，请求接口的日期，因服务器时间可能有差异，允许前后1天
    "req_date"=> date("Ymd"),
    // 系统号，由汇付分配
    "sys_id"=>DemoConstants::DEMO_SYS_ID,
    // 商户订单号，需保证商户下唯一，推荐采用日期时间+几位流水号的形式，可与req_seq_id相同
    "mer_ord_id"=>$merOrdId_payment,
    // 分配商户号
    "huifu_id"=>DemoConstants::DEMO_HUIFU_ID,
	
    // 银行编号，具体参见参数附录--银行卡分期支持银行
    "bank_no" => "03050000",
    // 持卡人姓名
    "card_name"=>"张三",
    // 银行卡号,注需要替换为真实卡号明文
    "card_no"=>"622**********0124",
	// 银行卡手机号，注需要替换为真实卡号明文
    "card_mobile" => "186****4498",
	// 证件类型  01：身份证
    "id_type"=>"01",
	// 证件号
    "id_no"=>"230*************13",
	// CVV2,银行卡背面后三位
    "cvv2"=>"123",
	// 有效期 月年格式（4位，示例：0535）
    "valid_date"=>"0635",
	 // 卡类型 D:借记卡 C:信用卡 P:存折 Y:预付费卡 V:虚拟账户 Z:借贷合一卡
    "card_type"=>"D",
	// 银行账户类型 E：对公，P：对私
    "card_acct_type"=>"P",
	// 交易金额 单位元，需保留小数点后两位
    "trans_amt"=>"100.00",
	 // 手续费收取方式 1-实收 2-后收
    "fee_rec_type"=>"2",
    // 订单有效期即订单失效时间
    "time_expire"=>$timeExpire,
	
	// 网联扩展字段 json
	"extend_pay"=> array(
		// 付款终端类型 01：电脑02：手机03：平板设备04：可穿戴设备05：数字电视06：条码支付受理终端99：其他
		"pyer_trx_trm_tp"=>"99",
		// 收款方账户编号 网联银联支付使用
		"pyee_acct_id"=>"6214***************6688",
		// 收款方账户名称
		"pyee_nm"=>"李四",
		// 收款方账户类型 （见数据字典的收款方账户类型, 默认值：04 单位支付账户）
		"pyee_acct_tp"=>"04",
		// 二级商户类型： 01：法人02：其他组织03：个体工商户04：自然人
		"mer_type"=>"03",
		// 二级商户证件类型：00：身份证01：护照02：军官证03：军官证04：回乡证05：户口簿06：警官证07：临时身份证08：台胞证09：港澳通行证10：企业营业执照11：法人代表证12：外国人永久居留证，即绿卡13：其他
		"mer_id_type"=>"00",
		// 二级商户证件编码
		"mer_id_no"=>"310*************86",
		// 二级商户行业类别 参照银联MCC编码
		"mer_cat_code"=>"8541",
		// 商品简称
		"goods_short_name"=>"****",
	),
	
    // 设备信息
    "terminal_device_info"=>array (
			// 设备类型 1:手机2:平板3:手表4:PC
            "device_type"=>"4",
			// 交易设备IP(公网IP,目前暂传IPv4格式)
            "device_ip"=>"139.207.19.246"
     ),
   
    // 风控信息
    // 注意，风控信息为JSON字符串
    "risk_check_info"=> json_encode(array(
        "riskMngInfo"=> array(
            "subTradeType"=>"4300"
        ),
        "ipAddr"=>"139.207.19.246"
    )),
    // 异步通知地址
    "notify_url"=>"virgo://http://www.vclinker.com",

    // 分期期数
    "instalments_num"=> "3",
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
    )
);


# 请求银行卡分期支付请求接口
$trans->postRequest("top.bccredit.paymentApply", $payment_params);
# 如有多套配置，可指定使用哪套配置，指定merchanKey为初始化时设置的。
#$trans->postRequest("top.bccredit.paymentApply", $payment_params, , "merchantKey2");

if ($trans->isError()){
    //失败处理
    var_dump($trans->result);
} else {
    //成功处理
    var_dump($trans->result);
}





 $payment_query_params = array(
     "huifu_id"=> DemoConstants::DEMO_HUIFU_ID,
     "req_date"=> $nowDate,
     "sys_id"=> DemoConstants::DEMO_SYS_ID,
	 // 以下指定原交易的唯一标识，支持4选1，可根据req_seq_id、out_trans_id、out_ord_id、hf_seq_id其中之一定位原交易
     "req_seq_id"=> $reqSeqId_payment
 );
 

 # 请求银行卡分期支付查询接口
 $trans->postRequest("topqur.bcCreditPayQuery", $payment_query_params);
 # 如有多套配置，可指定使用哪套配置，指定merchanKey为初始化时设置的。
 #$trans->postRequest("topqur.bcCreditPayQuery", $payment_query_params, "merchantKey2");
 # 对银行卡分期支付查询结果进行处理
 if ($trans->isError()){
     //失败处理
     var_dump($trans->result);
 } else {
     //成功处理
     var_dump($trans->result);
 }
 
 
 
 
 
 $payment_confirm_params = array(
     // 请求流水号，需保证当天商户下唯一，推荐采用日期时间+几位流水号的形式
    "req_seq_id" => $reqSeqId_payment_confirm,
    // 请求日期，请求接口的日期，因服务器时间可能有差异，允许前后1天
    "req_date"=> date("Ymd"),
    // 系统号，由汇付分配
    "sys_id"=>DemoConstants::DEMO_SYS_ID,
    // 商户订单号，需保证商户下唯一，推荐采用日期时间+几位流水号的形式，可与req_seq_id相同
    "mer_ord_id"=>$merOrdId_payment_confirm,
    // 分配商户号
    "huifu_id"=>DemoConstants::DEMO_HUIFU_ID,
	
    // 原请求流水号
    "org_seq_id" => $reqSeqId_payment,
    // 原请求时间
    "org_seq_date"=> $nowDate,
    // 手机验证码
    "verify_code"=>"******",
	
	// 网联扩展字段 json
	"extend_pay"=> array(
		// 付款终端类型 01：电脑02：手机03：平板设备04：可穿戴设备05：数字电视06：条码支付受理终端99：其他
		"pyer_trx_trm_tp"=>"99",
		// 收款方账户编号 网联银联支付使用
		"pyee_acct_id"=>"6214***************6688",
		// 收款方账户名称
		"pyee_nm"=>"李四",
		// 收款方账户类型 （见数据字典的收款方账户类型, 默认值：04 单位支付账户）
		"pyee_acct_tp"=>"04",
		// 二级商户类型： 01：法人02：其他组织03：个体工商户04：自然人
		"mer_type"=>"03",
		// 二级商户证件类型：00：身份证01：护照02：军官证03：军官证04：回乡证05：户口簿06：警官证07：临时身份证08：台胞证09：港澳通行证10：企业营业执照11：法人代表证12：外国人永久居留证，即绿卡13：其他
		"mer_id_type"=>"00",
		// 二级商户证件编码
		"mer_id_no"=>"310*************86",
		// 二级商户行业类别 参照银联MCC编码
		"mer_cat_code"=>"8541",
		// 商品简称
		"goods_short_name"=>"****",
	),
	
    // 设备信息
    "terminal_device_info"=>array (
			// 设备类型 1:手机2:平板3:手表4:PC
            "device_type"=>"4",
			// 交易设备IP(公网IP,目前暂传IPv4格式)
            "device_ip"=>"139.207.19.246"
     ),
   
    // 风控信息
    // 注意，风控信息为JSON字符串
    "risk_check_info"=> json_encode(array(
        "riskMngInfo"=> array(
            "subTradeType"=>"4300"
        ),
        "ipAddr"=>"139.207.19.246"
    )),
    // 异步通知地址
    "notify_url"=>"virgo://http://www.vclinker.com",

 );
 

 # 请求银行卡分期支付确认接口
 $trans->postRequest("top.bccredit.paymentConfirm", $payment_confirm_params);
 # 如有多套配置，可指定使用哪套配置，指定merchanKey为初始化时设置的。
 #$trans->postRequest("top.bccredit.paymentConfirm", $payment_confirm_params, "merchantKey2");
 # 对银行卡分期支付确认结果进行处理
 if ($trans->isError()){
     //失败处理
     var_dump($trans->result);
 } else {
     //成功处理
     var_dump($trans->result);
 }
 
 
 
 
 
 $refund_params = array(
     // 请求流水号，需保证当天商户下唯一，推荐采用日期时间+几位流水号的形式
    "req_seq_id" => $reqSeqId_refund,
    // 请求日期，请求接口的日期，因服务器时间可能有差异，允许前后1天
    "req_date"=> date("Ymd"),
    // 系统号，由汇付分配
    "sys_id"=>DemoConstants::DEMO_SYS_ID,
    // 商户订单号，需保证商户下唯一，推荐采用日期时间+几位流水号的形式，可与req_seq_id相同
    "mer_ord_id"=>$merOrdId_refund,
    // 分配商户号
    "huifu_id"=>DemoConstants::DEMO_HUIFU_ID,
	
    // 原请求流水号
    "org_req_seq_id" => $reqSeqId_payment,
    // 原请求时间
    "org_req_date"=> $nowDate,
    // 退款金额
    "ord_amt"=>"100.00",
	
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
    // 设备信息
    "terminal_device_info"=>array (
			// 设备类型 1:手机2:平板3:手表4:PC
            "device_type"=>"4",
			// 交易设备IP(公网IP,目前暂传IPv4格式)
            "device_ip"=>"139.207.19.246"
     ),
   
    // 风控信息
    // 注意，风控信息为JSON字符串
    "risk_check_info"=> json_encode(array(
        "riskMngInfo"=> array(
            "subTradeType"=>"4300"
        ),
        "ipAddr"=>"139.207.19.246"
    )),
    // 异步通知地址
    "notify_url"=>"virgo://http://www.vclinker.com",

 );
 

 # 请求银行卡分期支付退款接口
 $trans->postRequest("toprrc.bccredit.refund", $refund_params);
 # 如有多套配置，可指定使用哪套配置，指定merchanKey为初始化时设置的。
 #$trans->postRequest("toprrc.bccredit.refund", $refund_params, "merchantKey2");
 # 对银行卡分期支付退款结果进行处理
 if ($trans->isError()){
     //失败处理
     var_dump($trans->result);
 } else {
     //成功处理
     var_dump($trans->result);
 }
 
 
 
 
 
 $refund_query_params = array(
     "huifu_id"=> DemoConstants::DEMO_HUIFU_ID,
     "req_date"=> $nowDate,
     "sys_id"=> DemoConstants::DEMO_SYS_ID,
	 // 以下指定原交易的唯一标识，支持4选1，可根据req_seq_id、out_trans_id、out_ord_id、hf_seq_id其中之一定位原交易
     "req_seq_id"=> $reqSeqId_refund
 );
 

 # 请求银行卡分期支付退款查询接口
 $trans->postRequest("toprrc.refund", $refund_query_params);
 # 如有多套配置，可指定使用哪套配置，指定merchanKey为初始化时设置的。
 #$trans->postRequest("toprrc.refund", $refund_query_params, "merchantKey2");
 # 对银行卡分期支付退款查询结果进行处理
 if ($trans->isError()){
     //失败处理
     var_dump($trans->result);
 } else {
     //成功处理
     var_dump($trans->result);
 }
 
 
 
 
 
 
 $delay_payment_confirm_params = array(
     // 请求流水号，需保证当天商户下唯一，推荐采用日期时间+几位流水号的形式
    "req_seq_id" => $reqSeqId_payment_confirm_delay,
    // 请求日期，请求接口的日期，因服务器时间可能有差异，允许前后1天
    "req_date"=> date("Ymd"),
    // 系统号，由汇付分配
    "sys_id"=>DemoConstants::DEMO_SYS_ID,
    // 商户订单号，需保证商户下唯一，推荐采用日期时间+几位流水号的形式，可与req_seq_id相同
    "mer_ord_id"=>$merOrdId_payment_confirm_delay,
    // 分配商户号
    "huifu_id"=>DemoConstants::DEMO_HUIFU_ID,
	
    // 原请求流水号
    "org_req_seq_id" => $reqSeqId_payment,
    // 原请求时间
    "org_seq_date"=> $nowDate,
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
    )

 );
 

 # 请求银行卡分期支付延时交易确认接口
 $trans->postRequest("topat.payConfirm", $delay_payment_confirm_params);
 # 如有多套配置，可指定使用哪套配置，指定merchanKey为初始化时设置的。
 #$trans->postRequest("topat.payConfirm", $delay_payment_confirm_params, "merchantKey2");
 # 对银行卡分期支付延时交易确认结果进行处理
 if ($trans->isError()){
     //失败处理
     var_dump($trans->result);
 } else {
     //成功处理
     var_dump($trans->result);
 }
 
 
 
 
 
 $delay_payment_confirm_query_params = array(
     // 请求流水号，需保证当天商户下唯一，推荐采用日期时间+几位流水号的形式
    "req_seq_id" => $merOrdId_payment_confirm_delay,
    // 请求日期，请求接口的日期，因服务器时间可能有差异，允许前后1天
    "req_date"=> date("Ymd"),
    // 系统号，由汇付分配
    "sys_id"=>DemoConstants::DEMO_SYS_ID,
    // 分配商户号
    "huifu_id"=>DemoConstants::DEMO_HUIFU_ID,
    // 原请求流水号
    "org_seq_id" => $merOrdId_payment_confirm_delay,
    // 原请求时间
    "org_seq_date"=> $nowDate,

 );
 

 # 请求银行卡分期支付交易延时确认查询接口
 $trans->postRequest("topqur.payConfirmQuery", $delay_payment_confirm_query_params);
 # 如有多套配置，可指定使用哪套配置，指定merchanKey为初始化时设置的。
 #$trans->postRequest("topqur.payConfirmQuery", $delay_payment_confirm_query_params, "merchantKey2");
 # 对银行卡分期支付交易延时确认查询结果进行处理
 if ($trans->isError()){
     //失败处理
     var_dump($trans->result);
 } else {
     //成功处理
     var_dump($trans->result);
 }
 
 
 
 
 
 
 $delay_payment_confirm_refund_params = array(
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
	
    // 原请求流水号
    "org_req_seq_id" => $reqSeqId_payment_confirm_delay,
    // 原请求时间
    "org_req_date"=> $nowDate,
	
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
    
    // 异步通知地址
    "notify_url"=>"virgo://http://www.vclinker.com",

 );
 

 # 请求银行卡分期支付交易延时确认退款接口
 $trans->postRequest("toprrc.payConfirmRefund", $delay_payment_confirm_refund_params);
 # 如有多套配置，可指定使用哪套配置，指定merchanKey为初始化时设置的。
 #$trans->postRequest("toprrc.payConfirmRefund", $delay_payment_confirm_refund_params, "merchantKey2");
 # 对银行卡分期支付交易延时确认退款结果进行处理
 if ($trans->isError()){
     //失败处理
     var_dump($trans->result);
 } else {
     //成功处理
     var_dump($trans->result);
 }
 
 
 
 
 
 $delay_payment_confirm_list_query_params = array(
     // 请求流水号，需保证当天商户下唯一，推荐采用日期时间+几位流水号的形式
    "trans_req_seq_id" => $merOrdId_payment_confirm_delay,
    // 请求日期，请求接口的日期，因服务器时间可能有差异，允许前后1天
    "trans_req_date"=> $nowDate,
    // 系统号，由汇付分配
    "sys_id"=>DemoConstants::DEMO_SYS_ID,
    // 分配商户号
    "huifu_id"=>DemoConstants::DEMO_HUIFU_ID,

 );
 

 # 请求银行卡分期支付延时交易确认批量查询接口
 $trans->postRequest("topqur.payConfirmListQuery", $delay_payment_confirm_list_query_params);
 # 如有多套配置，可指定使用哪套配置，指定merchanKey为初始化时设置的。
 #$trans->postRequest("topqur.payConfirmListQuery", $delay_payment_confirm_list_query_params, "merchantKey2");
 # 对银行卡分期支付延时交易确认批量查询结果进行处理
 if ($trans->isError()){
     //失败处理
     var_dump($trans->result);
 } else {
     //成功处理
     var_dump($trans->result);
 }
 
 
 ?>