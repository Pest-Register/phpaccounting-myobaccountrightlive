<?php

namespace PHPAccounting\MyobAccountRightLive\Helpers\Legacy;

/**
 * Error response parser for MYOB Old Essentials API (v0).
 *
 * @deprecated This is for legacy old_essentials product support.
 */
class ErrorResponseHelper
{
    /**
     * Parse error response (simplified format for legacy API).
     *
     * @param string $response Raw error message
     * @param string $model Model type for context
     * @return array|string Normalized error response or original string
     */
    public static function parseErrorResponse($response, $model = '')
    {
        // Token expired (different message format than v2)
        if (strpos($response, 'Invalid authentication token') !== false) {
            return ['message' => 'The access token has expired'];
        }

        // Duplicate record
        if (strpos($response, 'already exists') !== false
            || strpos($response, 'has been taken') !== false) {
            return ['message' => 'Duplicate model found'];
        }

        // Null field error
        if (strpos($response, 'may not be null') !== false) {
            return ['message' => 'Model cannot be edited'];
        }

        // End of pagination
        if (strpos($response, 'page not found') !== false) {
            return ['message' => 'NULL Returned from API or End of Pagination'];
        }

        return $response;
    }
}
