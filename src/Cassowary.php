<?php

namespace Cassowary;

class Cassowary
{
    /**
     * @param int      $threshold
     * @param string   $host
     * @param string   $className
     * @param callable $addToBlacklistClosure
     * @param callable $isBlacklistedClosure
     */
    public static function kick($threshold, $host, $className, callable $beforeAddToBlacklistClosure, callable $kickedClosure)
    {
        $count = $className::increment($host);
        if ($count >= $threshold) {
            $beforeAddToBlacklistClosure($host);
            $className::addToBlacklist($host);
        }

        $blacklist = self::getBlacklist($className);

        if (in_array($host, $blacklist)) {
            $kickedClosure($host, $count);
        }
    }

    /**
     * @param string $className
     */
    public static function getBlacklist($className)
    {
        return $className::getBlacklist();
    }

    /**
     * @param string $className
     */
    public static function clearBlacklist($className)
    {
        $className::clearBlacklist();
    }
}
