<?php


namespace PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials;


class BuildEndpointHelper
{
    /**
     * Load model by specific GUID
     * @param $endpoint
     * @param $guid
     * @param string $filterPrefix
     * @return string
     */
    public static function loadByGUID($endpoint, $guid, $filterPrefix='') {
        $prefix = '?$';
        $endpoint = $endpoint . $prefix."filter=".$filterPrefix."UID eq guid'".$guid."'";
        return $endpoint;
    }

    /**
     * Create endpoint for specific model via GUID
     * @param $endpoint
     * @param $guid
     * @return string
     */
    public static function createForGUID($endpoint, $guid) {
        $endpoint = $endpoint.'/'.$guid.'?returnBody=true';
        return $endpoint;
    }

    /**
     * Delete endpoint for specific model via GUID
     * @param $endpoint
     * @param $guid
     * @return string
     */
    public static function deleteForGUID($endpoint, $guid) {
        $endpoint = $endpoint.'/'.$guid.'?returnBody=true';;
        return $endpoint;
    }
    /**
     * Paginate based on page and skip parameters
     * @param $endpoint
     * @param $page
     * @param $skip
     * @return string
     */
    public static function paginate($endpoint, $page, $skip) {
        $prefix = '?$';
        $skipPrefix = '&$';
        $endpoint = $endpoint . $prefix."top=".$page.$skipPrefix.'skip='.$skip;
        return $endpoint;
    }

    /**
     * Search for model based on passed in search term and parameter
     * @param $endpoint
     * @param $page
     * @param $skip
     * @param $searchParam
     * @param $searchTerm
     * @param string $filterPrefix
     * @return string
     */
    public static function search($endpoint, $searchParam, $searchTerm, $filterPrefix='') {
        $prefix = '?$';
        $endpoint = $endpoint . $prefix."filter=".$filterPrefix."('".$searchTerm."',".$searchParam.") eq true";
        return $endpoint;
    }

    public static function contactType($endpoint, $type){
        switch ($type) {
            case "Customer":
                return $endpoint . 'Customer';
            case "Supplier":
                return $endpoint . 'Supplier';
            case "Employee":
                return $endpoint . 'Employee';
            case "EmployeePayrollDetails":
                return $endpoint . 'EmployeePayrollDetails';
            case "EmployeePaymentDetails":
                return $endpoint . 'EmployeePaymentDetails';
            case "EmployeeStandardPay":
                return $endpoint . 'EmployeeStandardPay';
            case "Personal":
                return $endpoint . 'Personal';
            default:
                return $endpoint . 'Customer';
        }
    }
}