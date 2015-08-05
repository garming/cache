<?php
/**
 * Created by PhpStorm.
 * User: garming
 * Date: 8/5/15
 * Time: 16:10
 */

namespace PhpCacheX\Cache;


interface CacheInterface
{
    /**
     * connect the cache system
     * @param array $config
     * @return mixed
     */
    public static function connect(array $config);

    /**
     * set the value
     * @param $key
     * @param $value
     * @param $expired
     * @param array $params
     * @return mixed
     */
    public function set($key, $value, $expired, array $params);

    /**
     * get the value by the key
     * @param $key
     * @return mixed
     */
    public function get($key);

    /**
     * del one cache by the key
     * @param $key
     * @return mixed
     */
    public function delete($key);

    /**
     * clean all cache
     * @return mixed
     */
    public function cleanAll();

    /**
     * get the cache key by the input string
     * @param $str
     * @return mixed
     */
    public function key($str);

    /**
     * close the connection
     * @return mixed
     */
    public function close();

    /**
     * get the cache system's status
     * @return mixed
     */
    public function stats();
}