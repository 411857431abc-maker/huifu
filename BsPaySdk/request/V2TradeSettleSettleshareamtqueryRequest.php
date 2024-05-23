<?php

namespace BsPaySdk\request;

use BsPaySdk\enums\FunctionCodeEnum;

/**
 * 多方结算-资金查询
 *
 * @author sdk-generator
 * @Description
 */
class V2TradeSettleSettleshareamtqueryRequest extends BaseRequest
{

    /**
     * 请求日期
     */
    private $reqDate;
    /**
     * 请求流水号
     */
    private $reqSeqId;
    /**
     * 操作者客户Id
     */
    private $operatorHuifuId;
    /**
     * 被查询者客户Id
     */
    private $huifuId;

    public function getFunctionCode() {
        return FunctionCodeEnum::$V2_TRADE_SETTLE_SETTLESHAREAMTQUERY;
    }


    public function getReqDate() {
        return $this->reqDate;
    }

    public function setReqDate($reqDate) {
        $this->reqDate = $reqDate;
    }

    public function getReqSeqId() {
        return $this->reqSeqId;
    }

    public function setReqSeqId($reqSeqId) {
        $this->reqSeqId = $reqSeqId;
    }

    public function getOperatorHuifuId() {
        return $this->operatorHuifuId;
    }

    public function setOperatorHuifuId($operatorHuifuId) {
        $this->operatorHuifuId = $operatorHuifuId;
    }

    public function getHuifuId() {
        return $this->huifuId;
    }

    public function setHuifuId($huifuId) {
        $this->huifuId = $huifuId;
    }

}
