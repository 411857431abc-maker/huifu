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

// ==================== 密钥工具 ====================

function toPrivateKeyPem($key) {
    if (strpos($key, '-----BEGIN') !== false) return $key;
    return "-----BEGIN PRIVATE KEY-----\n" . wordwrap($key, 64, "\n", true) . "\n-----END PRIVATE KEY-----";
}

function toPublicKeyPem($key) {
    if (strpos($key, '-----BEGIN') !== false) return $key;
    return "-----BEGIN PUBLIC KEY-----\n" . wordwrap($key, 64, "\n", true) . "\n-----END PUBLIC KEY-----";
}

/**
 * RSA 加密（用于加密业务数据，不是签名）
 */
function rsaEncrypt($data, $publicKeyBase64) {
    $res = openssl_pkey_get_public(toPublicKeyPem($publicKeyBase64));
    if (!$res) throw new Exception('汇付公钥无法加载');
    $encrypted = '';
    // 分块加密，防止数据超过 RSA 单次加密上限
    $maxChunk = 245; // 2048位密钥用 PKCS1 padding 最多 245 字节
    $result = '';
    for ($i = 0; $i < strlen($data); $i += $maxChunk) {
        $chunk = substr($data, $i, $maxChunk);
        openssl_public_encrypt($chunk, $encrypted, $res, OPENSSL_PKCS1_PADDING);
        $result .= $encrypted;
    }
    return base64_encode($result);
}

/**
 * RSA 签名
 */
function rsaSign($data, $privateKeyBase64) {
    $res = openssl_pkey_get_private(toPrivateKeyPem($privateKeyBase64));
    if (!$res) throw new Exception('商户私钥无法加载');
    openssl_sign($data, $signature, $res, OPENSSL_ALGO_SHA256);
    return base64_encode($signature);
}

/**
 * 构建斗拱 API 请求（核心修正：data 字段必须加密业务 JSON）
 */
function buildApiParams($bizParams, $config) {
    // 1. 业务参数打包成 JSON
    $bizJson = json_encode($bizParams, JSON_UNESCAPED_UNICODE);

    // 2. 用汇付公钥加密业务 JSON，得到 data 字段
    $encryptedData = rsaEncrypt($bizJson, $config['huifu_public_key']);

    // 3. 组装外层参数
    $params = [
        'sys_id'     => $config['sys_id'],
        'product_id' => $config['product_id'],
        'data'       => $encryptedData,
    ];

    // 4. 签名（对 sys_id & product_id & data 拼接后签名）
    ksort($params);
    $signParts = [];
    foreach ($params as $k => $v) {
        $signParts[] = $k . '=' . $v;
    }
    $params['sign'] = rsaSign(implode('&', $signParts), $config['merchant_private_key']);

    return $params;
}

function sendRequest($url, $params) {
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL            => $url,
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => json_encode($params),
        CURLOPT_HTTPHEADER     => ['Content-Type: application/json; charset=utf-8'],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 30,
    ]);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlErr  = curl_error($ch);
    curl_close($ch);
    return ['http_code' => $httpCode, 'curl_err' => $curlErr, 'raw' => $response];
}

// ==================== 路由 ====================
$action = $_GET['action'] ?? '';

// ---------- 测试：商户信息查询 ----------
if ($action === 'test') {
    try {
        $bizParams = [
            'req_seq_id' => 'TEST_' . time(),
            'req_date'   => date('Ymd'),
            'huifu_id'   => $config['huifu_id'],
        ];
        $params = buildApiParams($bizParams, $config);
        $result = sendRequest($config['api_base_url'] . '/v2/merchant/basicdata/query', $params);

        echo json_encode([
            'status'         => 'success',
            'http_code'      => $result['http_code'],
            'curl_err'       => $result['curl_err'],
            'raw_response'   => $result['raw'],
            'request_params' => $params,
        ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    } catch (Throwable $e) {
        echo json_encode(['status'=>'error','message'=>$e->getMessage()], JSON_UNESCAPED_UNICODE);
    }
    exit;
}

// ---------- 发起支付 ----------
if ($action === 'pay') {
    try {
        $bizParams = [
            'req_seq_id' => 'TEST_' . time(),
            'req_date'   => date('Ymd'),
            'huifu_id'   => $config['huifu_id'],
            'trans_amt'  => '100',
            'goods_desc' => '测试商品',
            'notify_url' => $config['notify_url'],
        ];
        $params = buildApiParams($bizParams, $config);
        $result = sendRequest($config['api_base_url'] . '/v2/trade/payment/jspay', $params);

        echo json_encode([
            'status'         => 'success',
            'http_code'      => $result['http_code'],
            'curl_err'       => $result['curl_err'],
            'raw_response'   => $result['raw'],
            'request_params' => $params,
        ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    } catch (Throwable $e) {
        echo json_encode(['status'=>'error','message'=>$e->getMessage()], JSON_UNESCAPED_UNICODE);
    }
    exit;
}

// ---------- 接收 Webhook ----------
$rawBody = file_get_contents('php://input');
file_put_contents('php://stderr', "[Webhook] 收到消息: " . $rawBody . "\n");

$data = json_decode($rawBody, true);
if (!is_array($data)) {
    http_response_code(400);
    echo json_encode(['status'=>'error','message'=>'invalid json']);
    exit;
}

if (!empty($config['webhook_terminal_key'])) {
    $receivedSign = $data['sign'] ?? '';
    $checkData = $data;
    unset($checkData['sign']);
    ksort($checkData);
    $parts = [];
    foreach ($checkData as $k => $v) {
        if (is_array($v)) $v = json_encode($v);
        $parts[] = $k . '=' . $v;
    }
    $expectedSign = md5(implode('&', $parts) . '&key=' . $config['webhook_terminal_key']);
    if ($receivedSign !== $expectedSign) {
        file_put_contents('php://stderr', "[Webhook] 验签失败\n");
    }
}

$eventDefineNo = $data['eventDefineNo'] ?? $data['event_define_no'] ?? '';
file_put_contents('php://stderr', "[Webhook] 事件类型: " . $eventDefineNo . "\n");

http_response_code(200);
echo json_encode(['status'=>'ok']);
