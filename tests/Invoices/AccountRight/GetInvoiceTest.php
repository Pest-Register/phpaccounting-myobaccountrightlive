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
                'accounting_id' => "",
                'page' => 2000,
                'invoice_type' => 'Service'
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