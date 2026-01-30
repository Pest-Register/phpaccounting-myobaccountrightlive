<?php

namespace PHPAccounting\MyobAccountRightLive\Helpers\Current;

/**
 * Error response parser for MYOB AccountRight Live API (v2).
 */
class ErrorResponseHelper
{
    /**
     * Parse error response and normalize to standard format.
     *
     * @param string $response Raw error message
     * @param string $status Error severity/status
     * @param mixed $errorCode Error code from API
     * @param mixed $statusCode HTTP status code
     * @param mixed $detail Additional details
     * @param string $model Model type for context
     * @return array Normalized error response
     */
    public static function parseErrorResponse(
        $response,
        $status,
        $errorCode,
        $statusCode,
        $detail,
        $model = ''
    ): array {
        // Token expired
        if (strpos($response, 'The supplied OAuth token (Bearer) is not valid') !== false) {
            return [
                'message' => 'The access token has expired',
                'status' => $status,
                'exception' => $response,
                'error_code' => $errorCode,
                'status_code' => $statusCode,
                'detail' => $detail
            ];
        }

        // Duplicate record
        if (strpos($response, 'already exists') !== false
            || strpos($response, 'has been taken') !== false
            || strpos($response, 'DuplicateIdentifier') !== false) {
            return [
                'message' => 'Duplicate model found',
                'status' => $status,
                'exception' => $response,
                'error_code' => $errorCode,
                'status_code' => $statusCode,
                'detail' => $detail
            ];
        }

        // Null field error
        if (strpos($response, 'may not be null') !== false) {
            return [
                'message' => 'Model cannot be edited',
                'status' => $status,
                'exception' => $response,
                'error_code' => $errorCode,
                'status_code' => $statusCode,
                'detail' => $detail
            ];
        }

        // Required field missing
        if (strpos($response, 'is required') !== false) {
            return [
                'message' => 'Parameter missing from request: ' . $response,
                'status' => $status,
                'exception' => $response,
                'error_code' => $errorCode,
                'status_code' => $statusCode,
                'detail' => $detail
            ];
        }

        // End of pagination
        if (strpos($response, 'page not found') !== false) {
            return [
                'message' => 'NULL Returned from API or End of Pagination',
                'status' => $status,
                'exception' => $response,
                'error_code' => $errorCode,
                'status_code' => $statusCode,
                'detail' => $detail
            ];
        }

        // Default: return raw message
        return [
            'message' => $response,
            'status' => $status,
            'exception' => $response,
            'error_code' => $errorCode,
            'status_code' => $statusCode,
            'detail' => $detail
        ];
    }
}
