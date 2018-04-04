<?php
/**
 * Created by PhpStorm.
 * User: yangdong
 * Date: 2018/4/4
 * Time: 上午11:11
 */

class Autoloader
{
    public static function autoload($class)
    {
        $name = $class;
        if (false !== strpos($name, '\\')) {
            $name = strstr($class, '\\', true);
        }

        $fileName = dirname(__FILE__)."/client/".$name.".php";
        if (is_file($fileName)) {
            include $fileName;
            return;
        }

        $fileName = dirname(__FILE__)."/client/request/".$name.".php";
        if (is_file($fileName)) {
            include $fileName;
            return;
        }

        $fileName = dirname(__FILE__)."/client/domain/".$name.".php";
        if (is_file($fileName)) {
            include $fileName;
            return;
        }
    }
}

spl_autoload_register('Autoloader::autoload');


