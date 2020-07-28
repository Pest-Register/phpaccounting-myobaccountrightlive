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
                'accounting_id' => "b5fb61aa-3a45-41b6-b436-0efc29c080cb",
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