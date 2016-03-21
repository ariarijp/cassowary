<?php

namespace Cassowary\Adapter;

abstract class AbstractAdapter implements AdapterInterface
{
    const BLACKLIST_KEY = 'blacklist';

    /**
     * @var string
     */
    protected static $prefix = 'cassowary_';

    /**
     * @var int
     */
    protected static $ttl = 10;

    /**
     * @param array $params
     */
    public static function init(array $params)
    {
        if (array_key_exists('prefix', $params)) {
            self::$prefix = $params['prefix'];
        }

        if (array_key_exists('ttl', $params)) {
            self::$ttl = $params['ttl'];
        }
    }
}
