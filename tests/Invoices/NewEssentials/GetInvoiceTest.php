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
                'accounting_id' => "0e16daa9-eebe-4e0a-b2ea-b21b336c462e",
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