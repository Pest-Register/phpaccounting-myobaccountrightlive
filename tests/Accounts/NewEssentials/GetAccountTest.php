<?php

namespace Tests;

use Omnipay\Omnipay;
use PHPUnit\Framework\TestCase;


/**
 * Created by IntelliJ IDEA.
 * User: Dylan
 * Date: 14/05/2019
 * Time: 9:54 AM
 */

class GetAccountTest extends BaseTest
{

    public function testGetAccounts()
    {
        $this->setUp();
        try {
            $params = [
                'search_params' => [
                    'Name' => 'Sales',
                ],
                'search_filters' => [
                    'Type' => [
                        'Income',
                        'OtherIncome'
                    ]
                ],
                'match_all_filters' => false,
                'exact_search_value' => true,
//                'accounting_id' => "527d8f24-0175-4e98-addb-faae929b98bf",
//                'page' => 1000,
//                'skip' => 0
            ];

            $response = $this->gateway->getAccount($params)->send();
            if ($response->isSuccessful()) {
                var_dump($response->getAccounts());
            } else {
                var_dump($response->getErrorMessage());
            }
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
        }
    }
}
