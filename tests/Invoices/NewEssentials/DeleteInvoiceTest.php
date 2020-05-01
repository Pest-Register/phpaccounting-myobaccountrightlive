<?php


namespace Tests\Invoices\NewEssentials;


use Tests\BaseTest;

class DeleteInvoiceTest extends BaseTest
{
    /**
     *
     */
    public function testDeleteInvoice()
    {
        $this->setUp();
        try {

            $params = [
                'accounting_id' => '396c8644-806d-42d9-974f-538afcf45b39',
            ];

            $response = $this->gateway->deleteInvoice($params)->send();
            if ($response->isSuccessful()) {
                $invoices = $response->getInvoices();
                var_dump($invoices);
                $this->assertIsArray($invoices);
            } else {
                var_dump($response->getErrorMessage());
            }
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
        }
    }
}