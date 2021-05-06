<?php
namespace BsPayDemo;

use BsPaySdk\BsPayClient;
 use BsPayDemo\constants\DemoConstants;

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

 $query_params = array(
     "huifu_id"=> DemoConstants::DEMO_HUIFU_ID,
     "req_date"=> "20210506",
     // 以下指定原交易的唯一标识，支持5选1，可根据req_seq_id、party_order_id、out_trans_id、out_ord_id、hf_seq_id其中之一定位原交易
     // 原始请求流水号
     // "req_seq_id"=> "2021050609311601234567890",
     // "out_trans_id" => "722021050622001465461444012871",
     "party_order_id" => "03242105063840898400756",
     // "out_ord_id" => "",
     // "hf_seq_id" => "002900TOP2A210506093117P359ac132fcd00000",
     "sys_id"=> DemoConstants::DEMO_SYS_ID
 );
 

 $trans = new BsPayClient();
 
 # 请求交易查询接口
 $trans->postRequest("topqur.transQuery", $query_params);
 # 如有多套配置，可指定使用哪套配置，指定merchanKey为初始化时设置的。
 #$trans->postRequest($query_params, "topqur.transQuery", "merchantKey2");
 # 对查询结果进行处理
 if ($trans->isError()){
     //失败处理
     var_dump($trans->result);
 } else {
     //成功处理
     var_dump($trans->result);
 }
 ?>