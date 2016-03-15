<?php

namespace Cassowary\Adapter;

class ArrayAdapter implements AdapterInterface
{
    private static $hosts = [];

    public static function init(array $params)
    {
        // Nothing to do.
    }

    public static function getCount($host)
    {
        if (array_key_exists($host, self::$hosts)) {
            return self::$hosts[$host];
        };

        return 0;
    }

    public static function increment($host)
    {
        if (array_key_exists($host, self::$hosts)) {
            ++self::$hosts[$host];
        } else {
            self::$hosts[$host] = 1;
        };

        return self::$hosts[$host];
    }
}
