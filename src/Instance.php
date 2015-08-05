<?php
/**
 * Created by PhpStorm.
 * User: garming
 * Date: 8/5/15
 * Time: 16:53
 */

namespace PhpCacheX\Cache;


use PhpCacheX\Cache\Lib\EmpFunc;

class Instance
{
    private function __construct(){}

    public function __clone(){}

    public static function get($driver_type,$params = array())
    {
        if(empty($driver_type)){
            return new EmpFunc();
        }
        if(class_exists('PhpCacheX\\Cache\\Lib\\'.$driver_type)){
            $class = '\\PhpCacheX\\Cache\\Lib\\'.$driver_type;
            $obj = $class::connect($params);
            return $obj;
        }
        return new EmpFunc();
    }
}