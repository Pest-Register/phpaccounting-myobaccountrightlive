<?php

namespace Tests\Invoices;


use Tests\BaseTest;

class GetInvoiceTest extends BaseTest
{

    public function testGetInvoices()
    {
        $this->setUp();
        try {
            $params = [
                'canPaginate' => true,
                'accounting_id' => "7b9db40b-51e0-4d24-b7cb-8a4fe0c8aa0f",
                'invoice_type' => 'Item',
                'skip' => 0,
                'page' => 1000,
            ];

            $response = $this->gateway->getInvoice($params)->send();
            if ($response->isSuccessful()) {
                var_dump($response->getInvoices());
            } else {
                var_dump($response->getErrorMessage());
            }
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
        }
    }
}