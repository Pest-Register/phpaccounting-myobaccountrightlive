<?php

namespace PHPAccounting\MyobAccountRightLive\Helpers\AccountRight;

use PHPAccounting\MyobAccountRightLive\Helpers\ODataQueryBuilder;

/**
 * Endpoint builder for MYOB AccountRight Live API.
 * Uses OData query syntax.
 */
class BuildEndpointHelper
{
    /**
     * Load model by specific GUID
     */
    public static function loadByGUID(string $endpoint, string $guid, string $filterPrefix = ''): string
    {
        return ODataQueryBuilder::filterByGuid($endpoint, $guid, $filterPrefix);
    }

    /**
     * Paginate based on top and skip parameters
     */
    public static function paginate(string $endpoint, int $top, int $skip = 0): string
    {
        return ODataQueryBuilder::paginate($endpoint, $top, $skip, 'UID');
    }

    /**
     * Search for model based on passed in search term and parameter
     * Note: AccountRight uses a different search syntax (substringof)
     */
    public static function search(string $endpoint, string $searchParam, string $searchTerm, string $filterPrefix = ''): string
    {
        $prefix = '?$';
        return $endpoint . $prefix . "filter={$filterPrefix}('{$searchTerm}',{$searchParam}) eq true";
    }

    /**
     * Append contact type to endpoint
     */
    public static function contactType(string $endpoint, string $type): string
    {
        return ODataQueryBuilder::appendContactType($endpoint, $type);
    }
}
