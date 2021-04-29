<?php
namespace BsPaySdk;

use BsPaySdk\BsPay;

class BsPayClient extends BsPay{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 请求接口
     * @Author   kefeng.zheng
     * @DateTime 2021-04-25
     * @version  V1.0.0
     * @param    array
     * @return   array
     */
    public function postRequest($funcCode, $params=array(), $merChantKey = 'default'){
		# 风控信息要上送json字符串，如果上送的是对象，则将其转为json字符串
        if (array_key_exists("risk_check_info", $params) && isset($params['risk_check_info'])) {
			if (!is_string($params['risk_check_info'])) {
			    $params['risk_check_info'] = json_encode($params['risk_check_info']);
			}
		}
		# 请求接口获取应答
		$this->result = self::post($funcCode, $params, $merChantKey);
    }
}