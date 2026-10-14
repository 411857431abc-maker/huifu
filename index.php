<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json; charset=utf-8');

$config = [
    'sys_id'               => '6666000248404988',
    'product_id'           => 'XLSISV',
    'huifu_id'             => '6666000248404988',
    'merchant_private_key' => 'MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCoK3XkjCRwGLeg8g0uGLQodWz2jR4DmAQIvCYtuelRydCZWwVTLSR58r7Jq0mb+5uNOcZDtMn34WrOnVXybMDCptagvVfw5AQPIcitKoOFSEDyaiW/BGH6RMoKHSSRb7K1UBCIpEAomrnU78ucSexODZFkncKZJ8k7gt4sUxm2wBndGW4+0BySd7eps91q/nyxY2zFQt89uTOAfVApw7NAQ8LiFHKJvQjkLl+YtrudWyJVBaiRpsNVi8Bondc3FkdsKsupuZPrtbfZD8gobijNljY95S7TumMf7WL0Wtc0V2ZX+ChOtlDtDl6envdjRRV4nlTTMFwgtrEuw5LYE7lhAgMBAAECggEALJWxINGiy3FSJcJmiiUUhnFzXP5Wyb8guqwfNxpF6GAoBLBj/gRG2mnn+RGHZ2pSeCOsE8E3lpdVuMdvxODeTfzrhBwO15esF9LuIDLYQZrBVUOdFEJ2M2LPadUGH+TMLVO3vnJFbD5xLCoTAjF7C8p/FHza3b31lOiCPKAffhqLNOmWdm1gtGskw0B4CRyPlenV1RNEj1sGd7AqC38XZuGIgd3/StKXWyPhbEB5NUcnMT5DvHGRIXyzRwZIYlDXJB3hUnsZhPng+Q+jqlQgWp5qwDTnZDWPs/86I+tgkZnrwwBGTPC6qjbquFg+4oTw+JP520imSGAA4zqg8VdpvQKBgQDpqcOj3RHaFXtDEJ9yR12xXXMBXCs0QCsmG6//RydTF8Rh2OYqboDfCNjVff1WYKOiaQWol73DPaCZCRocexHSuCgU+SzIpeT91704pVeatSkUoD52dMuWMhbMoak/amYHd/yRnfdpymOYOC6kmudXaTp6IEz1khXxwz9XdKMy7wKBgQC4Pu8ERU8t948ZMsPGr8Cq/rKk+hJauedA4L+O+n4KSjlnBtDhtYO1UPcleHKQMJ1xgaE/P1xjGpZ/LQsCYEvOFEBly7K7zRSirrN0RQwN9Y4DASdd9mWo0q9RzwKQEZJJt+Q7KSorvKQ/tupUqEdLrIMgtcTGgNzBMwjClhqYrwKBgB4I3ETr3aeSq01rjZM66SgrQuUh28vTk7hKRs0hcESWAYAySSObIKWKlZSbpTy9H0t5BGkvWA0IluQU725Jw3i6gyxu+vqvmEeou4HUfvY74xPrpRvE14Zu2c9j2EV2f7bmDWkKTQskILkoP5aY8rOhqwqXrEzEgl2ZI0MykuexAoGAFSTbxzCxCoRrfqfNweJviPAbzkUIkDLfcBmawizLBCFKfyFQHWb4S3mUM0+kThnWJ62JtLlvv8vQU532snocmPTIAyaiR10criLAY2p9HKj+eCfMvcLGHd630fqgv6nUkPMylPt/ZG+Mpec28yowrGWK0tkpUOJ+8wkJS1Nwj+8CgYEA47sz2gnt0yRxKG6IQuqKV86hA0sYCU/pRDUrCmG0Wo/09D+tBRt80wad0V3KsPm3hYG9SlflZwr8IMT2+TiT4hxJqepZ+8yOFqeRneRmqntLjfddM9PZz1DDb3wa8xj5U+VLkxymzMnTLT+7r5E8NCE0Dpd4Lnda5PGDmrpbB6g=',
    'huifu_public_key'     => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAmoePLzNiJ58rx2zyjQ/ZRHNvPYFaaHpmYTLah9ODJJ12d/I4rvTdYnSGNae+f+PdAwLF318WSSR1yioTnkaeC1dqdoN5vqrDEcbhlVPo6YNECoh21w9Aw/HW1LOLvHasv1xF6L3I6Hwk6cSrrbTfRKxV2JAIhYKRMIhdueHzGIst2d7vbDi5Isci0wNGm7whhVWrCW72PC7ArE2itmZMM3GUSoJpuCBtj8vA8kG2h5CnaIG1xxG6OhAw1x1c239mdnf0AyjVZRgdR287CGl7eye9cy9mpaos4EivLEBgTR0UGzLe8hIE2KCoiX4fB2SaG08AUFWr/E4M3B7EPEgcrwIDAQAB',
    'webhook_terminal_key' => '6f9a241bbfc044c4965b779c83d301f7',
    'api_base_url'         => 'https://api.huifu.com',
    'notify_url'           => 'https://web-production-60f26.up.railway.app',
];

