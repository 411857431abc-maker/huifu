<?php
namespace BsPaySdk;

use BsPaySdk\config\MerConfig;
use BsPaySdk\utils\BsPayRequests;
use BsPaySdk\utils\BsPayTools;

class BsPay
{

    # 汇付固定公钥，当未配置汇付侧发送数据的公私钥时，将默认使用此公钥验签
    const HUIFU_DEFAULT_PUBLIC_KEY = "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAtEqXg6GQ5uQJdjFJC31FW/tvNNvNNFGGo2TH2+Lu2MCejINLcydesLr7MzvkcYybedh9nFv3xq71HdLj2joSE7df/weSh0o8HXHJzNTyHTEGhkIAtu48cbNZKL64fZlo6+EzqHhBI2wfr0Jx3Gj7UTkPn4tJ0T0j7u6NtQ2tC8TBGxp/uVhScvTvqHXWlnwLPXmV+58lj5KK5HPvD8qmYIZQUtaJ1S2Urlt+iQ24yRYpSdcF19aVp/fB5u9lGIszhu051EKgrjvubZ8r/XCC0Ku+Ek3zFoH+3QGd3yL6XGunXYrnwPAam8hqdimzHzgnK7EEFrEc0RKxi1s9ZFDzEwIDAQAB";
    # 调试模式
    public static $isDebug;
    // 生产模式
	public static $isProdMode;
	// 日志路径
    public static $logDir = "";
    // 生产环境接口基础地址
	public static $apiBase = "https://spin.cloudpnr.com";
	// 集成环境接口基础地址
	public static $apiBaseMock = "https://spin-test.cloudpnr.com";

    private $bs_request = "";
    public $result = array();

    // 商户配置信息
    private static $merConfigMap = array();
       
    public function __construct()
    {
        $this->bs_request = new BsPayRequests();
    }

    public static function init($config_info, $is_object=false, $merchantKey = 'default'){

        if (empty($config_info)){
            try {
                throw new \Exception('缺少SDK配置信息');
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }

        if ($is_object){
            $config_obj = $config_info;
        }else{
            if (!file_exists($config_info)){
                try {
                    throw new \Exception('SDK配置文件不存在');
                } catch (\Exception $e) {
                    echo $e->getMessage();
                }
            }
            $cfg_file_str = file_get_contents($config_info);
            $config_obj = json_decode($cfg_file_str,  true);
        }

        // 是否调试模式
        self::$isDebug = defined("DEBUG") ? DEBUG: false;
        // 日志路径
        self::$logDir = defined("DEBUG") ? LOG: dirname(__FILE__)."/log";
        // 是否生产模式
        self::$isProdMode = defined("PROD_MODE") ? PROD_MODE : false;

        $merConfig = new MerConfig();
        $merConfig->product_id = isset($config_obj['product_id']) ? $config_obj['product_id'] : '';
        $merConfig->sys_id = isset($config_obj['sys_id']) ? $config_obj['sys_id'] : '';
        $merConfig->rsa_private_key = isset($config_obj['rsa_private_key']) ? $config_obj['rsa_private_key'] : '';
        $merConfig->rsa_public_key = isset($config_obj['rsa_public_key']) ? $config_obj['rsa_public_key'] : '';
        
        self::addMerConfig($merchantKey, $merConfig);
    }

    protected function do_empty_data($req_params){
        $req_params = array_filter($req_params, function($v){
            if (!empty($v) || $v == '0') {
                return true;
            }
            return false;
        });
        return $req_params;
    }

    public static function writeLog($message, $level = "INFO"){
        if (self::$isDebug){
            if (!is_dir(self::$logDir)){
                mkdir(self::$logDir, 0777, true);
            }

            $log_file = self::$logDir."/bspay_".date("Ymd").".log";
            $server_addr = "127.0.0.1";
            if (isset($_SERVER["REMOTE_ADDR"])){
                $server_addr = $_SERVER["REMOTE_ADDR"];
            }
            $message_format = "[". $level ."] [".gmdate("Y-m-d\TH:i:s\Z")."] ". $server_addr." ". $message. "\n";
            $fp = fopen($log_file, "a+");
            fwrite($fp, $message_format);
            fclose($fp);
        }
    }

    public function isError(){
        if (empty( $this->result )){
            return true;
        }
        $this->result = $this->result[1];
    }
    
    /**
     * 根据功能编码获取实际请求路径
     * @param $funcCode
     * @return $req_url
     */
    public function getRequestUrl($funcCode) {
        // 判断请求环境确定接口域名地址
        $req_url = '';
        if (self::$isProdMode) {
            $req_url =  self::$apiBase;
        } else {
            $req_url =  self::$apiBaseMock;
        }
        // 如果末尾不是/结尾，则拼接/在最后
        if (!BsPayTools::endWith($req_url, "/")) {
            $req_url = $req_url . "/";
        }
        
        # 根据功能编码获取实际接口请求地址
        $actualUrl = str_replace(".", "/", $funcCode);
        # 拼接得到完整请求地址
        $req_url = $req_url . $actualUrl;
        return $req_url;
    }
    
    public function post($funcCode, $params=array(), $merchantKey){
        # 获取商户配置信息
        $merchantConfig = self::getConfig($merchantKey);
        # 根据功能编码获取实际请求路径
        $req_url = $this->getRequestUrl($funcCode);
        $request_params = $this->do_empty_data($params);
        # 获取请求头
        $header =  array('Content-Type:application/json');
        # 请求
        return $this->bs_request->curl_request($merchantConfig, $req_url, $request_params, $header, true);
    }
    
    public function get($funcCode, $params=array(), $merchantKey){
        ksort($params);
        # 获取商户配置信息
        $merchantConfig = $this->getConfig($merchantKey);
        # 根据功能编码获取实际请求路径
        $req_url = $this->getRequestUrl($funcCode);
        $request_params = $this->do_empty_data($params);
        # 获取请求头
        $header =  array('Content-Type:text/html');       
        return $this->bs_request->curl_request($merchantConfig, $req_url . "?" . http_build_query($request_params), "", $header, false);
    }
   
    protected static function addMerConfig($merchantKey, MerConfig $merConfig) {
        self::$merConfigMap[$merchantKey] = $merConfig;
    }
    
    public static function getConfig($merChantKey)
    {
        if (empty($merChantKey)) {
            return array();
        }
        return isset(self::$merConfigMap[$merChantKey]) ? self::$merConfigMap[$merChantKey] : array();
    }
}