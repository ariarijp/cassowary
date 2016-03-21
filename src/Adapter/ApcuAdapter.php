<?php

namespace Cassowary\Adapter;

class ApcuAdapter implements AdapterInterface
{
    const BLACKLIST_KEY = 'blacklist';

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
        self::$prefix = $params['prefix'];
        self::$duration = $params['duration'];
    }

    public static function getCount($host)
    {
        return apcu_fetch(self::$prefix. $host);
    }

    public static function increment($host)
    {
        if (!apcu_exists(self::$prefix. $host)) {
            apcu_store(self::$prefix. $host, 0, self::$duration);
        }

        apcu_inc(self::$prefix. $host);

        return apcu_fetch(self::$prefix. $host);
    }

    public static function addToBlacklist($host)
    {
        $blacklist = self::getBlacklist();
        if (!in_array($host, $blacklist)) {
            $blacklist[] = $host;
        }

        apcu_store(self::$prefix. self::BLACKLIST_KEY, $blacklist);
    }

    public static function getBlacklist()
    {
        $blacklist = apcu_fetch(self::$prefix. self::BLACKLIST_KEY);

        if (empty($blacklist)) {
            return [];
        }

        return $blacklist;
    }
}
