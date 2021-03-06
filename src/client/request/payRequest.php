<?php
/**
 * 请求支付接口
 * User: yangdong
 * Date: 2018/4/4
 * Time: 上午11:22
 */

namespace Pay\request;

use Pay\RequestCheckUtil;

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
    /**
     * @string required 请求时间 格式 yyyymmddHHMISS
     */
    private $reqts;
    /**
     * @string required 参数 1-Alipay,2-AlipayH5,3-Weixin,4-WeixinH5
     */
    private $type;

    /**
     * @string required 商品名称
     */
    private $name;
    /**
     * @string required 交易金额(元,保留两位小数)
     */
    private $money;
    /**
     * @string required 结果通知地址
     */
    private $returl;

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
    public function getReqts()
    {
        return $this->reqts;
    }

    /**
     * @param mixed $reqts
     */
    public function setReqts($reqts)
    {
        $this->reqts = $reqts;
        $this->apiParas['reqts'] = $reqts;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
        $this->apiParas['type'] = $type;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
        $this->apiParas['name'] = $name;
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
    public function getReturl()
    {
        return $this->returl;
    }

    /**
     * @param mixed $returl
     */
    public function setReturl($returl)
    {
        $this->returl = $returl;
        $this->apiParas['returl'] = $returl;
    }

    public function getApiParas()
    {
        return $this->apiParas;
    }

    public function check()
    {
        RequestCheckUtil::checkNotNull($this->merid, "merid");
        RequestCheckUtil::checkNotNull($this->reqid, "reqid");
        RequestCheckUtil::checkNotNull($this->reqts, "reqts");
        RequestCheckUtil::checkNotNull($this->type, "type");
        RequestCheckUtil::checkNotNull($this->name, "name");
        RequestCheckUtil::checkNotNull($this->money, "money");
        RequestCheckUtil::checkNotNull($this->returl, "returl");
    }

    public function putOtherTextParam($key, $value) {
        $this->apiParas[$key] = $value;
        $this->$key = $value;
    }
}