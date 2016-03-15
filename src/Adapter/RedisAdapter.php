<?php

namespace Cassowary\Adapter;

class RedisAdapter implements AdapterInterface
{
    /**
     * @var \Redis
     */
    private static $redis;

    /**
     * @var string
     */
    private static $prefix;

    /**
     * @var int
     */
    private static $duration;

    public static function init(array $params)
    {
        $redis = new \Redis();
        $redis->connect($params['host'], $params['port']);
        $redis->select($params['index']);
        self::$redis = $redis;
        self::$prefix = $params['prefix'];
        self::$duration = $params['duration'];
    }

    public static function getCount($host)
    {
        return self::$redis->get(self::$prefix.$host);
    }

    public static function increment($host)
    {
        self::$redis->incrBy(self::$prefix.$host, 1);
        if (self::$redis->get(self::$prefix.$host) == 1) {
            self::$redis->setTimeout(self::$prefix.$host, self::$duration);
        }
    }
}