function toPrivateKeyPem($key) {
    if (strpos($key, '-----BEGIN') !== false) return $key;
    return "-----BEGIN PRIVATE KEY-----\n" . wordwrap($key, 64, "\n", true) . "\n-----END PRIVATE KEY-----";
}
function toPublicKeyPem($key) {
    if (strpos($key, '-----BEGIN') !== false) return $key;
    return "-----BEGIN PUBLIC KEY-----\n" . wordwrap($key, 64, "\n", true) . "\n-----END PUBLIC KEY-----";
}
function rsaSign($data, $privateKeyBase64) {
    $res = openssl_pkey_get_private(toPrivateKeyPem($privateKeyBase64));
    if (!$res) throw new Exception('商户私钥无法加载');
    openssl_sign($data, $signature, $res, OPENSSL_ALGO_SHA256);
    return base64_encode($signature);
}
function buildApiParams($bizParams, $config) {
    $params = array_merge($bizParams, [
        'sys_id'     => $config['sys_id'],
        'product_id' => $config['product_id'],
        'data'       => date('YmdHis'),
    ]);
    ksort($params);
    $signParts = [];
    foreach ($params as $k => $v) {
        if ($v === '' || $v === null) continue;
        $signParts[] = $k . '=' . $v;
    }
    $params['sign'] = rsaSign(implode('&', $signParts), $config['merchant_private_key']);
    return $params;
}

$action = $_GET['action'] ?? '';

if ($action === 'pay') {
    try {
        // 支付宝 JS 支付参数（先尽量简单，看汇付返回什么）
        $bizParams = [
            'req_seq_id' => 'TEST_' . time(),
            'req_date'   => date('Ymd'),
            'huifu_id'   => $config['huifu_id'],
            'trans_amt'  => '100', // 1元 = 100分
            'goods_desc' => '测试商品',
            'notify_url' => $config['notify_url'],
            // 支付宝 JS 支付必填参数（如果没有，汇付会返回错误提示）
            // 'alipay_data' => json_encode([
            //     'buyer_id' => '支付宝用户ID',
            //     'sub_appid' => '支付宝小程序AppID',
            // ]),
        ];

        $params = buildApiParams($bizParams, $config);

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => $config['api_base_url'] . '/v2/trade/payment/jspay',
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => json_encode($params),
            CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 30,
        ]);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlErr  = curl_error($ch);
        $curlInfo = curl_getinfo($ch);
        curl_close($ch);

        echo json_encode([
            'status'         => 'success',
            'http_code'      => $httpCode,
            'curl_err'       => $curlErr,
            'raw_response'   => $response,       // 汇付返回的原始内容
            'curl_info'      => $curlInfo,       // 请求详情
            'request_params' => $params,         // 发出的参数（核对签名用）
        ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

    } catch (Throwable $e) {
        echo json_encode([
            'status'  => 'error',
            'message' => $e->getMessage(),
        ], JSON_UNESCAPED_UNICODE);
    }
    exit;
}

// 接收 Webhook 通知（保留原逻辑）
$rawBody = file_get_contents('php://input');
file_put_contents('php://stderr', "[Webhook] 收到消息: " . $rawBody . "\n");
$data = json_decode($rawBody, true);
if (!is_array($data)) {
    http_response_code(400);
    echo json_encode(['status'=>'error','message'=>'invalid json']);
    exit;
}
$eventDefineNo = $data['eventDefineNo'] ?? $data['event_define_no'] ?? '';
file_put_contents('php://stderr', "[Webhook] 事件类型: " . $eventDefineNo . "\n");
http_response_code(200);
echo json_encode(['status'=>'ok']);
