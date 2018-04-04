<?php
/**
 * 提现查询
 * User: yangdong
 * Date: 2018/4/4
 * Time: 下午4:47
 */

namespace Pay\request;

use Pay\RequestCheckUtil;

class WithdrawQueryRequest
{
    /**
     * @sting required 商户ID
     **/
    private $merid;
    /**
     * @string required 商户单号
     */
    private $reqid;

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

    public function getApiParas()
    {
        return $this->apiParas;
    }

    public function check()
    {
        RequestCheckUtil::checkNotNull($this->merid, "merid");
        RequestCheckUtil::checkNotNull($this->reqid, "reqid");
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->$key = $value;
    }
}