<?php

namespace Cassowary;

class Cassowary
{
    /**
     * @param int      $threshold
     * @param string   $host
     * @param string   $className
     * @param callable $closure
     */
    public static function kick($threshold, $host, $className, callable $closure)
    {
        $count = $className::increment($host);
        if ($count >= $threshold) {
            $className::addToBlacklist($host);
        }

        $blacklist = self::getBlacklist($className);

        if (in_array($host, $blacklist)) {
            $closure($host, $count);
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
