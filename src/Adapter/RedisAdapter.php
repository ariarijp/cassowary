<?php

namespace Cassowary\Adapter;

class RedisAdapter extends AbstractAdapter
{
    /**
     * @var \Redis
     */
    private static $redis;

    public static function init(array $params)
    {
        parent::init($params);

        $redis = new \Redis();
        if (array_key_exists('socket', $params)) {
            $redis->connect($params['socket']);
        } else {
            $redis->connect($params['host'], $params['port']);
        }
        $redis->select($params['index']);
        self::$redis = $redis;
    }

    public static function getCount($host)
    {
        return self::$redis->get(self::$prefix. $host);
    }

    public static function increment($host)
    {
        $count = self::$redis->incrBy(self::$prefix. $host, 1);
        if (self::$redis->get(self::$prefix. $host) == 1) {
            self::$redis->setTimeout(self::$prefix. $host, self::$ttl);
        }

        return $count;
    }

    public static function addToBlacklist($host)
    {
        self::$redis->sAdd(self::$prefix. self::BLACKLIST_KEY, $host);
    }

    public static function getBlacklist()
    {
        return self::$redis->sMembers(self::$prefix. self::BLACKLIST_KEY);
    }
}
