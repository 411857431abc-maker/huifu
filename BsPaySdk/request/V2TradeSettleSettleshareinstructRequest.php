<?php

namespace BsPaySdk\request;

use BsPaySdk\enums\FunctionCodeEnum;

/**
 * 多方结算-发起
 *
 * @author sdk-generator
 * @Description
 */
class V2TradeSettleSettleshareinstructRequest extends BaseRequest
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
     * 出金方客户Id
     */
    private $huifuId;
    /**
     * 可分配金额
     */
    private $transAmt;
    /**
     * 分账信息
     */
    private $shareAccounts;

    public function getFunctionCode() {
        return FunctionCodeEnum::$V2_TRADE_SETTLE_SETTLESHAREINSTRUCT;
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

    public function getTransAmt() {
        return $this->transAmt;
    }

    public function setTransAmt($transAmt) {
        $this->transAmt = $transAmt;
    }

    public function getShareAccounts() {
        return $this->shareAccounts;
    }

    public function setShareAccounts($shareAccounts) {
        $this->shareAccounts = $shareAccounts;
    }

}
