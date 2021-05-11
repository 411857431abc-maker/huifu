<?php
namespace BsPaySdk;

class BsPayClient extends BsPay{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 请求接口
     * @param string $funcCode 接口功能编码
     * @param array 请求接口参数集合
     * @param string $merChantKey 商户配置名
     */
    public function postRequest($funcCode, $params=array(), $merChantKey = 'default'){
		# 风控信息要上送json字符串，如果上送的是对象，则将其转为json字符串
        if (array_key_exists("risk_check_info", $params) && isset($params['risk_check_info'])) {
			if (!is_string($params['risk_check_info'])) {
			    $params['risk_check_info'] = json_encode($params['risk_check_info']);
			}
		}
		# 请求接口获取应答
		$this->result = self::post($funcCode, $params, "", $merChantKey);
    }

    /**
     * 文件上传请求接口
     * @param string $funcCode 接口功能编码
     * @param array $params 请求接口参数集合
     * @param \CURLFile $file 待上传的文件
     * @param string $merChantKey 商户配置名
     */
    public function postFileRequest($funcCode, $params=array(), $file=null, $merChantKey = 'default'){
		# 请求接口获取应答
		$this->result = self::post($funcCode, $params, $file, $merChantKey);
    }
}