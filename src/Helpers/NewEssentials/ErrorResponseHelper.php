<?php


namespace PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials;


class ErrorResponseHelper
{
    /**
     * @param $response
     * @param string $model
     * @return array
     */
    public static function parseErrorResponse ($response, $model = '') {
        switch ($model) {
            default:
                if (strpos($response, 'The supplied OAuth token (Bearer) is not valid') !== false) {
                    $response = [ 'message' => 'The access token has expired', 'exception' => $response];
                } elseif (strpos($response, 'already exists') !== false || strpos($response, 'has been taken') !== false || strpos($response, 'DuplicateIdentifier') !== false) {
                    $response = [ 'message' => 'Duplicate model found', 'exception' => $response];
                } elseif (strpos($response, 'may not be null') !== false) {
                    $response = [ 'message' => 'Model cannot be edited', 'exception' => $response];
                } elseif (strpos($response, 'is required') !== false) {
                    $response = [ 'message' => 'Parameter missing from request: '.$response, 'exception' => $response];
                } elseif (strpos($response, 'page not found') !== false ) {
                    $response = [ 'message' => 'NULL Returned from API or End of Pagination', 'exception' => $response];
                } else {
                    $response = ['message' => $response, 'exception' => $response];
                }
                return $response;
        }
    }
}