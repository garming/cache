<?php
/**
 * Created by PhpStorm.
 * User: garming
 * Date: 8/5/15
 * Time: 17:33
 */
require '../../vendor/autoload.php';
$params = [
    [
        'host' => '127.0.0.1',
        'port' => 11211,
        'persistent' => 1,
    ]
];
$instance = \PhpCacheX\Cache\Instance::get('Memcache',$params);
$set = $instance->set('sss','fffff');
$rs = $instance->get('sss');