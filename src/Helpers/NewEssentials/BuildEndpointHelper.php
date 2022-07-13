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
    public static function paginate($endpoint, $page, $skip, $orderby='UID') {
        $prefix = '?$';
        $skipPrefix = '&$';
        $endpoint = $endpoint . $prefix."top=".$page.$skipPrefix.'skip='.$skip.$skipPrefix.'orderby='.$orderby;
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
    public static function search($endpoint, $searchParams, $exactSearch, $filterParams=null, $filterMatchAll=false, $filterPrefix='', $page=1000, $skip=0, $orderby='UID')
    {
        $prefix = '?$';
        $skipPrefix = '&$';
        $endpoint = $endpoint.$prefix."top=".$page.$skipPrefix.'skip='.$skip.$skipPrefix.'orderby='.$orderby.$skipPrefix."filter=";
        $searchFilter = "";
        $separationFilter = "";
        if ($searchParams)
        {
            foreach($searchParams as $key => $value)
            {
                if (str_ends_with($key, 'UID')) {
                    $searchFilter .= $separationFilter.$key." eq guid'".urlencode($value)."'";
                }
                else {
                    if (is_bool($value)) {
                        $searchFilter .= $separationFilter.$key." eq ".urlencode(($value ? 'true' : 'false'));
                    } else {
                        $searchFilter .= $separationFilter.$key." eq '".urlencode($value)."'";
                    }
                }

                if ($exactSearch) {
                    $separationFilter = " and ";
                }
                else {
                    $separationFilter = " or ";
                }
            }
        }
        $endpoint .= $searchFilter;
        $filterQuery = '';
        $separationFilter = '';
        if ($filterParams)
        {
            $filterQuery = '(';
            foreach($filterParams as $key => $value)
            {
                $queryString = '';
                $filterKey = $key;
                if (is_array($value)) {
                    if (str_contains($filterKey, '[]')) {
                        $filterKey = str_replace("[]" , '', $filterKey);
                        $arrayFilter = $filterKey."/any(x: ";
                        foreach ($value as $filterSubKey => $filterSubValue)
                        {
                            if (str_ends_with($filterSubKey, 'UID')) {
                                $arrayFilter .= $separationFilter."x/".$filterSubKey." eq guid'".urlencode($filterSubValue)."'";
                            } else {
                                if (is_bool($value)) {
                                    $arrayFilter .= $separationFilter."x/".$filterSubKey." eq ".urlencode(($filterSubValue ? 'true' : 'false'));
                                } else {
                                    $arrayFilter .= $separationFilter."x/".$filterSubKey." eq '".urlencode($filterSubValue)."'";
                                }
                            }
                            if ($filterMatchAll) {
                                $separationFilter = " and ";
                            }
                            else {
                                $separationFilter = " or ";
                            }
                        }
                        $arrayFilter .= ")";
                        $filterQuery .= $arrayFilter;
                    } else {
                        foreach ($value as $filterValue)
                        {
                            if (str_ends_with($filterKey, 'UID')) {
                                $filterQuery .= $separationFilter.$filterKey." eq guid'".urlencode($filterValue)."'";
                            }
                            else {
                                if (is_bool($filterValue)){
                                    $filterQuery .= $separationFilter.$filterKey." eq ".urlencode(($filterValue ? 'true' : 'false'));
                                } else {
                                    $filterQuery .= $separationFilter.$filterKey." eq '".urlencode($filterValue)."'";
                                }
                            }

                            if ($filterMatchAll) {
                                $separationFilter = " and ";
                            }
                            else {
                                $separationFilter = " or ";
                            }
                        }
                    }
                } else {
                    if (str_ends_with($filterKey, 'UID')) {
                        $filterQuery .= $separationFilter.$filterKey." eq guid'".urlencode($value)."'";
                    }
                    else {
                        if (is_bool($value)) {
                            $filterQuery .= $separationFilter.$filterKey." eq ".urlencode(($value ? 'true' : 'false'));
                        } else {
                            $filterQuery .= $separationFilter.$filterKey." eq '".urlencode($value)."'";
                        }
                    }

                    if ($filterMatchAll) {
                        $separationFilter = " and ";
                    }
                    else {
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