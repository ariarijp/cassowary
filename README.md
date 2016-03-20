# Cassowary
Simple rate-limit firewall.

## Installation
Add these lines to your `composer.json`.

```json
"require": {
    "ariarijp/cassowary": "dev-master"
}
```

## Usage

```php
<?php

require_once __DIR__.'/vendor/autoload.php';

define('CASSOWARY_THRESHOLD', 100);

Cassowary\Adapter\RedisAdapter::init([
    'host' => 'localhost',
    'port' => 6379,
    'prefix' => 'cassowary_',
    'index' => 9,
    'duration' => 10,
]);

Cassowary\Cassowary::kick(CASSOWARY_THRESHOLD, $_SERVER['REMOTE_ADDR'], Cassowary\Adapter\RedisAdapter::class, function($host, $count) {
    header('HTTP/1.1 403 Forbidden');
    exit;
});
```

## License
MIT

## Author
[ariarijp](https://github.com/ariarijp)
