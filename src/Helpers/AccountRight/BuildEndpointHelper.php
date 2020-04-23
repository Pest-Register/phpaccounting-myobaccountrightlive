<?php


namespace PHPAccounting\MyobAccountRightLive\Helpers\AccountRight;


class BuildEndpointHelper
{
    public static function loadByGUID($endpoint, $guid, $filterPrefix='') {
        $prefix = '?$';
        $endpoint = $endpoint . $prefix."filter=".$filterPrefix."UID eq guid'".$guid."'";
        return $endpoint;
    }

    public static function paginate($endpoint, $page, $skip) {
        $prefix = '?$';
        $skipPrefix = '&$';
        $endpoint = $endpoint . $prefix."top=".$page.$skipPrefix.'skip='.$skip;
        var_dump($endpoint);
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