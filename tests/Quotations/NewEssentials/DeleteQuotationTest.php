<?php


namespace Tests\Quotations;


use Tests\BaseTest;

class DeleteQuotationTest extends BaseTest
{
    /**
     *
     */
    public function testDeleteQuotations()
    {
        $this->setUp();
        try {

            $params = [
                'accounting_id' => '9a36650f-48d6-4362-aac1-04c96d4dd2e4',
            ];

            $response = $this->gateway->deleteQuotation($params)->send();
            if ($response->isSuccessful()) {
                $quotes = $response->getQuotations();
                var_dump($quotes);
                $this->assertIsArray($quotes);
            } else {
                var_dump($response->getErrorMessage());
            }
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
        }
    }
}