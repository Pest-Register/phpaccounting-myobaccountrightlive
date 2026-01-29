<?php

namespace Tests;

use PHPUnit\Framework\TestCase;


/**
 * Created by IntelliJ IDEA.
 * User: Dylan
 * Date: 14/05/2019
 * Time: 9:54 AM
 */

class GetTaxRateTest extends BaseTest
{

    public function testGetTaxRates()
    {
        $this->setUp();
        try {
            $params = [
                'accounting_ids' => [""],
                'page' => 2
            ];

            $response = $this->gateway->getTaxRate($params)->send();
            if ($response->isSuccessful()) {
                var_dump($response->getTaxRates());
            } else {
                var_dump($response->getErrorMessage());
            }
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
        }
    }
}
