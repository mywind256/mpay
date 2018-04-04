<?php
/**
 * 余额查询
 * User: yangdong
 * Date: 2018/4/4
 * Time: 下午4:41
 */
namespace Pay\request;

use Pay\RequestCheckUtil;

class BalanceQueryRequest
{
    /**
     * @sting required 商户ID
     **/
    private $merid;

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

    public function getApiParas()
    {
        return $this->apiParas;
    }

    public function check()
    {
        RequestCheckUtil::checkNotNull($this->merid, "merid");
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->$key = $value;
    }
}