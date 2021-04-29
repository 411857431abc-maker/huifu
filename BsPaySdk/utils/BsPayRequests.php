<?php
namespace BsPaySdk\utils;
use BsPaySdk\BsPay;
use BsPaySdk\config\MerConfig;

class BsPayRequests {
    public function curl_request(MerConfig $merConfig, $url, $postFields = null, $headers=null, $is_json=false) {
        BsPay::writeLog("curl方法参数:". json_encode(func_get_args(), JSON_UNESCAPED_UNICODE), "INFO");
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        if (is_array($postFields) && 0 < count($postFields)) {
            curl_setopt($ch, CURLOPT_POST, true);
            if ($is_json) {
                $body = $this->get_request_body($merConfig, $postFields);
                $json_data =  json_encode($body);
                BsPay::writeLog("post-json请求参数:".  json_encode($body, JSON_UNESCAPED_UNICODE), "INFO");
                array_push($headers, "Content-Length:". strlen($json_data));
                curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
            }else{
                BsPay::writeLog("post-form请求参数:". json_encode($postFields, JSON_UNESCAPED_UNICODE), "INFO");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
            }
        }
        
        $headers = $this->get_request_header($merConfig, $headers);
        
        BsPay::writeLog("curl请求头:". json_encode($headers, JSON_UNESCAPED_UNICODE), "INFO");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        $statuCode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
        if (curl_errno($ch)) {
            BsPay::writeLog(curl_error($ch), "ERROR");
        }
        curl_close($ch);
        BsPay::writeLog("curl返回参数:". $statuCode .  $response, "INFO");
        
        $isError = false;
        $respObj = '';
        $resp_arr = json_decode($response, true);
        $resp_data = isset($resp_arr['data']) ? $resp_arr['data'] : '';
        $resp_sign = isset($resp_arr['sign']) ? $resp_arr['sign'] : '';
        $resp_data_decode = json_decode($resp_data, true);
        if ($resp_sign && $statuCode != 401){
            $rsa_public_key = $merConfig->rsa_public_key;
            if (BsPayTools::checkEmpty($rsa_public_key)) {
                $rsa_public_key = BsPay::HUIFU_DEFAULT_PUBLIC_KEY;
            }

            if (BsPayTools::verifySign($rsa_public_key, $resp_sign, $resp_data)){
                if ($statuCode != 200){
                    $isError= true;
                    $respObj = $resp_data_decode;
                } else {
                    $isError= false;
                    $respObj = $resp_data_decode;
                }
            } else {
                $isError= true;
                
                $respObj = [
                    'failure_code'=> 'resp_sign_verify_failed',
                    'failure_msg'=> '接口结果返回签名验证失败',
                    'status'=> 'failed'
                ];
            }
        }else{
            $isError= true;
            $respObj = $resp_arr;
        }
        return array($isError, $respObj);
    }

    function characet($data, $targetCharset) {

        if (!empty($data)) {
            $fileType = $this->postCharset;
            if (strcasecmp($fileType, $targetCharset) != 0) {
                $data = mb_convert_encoding($data, $targetCharset, $fileType);
            }
        }
        return $data;
    }
    
    /**
              *  拼装请求头信息
     * @param MerConfig $merChantConfig
     * @param array $header
     * @return array
     */
    protected function get_request_header(MerConfig $merChantConfig, $headers = array()){
        $result = $headers;
        if (empty($headers)){
            $result = array('Content-type: application/x-www-form-urlencoded');
        }
        
        $sdk_version = defined("SDK_VERSION") ? SDK_VERSION : "php#v1.0.0";
        array_push($result, 'sdk_version:' . $sdk_version);
        array_push($result, 'format:JSON');
        array_push($result, 'charset:UTF-8');
        array_push($result, 'version:1.0.0');
        array_push($result, 'product_id:' . $merChantConfig->product_id);
        return $result;
    }
    
    protected function get_request_body(MerConfig $merChantConfig, $post_data){
        $body = array();
        $body['sys_id'] = $merChantConfig->sys_id;
        $data = json_encode($post_data);
        $body['data'] = $data;
        #  执行签名
        $sign = BsPayTools::sha_with_rsa_sign($merChantConfig->rsa_private_key, $data);
        $body['sign'] = $sign;
        $body['sign_type'] = "RSA2";
        
        return $body;
    }
}