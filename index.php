<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json; charset=utf-8');

// ==================== 商户配置（已更新为新商户） ====================
$config = [
    'sys_id'               => '6666000248448927',
    'product_id'           => 'XLSISV',
    'huifu_id'             => '6666000248448927',
    // 新商户私钥（PKCS#8 格式，已去除头尾和换行）
    'merchant_private_key' => 'MIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQCaEYzE/juK8btoLbhnc7X/mqGDwfAFCXYUE8PA3jaxKpqj+rPgNW0b1xofXYATWjr8Len/5shn0C8wAJpJ+wt98IJFtZO+yMBy/SmdE9LN9jOQWtyHS51usKkgGZWOjB0onxXuuz/RE1xXGjBKxQINgcr5jxy0GXHGOL4hsWi9HQuMr+w8Mkp3QbwSF4yseASPzpu2dNGgNeHlUFTQ20NjgSRKbBpo5QKSDXL7iR5xTmc9pjiD7L61+xSfiP7N4y34aN6IYLWiHO7Ayt6hH/DFqNKF+2z8D4bccW9O4IDiyCouK1hi7tjc13qBSmNRKZ6GUMDr5dAViVkPAb5qhOlrAgMBAAECggEAfCr8up7yue5MTY/beHTHDzM+TIP2vvh7E39CWqQ8i9h8PQAGDALC5pcbVH/0gqRLuYX/euAyT4h3H0a9EjajcmJte2T1p+L/Ry1FZnTdhmSP9h1kch28ycLS6y3zXKkLrvtXn8mFiykBWKmglgHkv6IFRc/TIEsJaOm+QkVK1m3b+sAsRuQcA/P+71I3xHNDftziRZw2ZBIWHjDanQH3oAapqszSeNXlTufYPik6lmbq5AQ2BSFoYCsqkChm8dsu1a8rcVzSpyFH/roU+6ZchfDEv+0Uuz0YqhCdrVxW05LHYfiCvZ8cieVk5yOaBQTM8zKCmro7ovVLRergSNAF8QKBgQDK1xdK3RD7ptB7vG6PADarwCErlvDhL4KRksTZl5SU56TplvwjN3yDaxTaprYu9/XMX5ml85khX9nWMKVbRCFcXraVU1yPAMmd3d3w3u+3ez9CeSkWpu/1A3LiYeXtqOayqJ4uh4xeVn41DKQ65U5Qc0WzG/TFul9Hv6KO4w7vxQKBgQDCckhcoPBDYpWC0SvUqlmto8/TWtGiSd2E4VFxBFiLP1TlxIPmOJbjzq9ub2+F9dMqVrra0Fiq2fnCDpjspX/v7/XYaLYT+tPPSrIg3WbTzmUhHMc5oMYFJe0/oOcg8qnNHPURAu+AU5BdwU3aSZDx7Sm3SlHtR27mtdBRx0NXbwKBgBuh8aphM08VCpHQub8BaHE9W0d06JvEvSTXublqzPL8G5s21mJ1zKCaldyzmV4MqY+N9oCFDvdc93AWcHBed6z9uiHdmV5h3RWEhBesRzvXrmZ/2vkbBNV8AsqUS550w/jSv7nW/WhcoBTaBAWB94k+KuCbjlzhZtl/YcXVaNOBAoGAHaVe8wB2oU9+jBtoG1x9n8PCA+9s1tl8NK5FxH1tIo3dW8rCcW9fUgxJIwVKc5ovP91JT+NEIYhqU/P1zN7Oyr5DNWOBnzo24Pv6fJhE/TYSpSHGHjss9cv6iCD4HEXjLaqkkptn+KDE+gZm4EknGDuYiKGELDEf73z47f77fXECgYBFf7uzHPUKTR8cfghE6aQZP704TCDmLqAMMP0MAFvcJ197CaCQETqe4oM7F4H97n5IJo2WPZLc5wDm/195IGEpaiy0G/QP7Q9mTiwN/Mtj1QUDqB0ER3OpQADH0adhR3Jo2YqWeBhF3dIxM5NRampmWBExsiO8j96KVjuC4yPldA==',
    // 新汇付公钥
    'huifu_public_key'     => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAjrBPkzfOoJ/nf/jlaWUWRZapR9VmpHHLE97ZWbxrp9DhIeckniuHq1e2kFPBzPIXDOeUGiodbUwWRyQcfykxkljk0dVRRQcCdiXituiEgXUR2fhjf9c6wkDqYBwnERu5Xk60lnbgXfhT5Y9roTw7z8euDRAZkgOV5YuAuO5uW0u2BE3XADpTC1YKq5ttXEukVLUl8gUfUVK4b3h8Mim9DyzYVdXj2IZXAxdi1LpIS2Of+21lTnxEy1A3ZFYR511lIdD2W/JZAb50Kele/cCHxgitU3ADkRvExap6K/5a5r0Vq20pZW1dm7qcR2FDxXoEy5rV0ZaI3QA3aLLms9eQ9wIDAQAB',
    // Webhook 终端密钥（如果新商户没有单独设置，可以保留原来的，或联系汇付获取）
    'webhook_terminal_key' => 'NyPt4yX4Iu7I1mvLPKCORbOfKZBV9893',
    'api_base_url'         => 'https://api.huifu.com',
    'notify_url'           => 'https://web-production-60f26.up.railway.app',
];

// ==================== 工具函数 ====================

function toPrivateKeyPem($key) {
    if (strpos($key, '-----BEGIN') !== false) return $key;
    return "-----BEGIN PRIVATE KEY-----\n" . wordwrap($key, 64, "\n", true) . "\n-----END PRIVATE KEY-----";
}

function rsaSign($data, $privateKeyBase64) {
    $res = openssl_pkey_get_private(toPrivateKeyPem($privateKeyBase64));
    if (!$res) throw new Exception('商户私钥无法加载');
    openssl_sign($data, $signature, $res, OPENSSL_ALGO_SHA256);
    return base64_encode($signature);
}

/**
 * 构建斗拱 API 请求
 * - data 是 JSON 对象
 * - 签名对象是 data 第一层字段，按 ASCII 字典序排序
 */
function buildApiParams($bizParams, $config) {
    // 1. 按 ASCII 字典序排序
    ksort($bizParams);

    // 2. 拼接签名串
    $signParts = [];
    foreach ($bizParams as $k => $v) {
        if ($v === '' || $v === null) continue;
        if (is_array($v)) $v = json_encode($v, JSON_UNESCAPED_UNICODE);
        $signParts[] = $k . '=' . $v;
    }
    $signStr = implode('&', $signParts);

    // 3. 生成签名
    $sign = rsaSign($signStr, $config['merchant_private_key']);

    // 4. 组装请求
    return [
        'sys_id'     => $config['sys_id'],
        'product_id' => $config['product_id'],
        'sign'       => $sign,
        'data'       => $bizParams,
    ];
}

function sendRequest($url, $params) {
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL            => $url,
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => json_encode($params, JSON_UNESCAPED_UNICODE),
        CURLOPT_HTTPHEADER     => ['Content-Type: application/json; charset=utf-8'],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 30,
        CURLOPT_HEADER         => true,
    ]);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $curlErr  = curl_error($ch);
    curl_close($ch);

    $headers = substr($response, 0, $headerSize);
    $body    = substr($response, $headerSize);

    return [
        'http_code' => $httpCode,
        'curl_err'  => $curlErr,
        'headers'   => $headers,
        'raw'       => $body,
    ];
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
            'headers'        => $result['headers'],
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
            'headers'        => $result['headers'],
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
