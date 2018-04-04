<?php
/**
 * 提现申请
 * User: yangdong
 * Date: 2018/4/4
 * Time: 下午4:43
 */
namespace Pay\request;

use Pay\RequestCheckUtil;

class WithdrawRequest
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
     * @string required 姓名
     */
    private $cdname;

    /**
     * @string required 卡号
     */
    private $cdno;
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
    public function getCdname()
    {
        return $this->cdname;
    }

    /**
     * @param mixed $cdname
     */
    public function setCdname($cdname)
    {
        $this->cdname = $cdname;
        $this->apiParas['cdname'] = $cdname;
    }

    /**
     * @return mixed
     */
    public function getCdno()
    {
        return $this->cdno;
    }

    /**
     * @param mixed $cdno
     */
    public function setCdno($cdno)
    {
        $this->cdno = $cdno;
        $this->apiParas['cdno'] = $cdno;
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
        RequestCheckUtil::checkNotNull($this->cdname, "cdname");
        RequestCheckUtil::checkNotNull($this->cdno, "cdno");
        RequestCheckUtil::checkNotNull($this->money, "money");
        RequestCheckUtil::checkNotNull($this->returl, "returl");
    }

    public function putOtherTextParam($key, $value) {
        $this->apiParas[$key] = $value;
        $this->$key = $value;
    }
}
