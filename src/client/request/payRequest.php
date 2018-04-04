<?php
namespace Pay\request;
/**
 * Created by PhpStorm.
 * User: yangdong
 * Date: 2018/4/4
 * Time: 上午11:22
 */
class PayRequest
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

    public function getApiUrlName()
    {
        return "/pay";
    }

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
        RequestCheckUtil::checkNotNull($this->reqid, "reqid");
    }

    public function putOtherTextParam($key, $value) {
        $this->apiParas[$key] = $value;
        $this->$key = $value;
    }
}