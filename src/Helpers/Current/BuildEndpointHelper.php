<?php

namespace PHPAccounting\MyobAccountRightLive\Helpers\Current;

use PHPAccounting\MyobAccountRightLive\Helpers\ODataQueryBuilder;

/**
 * Endpoint builder for MYOB AccountRight Live API (v2).
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
     * Create endpoint for specific model via GUID (for PUT operations)
     */
    public static function createForGUID(string $endpoint, string $guid): string
    {
        return ODataQueryBuilder::resourceByGuid($endpoint, $guid, true);
    }

    /**
     * Delete endpoint for specific model via GUID
     */
    public static function deleteForGUID(string $endpoint, string $guid): string
    {
        return ODataQueryBuilder::resourceByGuid($endpoint, $guid, true);
    }

    /**
     * Paginate based on top and skip parameters
     */
    public static function paginate(string $endpoint, int $top, int $skip = 0, string $orderBy = 'UID'): string
    {
        return ODataQueryBuilder::paginate($endpoint, $top, $skip, $orderBy);
    }

    /**
     * Search for model based on passed in search term and parameter
     */
    public static function search(
        string $endpoint,
        ?array $searchParams,
        bool $exactSearch,
        ?array $filterParams = null,
        bool $filterMatchAll = false,
        string $filterPrefix = '',
        int $page = 1000,
        int $skip = 0,
        string $orderBy = 'UID'
    ): string {
        return ODataQueryBuilder::search(
            $endpoint,
            $searchParams,
            $exactSearch,
            $filterParams,
            $filterMatchAll,
            $page,
            $skip,
            $orderBy
        );
    }

    /**
     * Append contact type to endpoint
     */
    public static function contactType(string $endpoint, string $type): string
    {
        return ODataQueryBuilder::appendContactType($endpoint, $type);
    }
}
