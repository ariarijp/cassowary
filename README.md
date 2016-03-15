# Cassowary
Simple rate-limit firewall.

## Installation
Add these lines to your `composer.json`.

```json
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/ariarijp/cassowary.git"
    }
],
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
    'index' => 9999,
    'duration' => 10,
]);

while (1) {
    Cassowary\Cassowary::kick(CASSOWARY_THRESHOLD, $_SERVER['REMOTE_HOST'], Cassowary\Adapter\RedisAdapter::class, function($host, $count) {
        header('HTTP/1.1 403 Forbidden');
        exit;
    });
}
```

## License
MIT

## Author
[ariarijp](https://github.com/ariarijp)