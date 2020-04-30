<?php


namespace Tests\Payments\NewEssentials;


use Tests\BaseTest;

class CreatePaymentTest extends BaseTest
{
    public function testCreatePayment(){
        $this->setUp();
        try {

            $params = [
                'currency_rate' => 1.0,
                'amount' => 100.00,
                'reference_id' => 'PR000003',
                'is_reconciled' => true,
                'date' => '2020-04-30',
                'invoice' => [
                    'accounting_id' => 'e4e39d02-e253-49c7-a794-eed9e3543104'
                ],
                'account' => [
                    'accounting_id' => 'a9fe0d79-9f2c-42c7-ace0-6ee1017c8940'
                ],
                'contact' => [
                    'accounting_id' => '5a225a1e-994f-4f9a-81ae-d94daa31b3ec'
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