<?php

/**
 * 商户业务开通修改 - 示例
 *
 * @author sdk-generator
 * @Description
 */
namespace BsPayDemo;

// 1. 资源及配置加载
require_once dirname(__FILE__) . "/loader.php";
require_once  dirname(__FILE__). "/../BsPaySdk/request/V2MerchantBusiModifyRequest.php";

use BsPaySdk\core\BsPayClient;
use BsPaySdk\request\V2MerchantBusiModifyRequest;

// 2.组装请求参数
$request = new V2MerchantBusiModifyRequest();
// 请求流水号
$request->setReqSeqId(date("YmdHis").mt_rand());
// 请求日期
$request->setReqDate(date("Ymd"));
// 汇付客户Id
$request->setHuifuId("6666000103668046");
// *线上业务类型编码*开通快捷、网银、余额支付Pro版、分账必填；参见[线上业务类型编码及补充材料说明](https://cloudpnrcdn.oss-cn-shanghai.aliyuncs.com/opps/api/prod/download_file/kyc/KYC-%E7%BA%BF%E4%B8%8A%E4%B8%9A%E5%8A%A1%E7%B1%BB%E5%9E%8B%E7%BC%96%E7%A0%81%E5%8F%8A%E8%A1%A5%E5%85%85%E6%9D%90%E6%96%99%E8%AF%B4%E6%98%8E.xlsx)；&lt;font color&#x3D;&quot;green&quot;&gt;示例值：H7999AL&lt;/font&gt;
// $request->setOnlineBusiType("test");
// 签约人jsonObject字符串；agreement_info中选择电子签约时必填；个人商户填本人信息。
// $request->setSignUserInfo(get187580919021488aA758B8c20fb53591());

// 设置非必填字段
$extendInfoMap = getExtendInfos();
$request->setExtendInfo($extendInfoMap);

// 3. 发起API调用
$client = new BsPayClient();
$result = $client->postRequest($request);
$respData = $result->getRspDatas();
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
    // 微信支付宝商户简称
    $extendInfoMap["short_name"]= "";
    // *协议信息实体*
    $extendInfoMap["agreement_info"]= get74ee991957e9499d88b9Ac9fcebe7d71();
    // 是否交易手续费外扣
    $extendInfoMap["out_fee_flag"]= "2";
    // 交易手续费外扣汇付ID
    $extendInfoMap["out_fee_huifuid"]= "";
    // 交易手续费外扣时的账户类型
    $extendInfoMap["out_fee_acct_type"]= "";
    // 是否开通网银
    $extendInfoMap["online_flag"]= "";
    // 是否开通快捷
    $extendInfoMap["quick_flag"]= "";
    // 是否开通代扣
    $extendInfoMap["withhold_flag"]= "";
    // 延迟入账开关
    $extendInfoMap["delay_flag"]= "Y";
    // 开通支付宝预授权
    $extendInfoMap["alipay_pre_auth_flag"]= "Y";
    // 开通微信预授权
    // $extendInfoMap["wechatpay_pre_auth_flag"]= "";
    // 商户业务类型
    // $extendInfoMap["mer_bus_type"]= "";
    // 线上费率配置
    // $extendInfoMap["online_fee_conf_list"]= "";
    // 支付宝配置对象
    $extendInfoMap["ali_conf_list"]= get11bbc9f47940462e8bfd2ad3aa61213e();
    // 微信配置对象
    $extendInfoMap["wx_conf_list"]= get107a8c79B20540f9AedeBc2b0d4164a0();
    // 银联二维码配置对象
    $extendInfoMap["union_conf_list"]= getE0b1cc7c4b154b6590beB87cc777f3af();
    // 银行卡支付配置信息
    $extendInfoMap["bank_card_conf"]= getB6a81252A7374f0eB8deF97722e5dec7();
    // *余额支付配置对象*
    $extendInfoMap["balance_pay_config"]= getF07ab1ccDc104597B2b2618f1b4404ab();
    // 补贴支付
    $extendInfoMap["combine_pay_config"]= {"switch_state":"0","fee_fix_amt":"5","fee_rate":"10"};
    // 线上手续费承担方配置
    // $extendInfoMap["online_pay_fee_conf_list"]= "";
    // 全域资金管理配置(华通银行)
    // $extendInfoMap["out_order_funds_config"]= "";
    // 汇总结算配置实体
    // $extendInfoMap["collection_settle_config_list"]= "";
    // 异步消息接收地址
    $extendInfoMap["async_return_url"]= "http://www.baidu55.com";
    // 业务开通结果异步消息接收地址
    $extendInfoMap["busi_async_return_url"]= "";
    // 交易异步应答地址
    $extendInfoMap["recon_resp_addr"]= "http://192.168.85.157:30031/sspm/testVirgo";
    // *运营媒介*
    // $extendInfoMap["online_media_info_list"]= getA834bc5178da40f9A46e6b597822df2a();
    // *补充文件信息*
    // $extendInfoMap["extended_material_list"]= get868f522a72244de388f6F85a86dca86c();
    // 商户开通强制延迟标记
    // $extendInfoMap["forced_delay_flag"]= "";
    // 微信直连配置对象
    // $extendInfoMap["wx_zl_conf"]= "";
    // 支付宝直连配置对象
    // $extendInfoMap["ali_zl_conf"]= "";
    // 开户费用值(元)
    // $extendInfoMap["enter_fee"]= "";
    // 开户费用类型
    // $extendInfoMap["enter_fee_flag"]= "";
    // 是否开通在线退款
    // $extendInfoMap["online_refund"]= "";
    // 是否支持平台退款
    // $extendInfoMap["platform_refund"]= "";
    // 是否支持撤销
    // $extendInfoMap["support_revoke"]= "";
    // 分账配置信息
    // $extendInfoMap["split_conf_info"]= get7b49a3e2C6a0471cB83f833b1c529f4b();
    // 银联线上收银台
    // $extendInfoMap["uni_app_payment_config"]= "";
    // 资金归集开通标记
    // $extendInfoMap["fund_collection_flag"]= "";
    // 代发配置
    // $extendInfoMap["surrogate_config_list"]= "";
    // 大额支付配置
    // $extendInfoMap["large_amt_pay_config"]= "";
    // 托管支付开关
    // $extendInfoMap["half_pay_host_flag"]= "";
    // 代发复核配置
    // $extendInfoMap["agent_recheck_config"]= "";
    // 商户开通网银充值开关
    // $extendInfoMap["online_recharge_flag"]= "";
    // 是否开通垫资退款
    // $extendInfoMap["refund_mend_open_flag"]= "";
    // 捷行付配置
    // $extendInfoMap["jxf_conf_info"]= "";
    return $extendInfoMap;
}

