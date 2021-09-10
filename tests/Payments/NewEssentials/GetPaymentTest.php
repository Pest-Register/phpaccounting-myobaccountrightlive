<?php
/**
 * Created by IntelliJ IDEA.
 * User: Max
 * Date: 5/29/2019
 * Time: 5:42 PM
 */

namespace Tests\Invoices;

use Tests\BaseTest;

class GetPaymentTest extends BaseTest
{

    public function testGetPayments()
    {
        $this->setUp();
        try {
            $params = [
//                'accounting_id' => "",
                'invoice_accounting_id' => "79eb4f91-9894-48ad-b465-e305591cb9ee",
                'page' => 1000
            ];

            $response = $this->gateway->getPayment($params)->send();
            if ($response->isSuccessful()) {
                var_dump($response->getPayments());
            } else {
                var_dump($response->getErrorMessage());
            }
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
        }
    }
}