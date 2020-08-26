<?php


namespace PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials;


class ErrorResponseHelper
{
    /**
     * @param $response
     * @param string $model
     * @return array
     */
    public static function parseErrorResponse ($response, $status, $errorCode, $statusCode, $detail, $model = '') {
        switch ($model) {
            default:
                if (strpos($response, 'The supplied OAuth token (Bearer) is not valid') !== false) {
                    $response = [
                        'message' => 'The access token has expired',
                        'status' => $status,
                        'exception' => $response,
                        'error_code' => $errorCode,
                        'status_code' => $statusCode,
                        'detail'=> $detail
                    ];
                } elseif (strpos($response, 'already exists') !== false || strpos($response, 'has been taken') !== false || strpos($response, 'DuplicateIdentifier') !== false) {
                    $response = [
                        'message' => 'Duplicate model found',
                        'status' => $status,
                        'exception' => $response,
                        'error_code' => $errorCode,
                        'status_code' => $statusCode,
                        'detail'=> $detail
                    ];
                } elseif (strpos($response, 'may not be null') !== false) {
                    $response = [
                        'message' => 'Model cannot be edited',
                        'status' => $status,
                        'exception' => $response,
                        'error_code' => $errorCode,
                        'status_code' => $statusCode,
                        'detail'=> $detail
                    ];
                } elseif (strpos($response, 'is required') !== false) {
                    $response = [
                        'message' => 'Parameter missing from request: '.$response,
                        'status' => $status,
                        'exception' => $response,
                        'error_code' => $errorCode,
                        'status_code' => $statusCode,
                        'detail'=> $detail
                    ];
                } elseif (strpos($response, 'page not found') !== false ) {
                    $response = [
                        'message' => 'NULL Returned from API or End of Pagination',
                        'status' => $status,
                        'exception' => $response,
                        'error_code' => $errorCode,
                        'status_code' => $statusCode,
                        'detail'=> $detail
                    ];
                } else {
                    $response = [
                        'message' => $response,
                        'status' => $status,
                        'exception' => $response,
                        'error_code' => $errorCode,
                        'status_code' => $statusCode,
                        'detail'=> $detail
                    ];
                }
                return $response;
        }
    }
}