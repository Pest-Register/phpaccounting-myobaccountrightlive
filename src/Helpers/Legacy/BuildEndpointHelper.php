<?php

namespace PHPAccounting\MyobAccountRightLive\Helpers\Legacy;

/**
 * Endpoint builder for MYOB Old Essentials API (v0).
 * Uses simple query parameters instead of OData.
 *
 * @deprecated This is for legacy old_essentials product support.
 */
class BuildEndpointHelper
{
    /**
     * Load model by specific GUID
     */
    public static function loadByGUID($endpoint, $guid, $filterPrefix = '', $filter = ''): string
    {
        $prefix = '?';
        return $endpoint . '/' . $guid . $prefix . $filterPrefix . '=' . $filter;
    }

    /**
     * Paginate based on page number
     */
    public static function paginate($endpoint, $page): string
    {
        $prefix = '?';
        return $endpoint . $prefix . 'page=' . $page;
    }

    /**
     * Create endpoint for specific model via GUID (for PUT operations)
     */
    public static function createForGUID($endpoint, $guid): string
    {
        return $endpoint . '/' . $guid;
    }

    /**
     * Legacy pagination with date range support
     */
    public static function paginateLegacy($endpoint, $page, $fromDate = '', $toDate = ''): string
    {
        $prefix = '?';
        $endpoint = $endpoint . $prefix . 'pageNumber=' . $page;
        if ($fromDate !== '' && $toDate !== '') {
            $endpoint = $endpoint . '&fromDate=' . $fromDate . '&toDate=' . $toDate;
        }
        return $endpoint;
    }
}
