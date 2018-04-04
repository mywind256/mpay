<?php
namespace Pay;
/**
 * Created by PhpStorm.
 * User: yangdong
 * Date: 2018/4/4
 * Time: 上午11:34
 */
class RequestCheckUtil
{
    public static function checkEmpty($value)
    {
        if(!isset($value))
            return true ;
        if($value === null )
            return true;
        if(is_array($value) && count($value) == 0)
            return true;
        if(is_string($value) &&trim($value) === "")
            return true;

        return false;
    }

    public static function checkNotNull($value, $key)
    {
        if(self::checkEmpty($value)){
            throw new \Exception("client-check-error:Missing Required Arguments: " .$key , 40);
        }
    }
}