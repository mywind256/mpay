<?php
namespace Pay;
/**
 * Created by PhpStorm.
 * User: yangdong
 * Date: 2018/4/4
 * Time: 上午11:25
 */

class Client
{
    public $key;

    public $gatewayUrl;//请求接口地址

    public $checkRequest = true; //参数验证开关

    public $connectTimeout;

    public $readTimeout;

    public function __construct($key, $gatewayUrl)
    {
        $this->key = $key;
        $this->key = $gatewayUrl;
    }

    /**
     * 签名
     * @param $params
     * @return string
     */
    public function generateSign($params)
    {
        $signString = '';
        foreach ($params as $k=>$v) {
            $signString .= $k;
        }

        return md5($signString.$this->key);
    }

    /**
     * 执行请求
     * @param $request
     * @return mixed|Result
     */
    public function execute($request)
    {
        $result =  new Result();
        if($this->checkRequest) {
            try {
                $request->check();
            } catch (\Exception $e) {
                $result->code = $e->getCode();
                $result->msg = $e->getMessage();
                return $result;
            }
        }
        //获取业务参数
        $apiParams = $request->getApiParas();
        //签名
        $sysParams["sign"] = $this->generateSign($apiParams);
        //发起HTTP请求
        try{
            $resp = $this->curl($this->gatewayUrl, $apiParams);
        }catch (\Exception $e){
            $result->code = $e->getCode();
            $result->msg = $e->getMessage();
            return $result;
        }

        return $resp;
    }

    /**
     * 请求
     * @param $url
     * @param null $postFields
     * @return mixed
     * @throws \Exception
     */
    public function curl($url, $postFields = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($this->readTimeout) {
            curl_setopt($ch, CURLOPT_TIMEOUT, $this->readTimeout);
        }
        if ($this->connectTimeout) {
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->connectTimeout);
        }
        curl_setopt ( $ch, CURLOPT_USERAGENT, "pay-sdk" );
        //https 请求
        if(strlen($url) > 5 && strtolower(substr($url,0,5)) == "https" ) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }

        if (is_array($postFields) && 0 < count($postFields))
        {
            $postBodyString = "";
            $postMultipart = false;
            foreach ($postFields as $k => $v)
            {
                if("@" != substr($v, 0, 1))//判断是不是文件上传
                {
                    $postBodyString .= "$k=" . urlencode($v) . "&";
                }
                else//文件上传用multipart/form-data，否则用www-form-urlencoded
                {
                    $postMultipart = true;
                    if(class_exists('\CURLFile')){
                        $postFields[$k] = new \CURLFile(substr($v, 1));
                    }
                }
            }
            unset($k, $v);
            curl_setopt($ch, CURLOPT_POST, true);
            if ($postMultipart)
            {
                if (class_exists('\CURLFile')) {
                    curl_setopt($ch, CURLOPT_SAFE_UPLOAD, true);
                } else {
                    if (defined('CURLOPT_SAFE_UPLOAD')) {
                        curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
                    }
                }
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
            }
            else
            {
                $header = array("content-type: application/x-www-form-urlencoded; charset=UTF-8");
                curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
                curl_setopt($ch, CURLOPT_POSTFIELDS, substr($postBodyString,0,-1));
            }
        }
        $response = curl_exec($ch);

        if (curl_errno($ch))
        {
            throw new \Exception(curl_error($ch),0);
        }
        else
        {
            $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if (200 !== $httpStatusCode)
            {
                throw new \Exception($response,$httpStatusCode);
            }
        }
        curl_close($ch);
        return $response;
    }

}