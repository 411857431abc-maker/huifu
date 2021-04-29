<?php
namespace BsPaySdk\utils;

class BsPayTools
{
    public static function sha_with_rsa_sign($rsaPrivateKey, $data, $alg = ''){
        $key = "-----BEGIN PRIVATE KEY-----\n".wordwrap($rsaPrivateKey, 64, "\n", true)."\n-----END PRIVATE KEY-----";
        $signature= '';
        try {
            // $alg sha256: OPENSSL_ALGO_SHA256, sha1: OPENSSL_ALGO_SHA1 md5:OPENSSL_ALGO_MD5
            if (empty($alg)){
                $alg = OPENSSL_ALGO_SHA256;
            }
            openssl_sign($data, $signature, $key, $alg);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        return base64_encode($signature);
    }
  
    public static function verifySign($rsaPublicKey, $signature, $data, $alg= ''){
        if (empty($alg)) {
            $alg = OPENSSL_ALGO_SHA256;
        }
        $key = "-----BEGIN PUBLIC KEY-----\n".wordwrap($rsaPublicKey, 64, "\n", true)."\n-----END PUBLIC KEY-----";
        if (openssl_verify($data, base64_decode($signature), $key, $alg)){
            return true;
        }else{
            return false;
        }
    }

    public static function checkEmpty($value) {
        if (!isset($value))
            return true;
        if ($value === null)
            return true;
        if (trim($value) === "")
            return true;
        return false;
    }
    
    public static function endWith($str, $suffix) {
        $length = strlen($suffix);
        if($length == 0){
            return false;
        }
        return (substr($str, -$length) === $suffix);
    }
}