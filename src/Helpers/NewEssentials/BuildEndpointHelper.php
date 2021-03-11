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
     * @param $searchParams
     * @param $exactSearch
     * @param null $filterParams
     * @param bool $filterMatchAll
     * @param string $filterPrefix
     * @return string
     */
    public static function search($endpoint, $searchParams, $exactSearch, $filterParams=null, $filterMatchAll=false, $filterPrefix='')
    {
        $prefix = '?$';
        $endpoint = $endpoint . $prefix . "filter=";
        $searchFilter = "";
        $separationFilter = "";
        if ($searchParams)
        {
            foreach($searchParams as $key => $value)
            {
                if ($exactSearch)
                {
                    $searchFilter .= $separationFilter.$key." eq '".urlencode($value)."'";
                    $separationFilter = " and ";
                } else {
                    $searchFilter .= $separationFilter.$filterPrefix."('".urlencode($value)."',".$key.") eq true";
                    $separationFilter = " or ";
                }
            }
        }
        $endpoint .= $searchFilter;
        $filterQuery = '';
        $separationFilter = '';
        if ($filterParams)
        {
            foreach($filterParams as $key => $value)
            {
                $queryString = '';
                $filterKey = $key;
                $filterQuery = '(';
                foreach ($value as $filterValue)
                {

                    if ($filterMatchAll)
                    {
                        $filterQuery .= $separationFilter.$filterKey." eq '".urlencode($filterValue)."'";
                        $separationFilter = " and ";
                    } else {
                        $filterQuery .= $separationFilter.$filterKey." eq '".urlencode($filterValue)."'";
                        $separationFilter = " or ";
                    }
                }
            }
            $filterQuery.=")";
        }
        if ($searchFilter && $filterQuery)
        {
            $endpoint.=' and '.$filterQuery;
        }
        else {
            $endpoint.=$filterQuery;
        }
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