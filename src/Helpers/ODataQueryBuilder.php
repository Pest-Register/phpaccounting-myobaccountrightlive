<?php

namespace PHPAccounting\MyobAccountRightLive\Helpers;

/**
 * OData query builder for MYOB API endpoints.
 * Handles common OData query syntax used by NewEssentials and AccountRight APIs.
 */
class ODataQueryBuilder
{
    private const QUERY_PREFIX = '?$';
    private const PARAM_PREFIX = '&$';

    /**
     * Format a value for OData filter syntax
     */
    public static function formatValue(string $key, mixed $value, string $fieldPrefix = ''): string
    {
        $field = $fieldPrefix . $key;

        if (str_ends_with($key, 'UID')) {
            return $field . " eq guid'" . urlencode($value) . "'";
        }

        if (is_bool($value)) {
            return $field . " eq " . ($value ? 'true' : 'false');
        }

        return $field . " eq '" . urlencode($value) . "'";
    }

    /**
     * Build a filter string from key-value pairs
     */
    public static function buildFilterConditions(array $params, bool $matchAll = true, string $fieldPrefix = ''): string
    {
        if (empty($params)) {
            return '';
        }

        $conditions = [];
        $separator = $matchAll ? ' and ' : ' or ';

        foreach ($params as $key => $value) {
            $conditions[] = self::formatValue($key, $value, $fieldPrefix);
        }

        return implode($separator, $conditions);
    }

    /**
     * Build pagination query string. When $modifiedSince is supplied, adds an
     * OData $filter clause `LastModified ge datetime'...'` so the response
     * is restricted to records updated since that cutoff (delta sync).
     */
    public static function paginate(string $endpoint, int $top, int $skip = 0, string $orderBy = 'UID', ?string $modifiedSince = null): string
    {
        $url = $endpoint . self::QUERY_PREFIX . "top={$top}"
            . self::PARAM_PREFIX . "skip={$skip}"
            . self::PARAM_PREFIX . "orderby={$orderBy}";

        $modifiedClause = self::buildLastModifiedClause($modifiedSince);
        if ($modifiedClause !== '') {
            $url .= self::PARAM_PREFIX . 'filter=' . $modifiedClause;
        }

        return $url;
    }

    /**
     * Build a GUID filter query
     */
    public static function filterByGuid(string $endpoint, string $guid, string $filterPrefix = ''): string
    {
        return $endpoint . self::QUERY_PREFIX . "filter={$filterPrefix}UID eq guid'{$guid}'";
    }

    /**
     * Build endpoint for specific resource by GUID (for PUT/DELETE operations)
     */
    public static function resourceByGuid(string $endpoint, string $guid, bool $returnBody = true): string
    {
        $url = $endpoint . '/' . $guid;
        return $returnBody ? $url . '?returnBody=true' : $url;
    }

    /**
     * Append contact type to endpoint
     */
    public static function appendContactType(string $endpoint, string $type): string
    {
        $validTypes = [
            'Customer', 'Supplier', 'Employee',
            'EmployeePayrollDetails', 'EmployeePaymentDetails',
            'EmployeeStandardPay', 'Personal'
        ];

        $contactType = in_array($type, $validTypes) ? $type : 'Customer';
        return $endpoint . $contactType;
    }

    /**
     * Build complex search query with filters. When $modifiedSince is supplied,
     * adds an OData `LastModified ge datetime'...'` clause to the $filter so
     * the response is restricted to records updated since that cutoff
     * (delta sync).
     */
    public static function search(
        string $endpoint,
        ?array $searchParams = null,
        bool $exactSearch = true,
        ?array $filterParams = null,
        bool $filterMatchAll = false,
        int $top = 1000,
        int $skip = 0,
        string $orderBy = 'UID',
        ?string $modifiedSince = null
    ): string {
        // Start with pagination
        $url = $endpoint . self::QUERY_PREFIX . "top={$top}"
            . self::PARAM_PREFIX . "skip={$skip}"
            . self::PARAM_PREFIX . "orderby={$orderBy}"
            . self::PARAM_PREFIX . "filter=";

        $filters = [];

        // Build search conditions
        if (!empty($searchParams)) {
            $searchCondition = self::buildFilterConditions($searchParams, $exactSearch);
            if ($searchCondition) {
                $filters[] = $searchCondition;
            }
        }

        // Build filter conditions
        if (!empty($filterParams)) {
            $filterCondition = self::buildAdvancedFilter($filterParams, $filterMatchAll);
            if ($filterCondition) {
                $filters[] = '(' . $filterCondition . ')';
            }
        }

        $modifiedClause = self::buildLastModifiedClause($modifiedSince);
        if ($modifiedClause !== '') {
            $filters[] = $modifiedClause;
        }

        return $url . implode(' and ', $filters);
    }

    /**
     * Format an OData LastModified clause. Accepts an ISO-8601 datetime
     * string (with or without timezone) and emits MYOB's preferred shape:
     * `LastModified ge datetime'YYYY-MM-DDTHH:MM:SS'`. Returns '' when no
     * cutoff was supplied.
     */
    private static function buildLastModifiedClause(?string $modifiedSince): string
    {
        if ($modifiedSince === null || $modifiedSince === '') {
            return '';
        }
        // Strip any timezone suffix — MYOB rejects datetime'...' with Z/+00:00.
        $iso = preg_replace('/(Z|[+-]\d{2}:?\d{2})$/', '', $modifiedSince);
        $iso = preg_replace('/\.[0-9]+$/', '', $iso); // drop fractional seconds
        return "LastModified ge datetime'" . urlencode($iso) . "'";
    }

    /**
     * Build advanced filter with support for arrays and nested properties
     */
    private static function buildAdvancedFilter(array $filterParams, bool $matchAll): string
    {
        $conditions = [];
        $separator = $matchAll ? ' and ' : ' or ';

        foreach ($filterParams as $key => $value) {
            if (is_array($value)) {
                $condition = self::buildArrayFilter($key, $value, $matchAll);
            } else {
                $condition = self::formatValue($key, $value);
            }

            if ($condition) {
                $conditions[] = $condition;
            }
        }

        return implode($separator, $conditions);
    }

    /**
     * Build filter for array values (supports collection filtering with any())
     */
    private static function buildArrayFilter(string $key, array $values, bool $matchAll): string
    {
        $separator = $matchAll ? ' and ' : ' or ';

        // Check if this is a collection filter (e.g., "Lines[]")
        if (str_contains($key, '[]')) {
            $collectionName = str_replace('[]', '', $key);
            $innerConditions = [];

            foreach ($values as $subKey => $subValue) {
                $innerConditions[] = self::formatValue($subKey, $subValue, 'x/');
            }

            return $collectionName . '/any(x: ' . implode($separator, $innerConditions) . ')';
        }

        // Regular array of values for the same field
        $conditions = [];
        foreach ($values as $singleValue) {
            $conditions[] = self::formatValue($key, $singleValue);
        }

        return implode($separator, $conditions);
    }
}
