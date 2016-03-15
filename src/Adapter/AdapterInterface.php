<?php

namespace Cassowary\Adapter;

interface AdapterInterface
{
    /**
     * @param array $params
     */
    public static function init(array $params);

    /**
     * @param string $host
     *
     * @return int
     */
    public static function getCount($host);

    /**
     * @param string $host
     *
     * @return int
     */
    public static function increment($host);
}
