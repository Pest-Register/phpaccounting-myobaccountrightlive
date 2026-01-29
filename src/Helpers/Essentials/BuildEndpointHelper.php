<?php


namespace PHPAccounting\MyobAccountRightLive\Helpers\Essentials;


class BuildEndpointHelper
{
    public static function loadByGUID($endpoint, $guid, $filterPrefix='', $filter ='') {
        $prefix = '?';
        $endpoint = $endpoint.'/'.$guid.$prefix.$filterPrefix.'='.$filter;
        return $endpoint;
    }

    public static function paginate($endpoint, $page) {
        $prefix = '?';
        $endpoint = $endpoint.$prefix."page=".$page;
        return $endpoint;
    }

    public static function createForGUID($endpoint, $guid) {
        $endpoint = $endpoint.'/'.$guid;
        return $endpoint;
    }

    public static function paginateLegacy($endpoint, $page, $fromDate = '', $toDate = '') {
        $prefix = '?';
        $endpoint = $endpoint.$prefix."pageNumber=".$page;
        if ($fromDate !== '' && $toDate !== '') {
            $endpoint = $endpoint.'&fromDate='.$fromDate.'&toDate='.$toDate;
        }
        return $endpoint;
    }
}