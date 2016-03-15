<?php

namespace Cassowary;

class Cassowary
{
    /**
     * @param int    $threshold
     * @param string $host
     * @param string $className
     * @param callable $closure
     */
    public static function kick($threshold, $host, $className, callable $closure)
    {
        $className::increment($host);

        $count = $className::getCount($host);
        if ($count >= $threshold) {
            $closure($host, $count);
        }
    }
}
