<?php
/**
 * 支付回调
 * User: yangdong
 * Date: 2018/4/4
 * Time: 下午4:35
 */

namespace Pay\request;

use Pay\RequestCheckUtil;


class PayCallbackRequest
{
    /**
     * @sting required 商户ID
     **/
    private $merid;
    /**
     * @string required 商户单号
     */
    private $reqid;
    /**
     * @string required 交易金额(元,保留两位小数)
     */
    private $money;
    /**
     * @string required 平台流水
     */
    private $payid;
    /**
     * @string required 交易状态，0-支付成功，4-支付失败
     */
    private $status;

    private $apiParas = [];

    public function setMerId($merid)
    {
        $this->merid = $merid;
        $this->apiParas['merid'] = $merid;
    }

    public function getMerId()
    {
        return $this->merid;
    }

    public function setReqid($reqid)
    {
        $this->reqid = $reqid;
        $this->apiParas['reqid'] = $reqid;
    }

    public function getReqid()
    {
        return $this->reqid;
    }
    /**
     * @return mixed
     */
    public function getMoney()
    {
        return $this->money;
    }
    /**
     * @param mixed $money
     */
    public function setMoney($money)
    {
        $this->money = $money;
        $this->apiParas['money'] = $money;
    }
    /**
     * @return mixed
     */
    public function getPayid()
    {
        return $this->payid;
    }
    /**
     * @param mixed $payid
     */
    public function setPayid($payid)
    {
        $this->payid = $payid;
        $this->apiParas['payid'] = $payid;
    }
    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }
    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->$status = $status;
        $this->apiParas['status'] = $status;
    }

    public function getApiParas()
    {
        return $this->apiParas;
    }

    public function check()
    {
        RequestCheckUtil::checkNotNull($this->merid, "merid");
        RequestCheckUtil::checkNotNull($this->reqid, "reqid");
        RequestCheckUtil::checkNotNull($this->payid, "payid");
        RequestCheckUtil::checkNotNull($this->money, "money");
        RequestCheckUtil::checkNotNull($this->status, "status");
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->$key = $value;
    }
}