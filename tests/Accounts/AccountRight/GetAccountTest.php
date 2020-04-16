<?php

namespace Tests;

use Omnipay\Omnipay;
use PHPUnit\Framework\TestCase;
use XeroPHP\Remote\Collection;


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
                'accounting_id' => "",
                'page' => 2000,
                'skip' => 1000
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
