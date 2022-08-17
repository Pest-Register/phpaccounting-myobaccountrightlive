<?php


namespace Tests\Payments\NewEssentials;


use Tests\BaseTest;

class DeletePaymentTest extends BaseTest
{
    public function testDeletePayment()
    {
        $this->setUp();
        try {

            $params = [
                'accounting_id' => '263c19d2-61bf-44ea-82d2-f0a79dee941a',
            ];

            $response = $this->gateway->deletePayment($params)->send();
            if ($response->isSuccessful()) {
                $payments = $response->getPayments();
                var_dump($payments);
                $this->assertIsArray($payments);
            } else {
                var_dump($response->getErrorMessage());
            }
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
        }
    }
}