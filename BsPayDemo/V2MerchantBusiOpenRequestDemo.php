<?php

/**
 * 商户业务开通 - 示例
 *
 * @author sdk-generator
 * @Description
 */
namespace BsPayDemo;

// 1. 资源及配置加载
require_once dirname(__FILE__) . "/loader.php";
require_once  dirname(__FILE__). "/../BsPaySdk/request/V2MerchantBusiOpenRequest.php";

use BsPaySdk\core\BsPayClient;
use BsPaySdk\request\V2MerchantBusiOpenRequest;

// 2.组装请求参数
$request = new V2MerchantBusiOpenRequest();
// 请求流水号
$request->setReqSeqId(date("YmdHis").mt_rand());
// 请求日期
$request->setReqDate(date("Ymd"));
// 汇付客户Id
$request->setHuifuId("6666000104778898");
// 直属渠道号
$request->setUpperHuifuId("6666000003080000");
// 签约人jsonObject字符串；agreement_info中选择电子签约时必填；个人商户填本人信息。
// $request->setSignUserInfo(get4bd65fd20d65417c86786677bc8c78d2());
// 线上业务类型编码基本信息入驻接口中scene_type&#x3D;ONLINE/ALL时必填；&lt;br/&gt;开通以下业务快捷、网银、余额支付Pro版、银行大额转账、分账比例&gt;30%需要提供补充材料，参见[线上业务类型编码及补充材料说明](https://cloudpnrcdn.oss-cn-shanghai.aliyuncs.com/opps/api/prod/download_file/kyc/KYC-%E7%BA%BF%E4%B8%8A%E4%B8%9A%E5%8A%A1%E7%B1%BB%E5%9E%8B%E7%BC%96%E7%A0%81%E5%8F%8A%E8%A1%A5%E5%85%85%E6%9D%90%E6%96%99%E8%AF%B4%E6%98%8E.xlsx)；材料通过[图片上传接口](https://paas.huifu.com/open/doc/api/#/shgl/shjj/api_shjj_shtpsc)上传&lt;font color&#x3D;&quot;green&quot;&gt;示例值：H7999AL&lt;/font&gt;
// $request->setOnlineBusiType("test");
// *协议信息实体*jsonObject字符串；[签约协议材料说明](https://cloudpnrcdn.oss-cn-shanghai.aliyuncs.com/opps/api/prod/download_file/kyc/KYC-%E5%95%86%E6%88%B7%E5%90%88%E5%90%8C%E7%AD%BE%E7%BA%A6%E8%A7%84%E5%88%99.xlsx) &lt;br/&gt;若未签署过协议的情况下，调用该接口时必填；&lt;br/&gt;若已签署过纸质或电子协议下，调用该接口时必填，且只可以选择纸质或电子协议；&lt;br/&gt;若已签署过挂网协议下，调用该接口时，选填。
$request->setAgreementInfo(getFae873a3Ec5a42e597209188f140b998());

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
    $extendInfoMap["short_name"]= "简称";
    // 是否开通网银
    $extendInfoMap["online_flag"]= "Y";
    // 是否开通快捷
    $extendInfoMap["quick_flag"]= "Y";
    // 是否开通代扣
    $extendInfoMap["withhold_flag"]= "Y";
    // 商户业务类型
    // $extendInfoMap["mer_bus_type"]= "";
    // 是否交易手续费外扣
    $extendInfoMap["out_fee_flag"]= "2";
    // 交易手续费外扣汇付ID
    $extendInfoMap["out_fee_huifuid"]= "";
    // 交易手续费外扣时的账户类型
    $extendInfoMap["out_fee_acct_type"]= "";
    // 支付宝配置对象
    $extendInfoMap["ali_conf_list"]= get44ad752cA4fa4e1388c15c9eba9059bb();
    // 支付宝直连配置对象
    // $extendInfoMap["ali_zl_conf"]= "";
    // 开通支付宝预授权
    $extendInfoMap["alipay_pre_auth_flag"]= "N";
    // 微信配置对象
    $extendInfoMap["wx_conf_list"]= get326ddb1137ee43b98483Cf539a951637();
    // 微信直连配置对象
    // $extendInfoMap["wx_zl_conf"]= "";
    // 开通微信预授权
    $extendInfoMap["wechatpay_pre_auth_flag"]= "N";
    // 银联二维码配置
    $extendInfoMap["union_conf_list"]= getE5fbb33e99de4798Bd862ead1d1f667e();
    // 银行卡业务配置
    $extendInfoMap["bank_card_conf"]= getCe16c6932a674b58B66261b94d44d755();
    // 线上费率配置
    // $extendInfoMap["online_fee_conf_list"]= "";
    // 线上手续费承担方配置
    // $extendInfoMap["online_pay_fee_conf_list"]= "";
    // 运营媒介
    // $extendInfoMap["online_media_info_list"]= getC4f584ae068447c0A0460eebef58e7e2();
    // *余额支付配置*
    $extendInfoMap["balance_pay_config"]= get3822cc444afc42bd854d5a63e22beeb9();
    // 全域资金管理配置(华通银行)
    // $extendInfoMap["out_order_funds_config"]= "";
    // 补贴支付
    $extendInfoMap["combine_pay_config"]= {"fee_fix_amt":"5","fee_rate":"10"};
    // 花呗分期费率配置
    $extendInfoMap["hb_fq_fee_config"]= {"ali_mcc":"5411","six_period":"4.60","pay_scene":"1","acq_six_period":"4.60","out_fee_huifuid":"","three_period":"1.80","acq_three_period":"1.30","twelve_period":"9.12","acq_twelve_period":"9.12","out_fee_acct_type":"","out_fee_flag":"2","fee_charge_type":"1"};
    // 汇总结算配置
    // $extendInfoMap["collection_settle_config_list"]= "";
    // 分账配置信息
    // $extendInfoMap["split_conf_info"]= get1274c77d037f45d19e259ff64416494d();
    // 延迟入账开关
    $extendInfoMap["delay_flag"]= "Y";
    // 商户开通强制延迟标记
    $extendInfoMap["forced_delay_flag"]= "Y";
    // 使用上级微信、支付宝商户号发起交易
    // $extendInfoMap["use_chains_flag"]= "";
    // *补充文件信息*
    // $extendInfoMap["extended_material_list"]= get2e5e45c578f5456b8e798fc0c3bc9a3d();
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
    // 异步消息接收地址
    $extendInfoMap["async_return_url"]= "http://192.168.85.157:30031/sspm/testVirgo";
    // 业务开通结果异步消息接收地址
    $extendInfoMap["busi_async_return_url"]= "";
    // 交易异步应答地址
    $extendInfoMap["recon_resp_addr"]= "http://192.168.85.157:30031/sspm/testVirgo";
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

