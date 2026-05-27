<?php

namespace PHPAccounting\MyobAccountRightLive\Helpers;

/**
 * Safe array access helper to prevent undefined index errors.
 */
class IndexSanityCheckHelper
{
    /**
     * Safely retrieve a value from an array by key.
     *
     * @param string $key The key to look up
     * @param array $array The array to search
     * @return mixed The value if found, empty string otherwise
     */
    public static function indexSanityCheck(string $key, array $array): mixed
    {
        if (array_key_exists($key, $array)) {
            return $array[$key];
        }
        return '';
    }
}
