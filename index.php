<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json; charset=utf-8');

// 引入SDK初始化文件
require_once dirname(__FILE__) . "/loader.php";

// 引入支付请求类（抖音支付用 V2TradePaymentJspayRequest）
require_once dirname(__FILE__) . "/BsPaySdk/request/V2TradePaymentJspayRequest.php";

use BsPaySdk\core\BsPayClient;
use BsPaySdk\request\V2TradePaymentJspayRequest;

$action = $_GET['action'] ?? '';

if ($action === 'pay') {
    try {
        $request = new V2TradePaymentJspayRequest();
        $request->setReqSeqId(date("YmdHis") . mt_rand());
        $request->setReqDate(date("Ymd"));
        $request->setHuifuId("6666000248404988");
        $request->setTransAmt("100"); // 1元 = 100分
        $request->setGoodsDesc("测试商品");
        $request->setNotifyUrl("https://web-production-60f26.up.railway.app");

        // 抖音支付特有参数（如果没有可以先注释掉）
        // $dyData = [
        //     'sub_appid' => '你的抖音小程序AppID',
        //     'busi_scene' => '抖音支付场景'
        // ];
        // $request->setDyData($dyData);

        $client = new BsPayClient();
        $result = $client->postRequest($request);

        if (!$result || $result->isError()) {
            echo json_encode([
                'status' => 'error',
                'message' => $result->getErrorInfo(),
            ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        } else {
            echo json_encode([
                'status' => 'success',
                'data' => $result,
            ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        }

    } catch (Throwable $e) {
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage(),
        ], JSON_UNESCAPED_UNICODE);
    }
    exit;
}

// 接收Webhook通知
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
