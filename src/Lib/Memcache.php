<?php
/**
 * Created by PhpStorm.
 * User: garming
 * Date: 8/5/15
 * Time: 16:52
 */

namespace PhpCacheX\Cache\Lib;


use PhpCacheX\Cache\CacheInterface;

class Memcache implements CacheInterface
{
    private static $__instance;
    protected $_connection;
    private static $__flag = TRUE;
    private $prefix = 'PhpCacheX_';
    private $_config;

    private function __construct($params){
        $this->_config = $params;
        if (class_exists('\\Memcached')) {
            $this->_connection = new \Memcached();
        }else{
            $this->_connection = new \Memcache();
        }
        if(empty($params)){
            self::$__flag = FALSE;
        }else{
            foreach($params as $k => $v){
                if(isset($v['prefix'])){
                    $this->prefix = $v['prefix'];
                }
                $this->_connection->addServer($v['host'], $v['port'], $v['persistent']);
            }
        }
    }
    public static function connect(array $params = array())
    {
        if (!(self::$__instance instanceof self))
        {
            self::$__instance = new self($params);
            if(!self::$__flag){
                return new EmpFunc();
            }
        }
        return self::$__instance;
    }
    public function __clone(){}

    public function set($key, $value,$ttl = 0,array $params = array())
    {
        $compressed = isset($params['compressed']) ? intval($params['compressed']) : 0;
        $key = $this->_key($key);
        $save = $this->_connection->set($key, $value, $compressed, $ttl);
        return $save;
    }

    public function get($key)
    {
        $key = $this->_key($key);
        $value = $this->_connection->get($key);
        return $value;
    }

    public function delete($key)
    {
        $key = $this->_key($key);
        $this->_connection->delete($key);
    }

    public function cleanAll()
    {
        $this->_connection->flush();
    }

    public function close()
    {
        $this->_connection->close();
    }

    public function stats()
    {
        return $this->_connection->getStats();
    }
    /**
     * Generates a safe key for use with cache engine storage engines.
     *
     * @param string $key the key passed over
     * @return mixed string $key or false
     */
    public function key($key) {
        $key = $this->_key($key);
        if (!$key) {
            throw new \InvalidArgumentException('An empty value is not valid as a cache key');
        }
        return $this->prefix . $key;

    }

    /**
     * Generates a safe key, taking account of the configured key prefix
     *
     * @param string $key the key passed over
     * @return mixed string $key or false
     * @throws \InvalidArgumentException If key's value is empty
     */
    private function _key($key) {
        if (empty($key)) {
            return false;
        }
        $key = preg_replace('/[\s]+/', '_', strtolower(trim(str_replace(array(DIRECTORY_SEPARATOR, '/', '.'), '_', strval($key)))));
        return $key;
    }
}