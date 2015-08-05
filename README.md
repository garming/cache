# PHP Cache Library
=======================

## Requirements

- php5.6+

## Installation

  - composer.json  
  ```
  "require":
        {
             "phpcachex/cache":  "dev-master"
        }
  ```

  - command  
  ```composer install``` or ```composer update```


## Introduction

- this is a php cache library,this version only contain ```Memcache```

## How to use Muticall

```
<?php
    $params = [
        [
            'host' => '127.0.0.1',
            'port' => 11211,
            'persistent' => 1,
        ]
    ];
    $instance = \PhpCacheX\Cache\Instance::get('Memcache',$params);
    $set = $instance->set('key','value');
    $rs = $instance->get('key');
?>
```
## License
MIT License see http://mit-license.org/