function get4bd65fd20d65417c86786677bc8c78d2() {
    $dto = array();
    // 签约人类型
    // $dto["type"] = "test";
    // 姓名签约人类型&#x3D;其他，必填；&lt;font color&#x3D;&quot;green&quot;&gt;示例值：张三&lt;/font&gt;
    // $dto["name"] = "test";
    // 身份证签约人类型&#x3D;联系人/其他，必填 ；注意：**签约人会做姓名+身份证+手机号验证，请正确填写**；&lt;font color&#x3D;&quot;green&quot;&gt;示例值：320946195712025082&lt;/font&gt;
    // $dto["cert_no"] = "test";
    // 手机号签约人类型&#x3D;法人/其他 ，必填；注意：**签约人会做姓名+身份证+手机号验证，请正确填写**；&lt;font color&#x3D;&quot;green&quot;&gt;示例值：13917463536&lt;/font&gt;
    // $dto["mobile_no"] = "test";
    // 邮箱
    // $dto["email"] = "";

    return json_encode($dto,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
}

function getA21c44b148194b69Be07523fac8b17f0() {
    $dto = array();
    // 联系人身份证号码
    // $dto["id_card_number"] = "test";
    // 联系人姓名
    // $dto["name"] = "";
    // 联系人手机号
    // $dto["mobile"] = "";

    return json_encode($dto,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
}

function get91568db6Fc9748a7Bcc899b8bdf63abb() {
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

function getF80837ad47c243588541688bd99537a0() {
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
    // $dto["contact_person_info"] = getA21c44b148194b69Be07523fac8b17f0();
    // 法人身份信息
    // $dto["legal_person_info"] = get91568db6Fc9748a7Bcc899b8bdf63abb();

    return $dto;
}

function get44ad752cA4fa4e1388c15c9eba9059bb() {
    $dto = array();
    // 支付场景
    $dto["pay_scene"] = "1";
    // 手续费（%）
    $dto["fee_rate"] = "0.38";
    // 子渠道号
    $dto["pay_channel_id"] = "JQF00001";
    // 最低收取手续费（元）
    // $dto["fee_min_amt"] = "";
    // 是否需要实名认证
    // $dto["is_check_real_name"] = "";
    // 实名认证信息
    // $dto["al_real_name_info"] = getF80837ad47c243588541688bd99537a0();
    // *商户经营类目*
    $dto["mcc"] = "2015091000052157";

    $dtoList = array();
    array_push($dtoList, $dto);
    return json_encode($dtoList,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
}

function get8b51663e8f454cfbBa66D1806dc9b09b() {
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

function get326ddb1137ee43b98483Cf539a951637() {
    $dto = array();
    // 支付场景
    $dto["pay_scene"] = "1";
    // 手续费（%）
    $dto["fee_rate"] = "0.38";
    // *商户经营类目*
    $dto["mcc"] = "111";
    // 费率规则号
    $dto["fee_rule_id"] = "758";
    // 子渠道号
    $dto["pay_channel_id"] = "JP00001";
    // 最低收取手续费（元）
    // $dto["fee_min_amt"] = "";
    // 是否需要实名认证
    // $dto["is_check_real_name"] = "";
    // 实名认证信息
    // $dto["wx_real_name_info"] = get8b51663e8f454cfbBa66D1806dc9b09b();

    $dtoList = array();
    array_push($dtoList, $dto);
    return json_encode($dtoList,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
}

function getE5fbb33e99de4798Bd862ead1d1f667e() {
    $dto = array();
    // 借记卡手续费（%）
    // $dto["debit_fee_rate"] = "test";
    // 贷记卡手续费1000以上（%）
    $dto["credit_fee_rate_up"] = "0.56";
    // 贷记卡手续费1000及以下（%）
    $dto["credit_fee_rate_down"] = "0.38";
    // 银联业务手续费类型
    $dto["charge_cate_code"] = "03";
    // 商户经营类目
    $dto["mcc"] = "5411";

    $dtoList = array();
    array_push($dtoList, $dto);
    return json_encode($dtoList,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
}

function getCe16c6932a674b58B66261b94d44d755() {
    $dto = array();
    // 借记卡手续费（%）
    $dto["debit_fee_rate"] = "0.38";
    // 贷记卡手续费（%）
    $dto["credit_fee_rate"] = "0.39";
    // *商户经营类目*
    $dto["mcc"] = "5411";
    // 银行业务手续费类型
    $dto["charge_cate_code"] = "02";
    // 借记卡封顶值
    $dto["debit_fee_limit"] = "0.56";
    // 是否开通小额双免
    $dto["is_open_small_flag"] = "0";
    // 小额双免单笔限额(元)
    $dto["small_free_amt"] = "1000";
    // 小额双免手续费（%）
    $dto["small_fee_amt"] = "0.33";
    // 云闪付开通状态
    // $dto["is_open_cloud_flag"] = "";

    return json_encode($dto,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
}

function getC4f584ae068447c0A0460eebef58e7e2() {
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

function get89e3dcdfAf4045d68e91B95f2d39bbf4() {
    $dto = array();
    // *业务模式说明*请详细说明商户的业务模式，包括不限于（业务参与方、各方的权利及义务关系等）。最大500个汉字，仅Pro版时必填&lt;br/&gt;&lt;font color&#x3D;&quot;green&quot;&gt;示例值：商户向企业采购产品，并将其展示在其电商平台上，用户注册后购买其产品，产品主要有家电、服饰、鞋帽等，用户购买产品的资金作为商户所得，商户根据订单情况进行物流配送。&lt;/font&gt;
    // $dto["busi_instruction"] = "test";
    // *资金流向说明*请详细说明商户的资金流向，包括但不限于（交易所涉及的各方账户、资金流入流出过程等）。最大500个汉字，仅Pro版时必填&lt;br/&gt;&lt;font color&#x3D;&quot;green&quot;&gt;示例值：用户选购产品后根据订单支付给商户，商户根据结算周期，结算到对公账户。&lt;/font&gt;
    // $dto["capital_instruction"] = "test";
    // *功能开通用途说明*请详述所申请功能的原因、场景、涉及对象类型。最大500个汉字，仅Pro版时必填&lt;br/&gt;&lt;font color&#x3D;&quot;green&quot;&gt;示例值：企业工资代发&lt;/font&gt;
    // $dto["function_instruction"] = "test";

    return $dto;
}

function get3822cc444afc42bd854d5a63e22beeb9() {
    $dto = array();
    // *业务模式*
    // $dto["balance_model"] = "test";
    // 业务情况说明
    // $dto["description_info"] = get89e3dcdfAf4045d68e91B95f2d39bbf4();
    // 手续费(%)
    $dto["fee_rate"] = "2";
    // 手续费（固定/元）
    $dto["fee_fix_amt"] = "1";
    // 手续费外扣时的账户类型
    // $dto["out_fee_acct_type"] = "";
    // 手续费外扣汇付ID
    // $dto["out_fee_huifuid"] = "";
    // 是否交易手续费外扣
    // $dto["out_fee_flag"] = "";
    // 扣费模式
    // $dto["charge_mode"] = "";
    // 余额支付模式
    // $dto["pay_mode"] = "";

    return json_encode($dto,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
}

function getD4a604bdA6a348188210A011795c1145() {
    $dto = array();
    // 分账比例
    // $dto["fee_rate"] = "test";
    // 汇付Id
    // $dto["huifu_id"] = "test";

    return $dto;
}

function getF0acb9057f8a4a2b926c02f4bdcafc0e() {
    $dto = array();
    // *业务模式说明*
    // $dto["busi_instruction"] = "test";
    // *资金流向说明*
    // $dto["capital_instruction"] = "test";
    // *功能开通用途说明*
    // $dto["function_instruction"] = "test";

    return $dto;
}

function get1274c77d037f45d19e259ff64416494d() {
    $dto = array();
    // 分账开关
    // $dto["div_flag"] = "test";
    // 分账规则来源
    // $dto["rule_origin"] = "test";
    // 最大分账比例%
    // $dto["apply_ratio"] = "test";
    // 生效类型
    // $dto["start_type"] = "test";
    // 分账模式
    // $dto["scene"] = "test";
    // 分账明细
    // $dto["acct_split_bunch_list"] = getD4a604bdA6a348188210A011795c1145();
    // 手续费外扣开关
    // $dto["out_fee_flag"] = "";
    // 手续费外扣时的账户类型
    // $dto["out_fee_acct_type"] = "";
    // 手续费外扣汇付ID
    // $dto["out_fee_huifuid"] = "";
    // 手续费%
    // $dto["split_fee_rate"] = "";
    // 固定手续费
    // $dto["per_amt"] = "";
    // 业务情况说明
    // $dto["split_ext_info"] = getF0acb9057f8a4a2b926c02f4bdcafc0e();

    return json_encode($dto,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
}

function get2e5e45c578f5456b8e798fc0c3bc9a3d() {
    $dto = array();
    // *文件id*
    // $dto["file_id"] = "test";
    // *文件类型*
    // $dto["file_type"] = "";

    $dtoList = array();
    array_push($dtoList, $dto);
    return json_encode($dtoList,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
}

function getFae873a3Ec5a42e597209188f140b998() {
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


