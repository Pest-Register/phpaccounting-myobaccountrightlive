<?php


namespace Tests\TaxRates;


use Tests\BaseTest;

class GetTaxRateTest extends BaseTest
{

    public function testGetTaxRates()
    {
        $this->setUp();
        try {
            $params = [
                'search_params' => [
                    'Description' => 'Goods & Services Tax',
                ],
                'exact_search_value' => true,
//                'accounting_id' => "",
                'page' => 1000,
                'skip' => 0
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