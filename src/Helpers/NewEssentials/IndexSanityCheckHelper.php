<?php

namespace PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials;

/**
 * Class IndexSanityCheckHelper
 * @package PHPAccounting\Xero\Helpers
 */
class IndexSanityCheckHelper
{
    public static function indexSanityCheck ($key, $array) {
        $value = '';
        if (array_key_exists($key, $array)) {
            return $array[$key];
        }
        return $value;
    }
}