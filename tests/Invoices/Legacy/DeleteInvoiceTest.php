<?php
/**
 * Created by IntelliJ IDEA.
 * User: Max
 * Date: 5/29/2019
 * Time: 6:42 PM
 */

namespace Tests\Invoices\Legacy;


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
                'accounting_id' => '426865532'
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