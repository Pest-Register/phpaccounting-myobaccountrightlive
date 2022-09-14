<?php

namespace Tests\Invoices\NewEssentials;


use Tests\BaseTest;

class GetInvoiceTest extends BaseTest
{

    public function testGetInvoices()
    {
        $this->setUp();
        try {
            $params = [
                'canPaginate' => true,
                'accounting_id' => "79eb4f91-9894-48ad-b465-e305591cb9ee",
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
