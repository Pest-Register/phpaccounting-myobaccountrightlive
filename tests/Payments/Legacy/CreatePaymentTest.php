<?php

namespace Tests\Payments\Legacy;


use Tests\BaseTest;

class CreatePaymentTest extends BaseTest
{
    public function testCreatePayment(){
        $this->setUp();
        try {

            $params = [
                'contact' => [
                    'accounting_id' => '27915429'
                ],
                'currency_rate' => 1.0,
                'amount' => 100.00,
                'reference_id' => 'PR000002',
                'is_reconciled' => true,
                'date' => '2019-06-27',
                'invoice' => [
                    'accounting_id' => '406886309'
                ],
                'account' => [
                    'accounting_id' => '55970259'
                ]
            ];

            $response = $this->gateway->createPayment($params)->send();
            if ($response->isSuccessful()) {
                $this->assertIsArray($response->getData());
                var_dump($response->getPayments());
            } else {
                var_dump($response->getErrorMessage());
            }
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
        }
    }
}