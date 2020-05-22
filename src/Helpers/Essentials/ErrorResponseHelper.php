<?php


namespace PHPAccounting\MyobAccountRightLive\Helpers\Essentials;


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
                if (strpos($response, 'Invalid authentication token') !== false) {
                    $response = [ 'message' => 'The access token has expired' ];
                } elseif (strpos($response, 'already exists') !== false || strpos($response, 'has been taken') !== false) {
                    $response = [ 'message' => 'Duplicate model found' ];
                } elseif (strpos($response, 'may not be null') !== false) {
                    $response = [ 'message' => 'Model cannot be edited' ];
                } elseif (strpos($response, 'page not found') !== false ) {
                    $response = [ 'message' => 'NULL Returned from API or End of Pagination' ];
                }
                return $response;
        }
    }
}