function get74ee991957e9499d88b9Ac9fcebe7d71() {
    $dto = array();
    // *协议类型*
    $dto["agreement_type"] = "0";
    // *挂网协议地址*挂网协议必填；**必须按示例值填写**，&lt;font color&#x3D;&quot;green&quot;&gt;示例值：https://cloudpnrcdn.oss-cn-shanghai.aliyuncs.com/opps/api/prod/download_file/PaymentServiceAgreement.htm&lt;/font&gt;；
    // $dto["agreement_url"] = "test";
    // 纸质协议开始日期
    $dto["agree_begin_date"] = "20200325";
    // 纸质协议结束日期
    $dto["agree_end_date"] = "20400325";
    // 电子协议签约短信发送标识
    // $dto["message_send_type"] = "";
    // 电子协议异步通知地址
    // $dto["agreement_async_return_url"] = "";

    return json_encode($dto,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
}

function get57f62b4f8fc343e987b265b9d3f8d745() {
    $dto = array();
    // 联系人身份证号码
    // $dto["id_card_number"] = "test";
    // 联系人姓名
    // $dto["name"] = "";
    // 联系人手机号
    // $dto["mobile"] = "";

    return json_encode($dto,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
}

function get4968f95cBda747e184ff1c3b277642bd() {
    $dto = array();
    // 证件持有人类型
    // $dto["legal_type"] = "";
    // 证件类型
    // $dto["card_type"] = "";
    // 姓名
    // $dto["person_name"] = "";
    // 证件号码
    // $dto["card_no"] = "";
    // 证件生效时间
    // $dto["effect_time"] = "";
    // 证件过期时间
    // $dto["expire_time"] = "";
    // 证件正面照
    // $dto["card_front_img"] = "";
    // 证件反面照
    // $dto["card_back_img"] = "";
    // 授权函照片
    // $dto["auth_letter_img"] = "";
    // 是否为受益人
    // $dto["is_benefit_person"] = "";

    return json_encode($dto,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
}

function getD73e8dc4Aedc4149Be9d927e6a7c461c() {
    $dto = array();
    // 是否金融机构
    // $dto["finance_institution_flag"] = "";
    // 金融机构类型
    // $dto["finance_type"] = "";
    // 证书类型
    // $dto["cert_type"] = "";
    // 小微经营类型
    // $dto["micro_biz_type"] = "";
    // 特殊行业id
    // $dto["special_category_id"] = "";
    // 联系人信息对象
    // $dto["contact_person_info"] = get57f62b4f8fc343e987b265b9d3f8d745();
    // 法人身份信息
    // $dto["legal_person_info"] = get4968f95cBda747e184ff1c3b277642bd();

    return json_encode($dto,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
}

function get11bbc9f47940462e8bfd2ad3aa61213e() {
    $dto = array();
    // 手续费（%）
    $dto["fee_rate"] = "3.15";
    // 支付场景
    $dto["pay_scene"] = "1";
    // *功能开关*
    // $dto["switch_state"] = "test";
    // 最低收取手续费（元）
    // $dto["fee_min_amt"] = "";
    // 商户经营类目
    $dto["mcc"] = "2016062900190337";
    // 子渠道号
    $dto["pay_channel_id"] = "10000001";
    // 是否需要实名认证
    // $dto["is_check_real_name"] = "";
    // 实名认证信息
    // $dto["al_real_name_info"] = getD73e8dc4Aedc4149Be9d927e6a7c461c();

    $dtoList = array();
    array_push($dtoList, $dto);
    return json_encode($dtoList,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
}

function get97e724940241457fB26790037624e929() {
    $dto = array();
    // 联系人姓名联系人类型contact_type&#x3D;SUPER时必填。示例值：张三
    // $dto["name"] = "test";
    // 联系人手机号联系人类型contact_type&#x3D;SUPER时必填。示例值：13917364538
    // $dto["mobile"] = "test";
    // 联系人证件类型联系人类型contact_type&#x3D;SUPER时必填。&lt;br/&gt;枚举值参见《自然人证件类型》说明，示例值：00&lt;br/&gt;个体户/企业/事业单位/社会组织：可选择任一证件类型，政府机关仅支持身份证类型。
    // $dto["contact_id_doc_type"] = "test";
    // 联系人证件号码联系人类型contact_type&#x3D;SUPER时必填。示例值：320936198512035017
    // $dto["id_card_number"] = "test";
    // 联系人证件有效期开始时间联系人类型contact_type&#x3D;SUPER时必填&lt;br/&gt;格式：yyyy-MM-dd；示例值：2019-06-06
    // $dto["contact_period_begin"] = "test";
    // 联系人证件有效期结束时间联系人类型contact_type&#x3D;SUPER时必填&lt;br/&gt;格式：yyyy-MM-dd；示例值：2029-06-06&lt;br/&gt;结束时间大于开始时间;若证件有效期为长期，请填写：长期
    // $dto["contact_period_end"] = "test";
    // 是否金融机构
    // $dto["finance_institution_flag"] = "";
    // 金融机构类型
    // $dto["finance_type"] = "";
    // 证书类型
    // $dto["cert_type"] = "";
    // 小微经营类型
    // $dto["micro_biz_type"] = "";
    // 特殊行业id
    // $dto["special_category_id"] = "";
    // 联系人类型
    // $dto["contact_type"] = "";

    return $dto;
}

function get107a8c79B20540f9AedeBc2b0d4164a0() {
    $dto = array();
    // 开关状态
    // $dto["switch_state"] = "test";
    // 手续费（%）
    $dto["fee_rate"] = "2.15";
    // 支付场景
    $dto["pay_scene"] = "10";
    // 最低收取手续费（元）
    // $dto["fee_min_amt"] = "";
    // 费率规则ID
    $dto["fee_rule_id"] = "765";
    // 子渠道号
    $dto["pay_channel_id"] = "JP00001";
    // 申请服务
    $dto["service_codes"] = "";
    // 是否需要实名认证
    // $dto["is_check_real_name"] = "";
    // 实名认证信息
    // $dto["wx_real_name_info"] = get97e724940241457fB26790037624e929();

    $dtoList = array();
    array_push($dtoList, $dto);
    return json_encode($dtoList,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
}

function getE0b1cc7c4b154b6590beB87cc777f3af() {
    $dto = array();
    // 借记卡手续费（%）
    // $dto["debit_fee_rate"] = "test";
    // 贷记卡手续费1000以上（%）
    $dto["credit_fee_rate_up"] = "6.566";
    // 贷记卡手续费1000及以下（%）
    $dto["credit_fee_rate_down"] = "1";
    // 银行业务手续费类型
    $dto["charge_cate_code"] = "";
    // 功能开关
    // $dto["switch_state"] = "";

    $dtoList = array();
    array_push($dtoList, $dto);
    return json_encode($dtoList,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
}

function getB6a81252A7374f0eB8deF97722e5dec7() {
    $dto = array();
    // 借记卡手续费（%）
    $dto["debit_fee_rate"] = "3";
    // 贷记卡手续费（%）
    $dto["credit_fee_rate"] = "6";
    // 银行业务手续费类型
    $dto["charge_cate_code"] = "02";
    // 借记卡封顶值
    $dto["debit_fee_limit"] = "5";
    // 是否开通小额双免
    $dto["is_open_small_flag"] = "0";
    // 小额双免单笔限额(元)
    $dto["small_free_amt"] = "500";
    // 小额双免手续费（%）
    $dto["small_fee_amt"] = "1";
    // 功能开关
    // $dto["switch_state"] = "";
    // 云闪付开通状态
    // $dto["is_open_cloud_flag"] = "";

    return json_encode($dto,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
}

function get7d0a0c2104ad41fb9a0a9110216da0a5() {
    $dto = array();
    // *业务模式说明*请详细说明商户的业务模式，包括不限于（业务参与方、各方的权利及义务关系等）。最大500个汉字，必填&lt;br/&gt;&lt;font color&#x3D;&quot;green&quot;&gt;示例值：商户向企业采购产品，并将其展示在其电商平台上，用户注册后购买其产品，产品主要有家电、服饰、鞋帽等，用户购买产品的资金作为商户所得，商户根据订单情况进行物流配送。&lt;/font&gt;
    // $dto["busi_instruction"] = "test";
    // *资金流向说明*请详细说明商户的资金流向，包括但不限于（交易所涉及的各方账户、资金流入流出过程等）。最大500个汉字，必填&lt;br/&gt;&lt;font color&#x3D;&quot;green&quot;&gt;示例值：用户选购产品后根据订单支付给商户，商户根据结算周期，结算到对公账户。&lt;/font&gt;
    // $dto["capital_instruction"] = "test";
    // *功能开通用途说明*请详述所申请功能的原因、场景、涉及对象类型。最大500个汉字，必填&lt;br/&gt;&lt;font color&#x3D;&quot;green&quot;&gt;示例值：企业工资代发&lt;/font&gt;
    // $dto["function_instruction"] = "test";

    return $dto;
}

function getF07ab1ccDc104597B2b2618f1b4404ab() {
    $dto = array();
    // *业务模式*
    // $dto["balance_model"] = "test";
    // *业务情况说明*
    // $dto["description_info"] = get7d0a0c2104ad41fb9a0a9110216da0a5();
    // 支付手续费(%)
    $dto["fee_rate"] = "2";
    // 支付固定手续费(元)
    $dto["fee_fix_amt"] = "1";
    // 功能开关
    $dto["switch_state"] = "1";
    // 交易手续费外扣时的账户类型
    // $dto["out_fee_acct_type"] = "";
    // 交易手续费外扣汇付ID
    // $dto["out_fee_huifuid"] = "";
    // 是否交易手续费外扣
    // $dto["out_fee_flag"] = "";
    // 扣费模式
    // $dto["charge_mode"] = "";
    // 余额支付模式
    // $dto["pay_mode"] = "";

    return json_encode($dto,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
}

function getA834bc5178da40f9A46e6b597822df2a() {
    $dto = array();
    // *运营媒介类型*
    // $dto["media_type"] = "test";
    // *媒介名称*PC网站域名／APP名称／小程序名称／公众号名称；&lt;font color&#x3D;&quot;green&quot;&gt;示例值：汇付服务&lt;/font&gt;&lt;br/&gt;运营媒介类型为 ：S1/S2/S3/S4时，必填；
    // $dto["media_name"] = "test";
    // ICP备案/许可证号运营媒介类型为 ：S1时必填；&lt;font color&#x3D;&quot;green&quot;&gt;示例值：沪ICP备06046402号-28&lt;/font&gt;
    // $dto["mer_icp"] = "test";
    // *其他有效信息*其他有效信息或链接地址/APP下载地址；类型为S5或S2必填&lt;br/&gt;&lt;font color&#x3D;&quot;green&quot;&gt;示例值：http://download.huifu.com&lt;/font&gt;
    // $dto["other_info"] = "test";
    // *媒介主体与商户主体是否一致*Y/N；&lt;font color&#x3D;&quot;green&quot;&gt;示例值：Y&lt;/font&gt;&lt;br/&gt;运营媒介为S1、S2、S3、S4且企业商户开通快捷或网银，或大额转账，或余额支付或分账业务（20%（不含）-100%），或为个人商户开通分账业务（10%（不含）-100%），必填&lt;br/&gt;若不一致，则需提供ICP备案/APP/微信公众号/小程序主体与商户的使用授权或开发证明材料；
    // $dto["media_mer_common_flag"] = "test";
    // *授权或开发证明材料*运营媒介为S1、S2、S3、S4且媒介主体与商户主体不一致时，且企业商户开通快捷或网银，或大额转账，或余额支付或分账业务（20%（不含）-100%），或为个人商户开通分账业务（10%（不含）-100%），必填&lt;br/&gt;&lt;font color&#x3D;&quot;green&quot;&gt;示例值：57cc7f00-600a-33ab-b614-6221bbf2e530&lt;/font&gt;
    // $dto["authorize_materials"] = "test";
    // 微信APP补充材料运营媒介为S2且开通微信下app支付时选填，具体见[图片上传接口](https://paas.huifu.com/open/doc/api/#/shgl/shjj/api_shjj_shtpsc)
    // $dto["other_material"] = "test";
    // appId运营媒介为S2且开通微信下app支付时必填
    // $dto["app_id"] = "test";
    // appId认证主体名称运营媒介为S2且开通微信下app支付时必填
    // $dto["app_name"] = "test";
    // 补充说明运营媒介为S2且开通微信下app支付时选填
    // $dto["supplement"] = "test";
    // *测试账号*
    // $dto["test_account"] = "";
    // *测试密码*
    // $dto["test_secret"] = "";
    // *运营媒介-首页*
    // $dto["media_front_page"] = "";
    // *运营媒介-服务/商品明细页面*
    // $dto["media_service_page"] = "";
    // *运营媒介-下单场景页面*
    // $dto["media_order_page"] = "";
    // *运营媒介-支付页面*
    // $dto["media_pay_page"] = "";

    $dtoList = array();
    array_push($dtoList, $dto);
    return json_encode($dtoList,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
}

function get868f522a72244de388f6F85a86dca86c() {
    $dto = array();
    // *文件id*
    // $dto["file_id"] = "test";
    // *文件类型*
    // $dto["file_type"] = "";

    $dtoList = array();
    array_push($dtoList, $dto);
    return json_encode($dtoList,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
}

function get187580919021488aA758B8c20fb53591() {
    $dto = array();
    // 签约人类型
    // $dto["type"] = "test";
    // 姓名签约人类型&#x3D;其他，必填；&lt;font color&#x3D;&quot;green&quot;&gt;示例值：张三&lt;/font&gt;
    // $dto["name"] = "test";
    // 手机号签约人类型&#x3D;法人/其他 ，必填；注意：**签约人会做姓名+身份证+手机号验证，请正确填写**；&lt;font color&#x3D;&quot;green&quot;&gt;示例值：13917463536&lt;/font&gt;
    // $dto["mobile_no"] = "test";
    // 身份证签约人类型&#x3D;联系人/其他，必填 ；注意：**签约人会做姓名+身份证+手机号验证，请正确填写**；&lt;font color&#x3D;&quot;green&quot;&gt;示例值：320946195712025082&lt;/font&gt;
    // $dto["cert_no"] = "test";
    // 邮箱
    // $dto["email"] = "";

    return json_encode($dto,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
}

function get6cd0211d1a304565B91d17a5f9101db6() {
    $dto = array();
    // 分账比例
    // $dto["fee_rate"] = "test";
    // 汇付Id
    // $dto["huifu_id"] = "test";

    return $dto;
}

function get08b0dca8141c4333911e9b84a64a681e() {
    $dto = array();
    // *业务模式说明*
    // $dto["busi_instruction"] = "test";
    // *资金流向说明*
    // $dto["capital_instruction"] = "test";
    // *功能开通用途说明*
    // $dto["function_instruction"] = "test";

    return $dto;
}

function get7b49a3e2C6a0471cB83f833b1c529f4b() {
    $dto = array();
    // 分账规则来源
    // $dto["rule_origin"] = "test";
    // 分账开关
    // $dto["div_flag"] = "test";
    // 最大分账比例%
    // $dto["apply_ratio"] = "test";
    // 生效类型
    // $dto["start_type"] = "test";
    // 分账模式
    // $dto["scene"] = "test";
    // 分账明细
    // $dto["acct_split_bunch_list"] = get6cd0211d1a304565B91d17a5f9101db6();
    // 交易手续费外扣开关
    // $dto["out_fee_flag"] = "";
    // 交易手续费外扣时的账户类型
    // $dto["out_fee_acct_type"] = "";
    // 交易手续费外扣汇付ID
    // $dto["out_fee_huifuid"] = "";
    // 手续费%
    // $dto["split_fee_rate"] = "";
    // 固定手续费
    // $dto["per_amt"] = "";
    // 业务情况说明
    // $dto["split_ext_info"] = get08b0dca8141c4333911e9b84a64a681e();

    return json_encode($dto,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
}


