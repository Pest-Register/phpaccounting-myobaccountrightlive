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
                'accounting_id' => 'db2d14e2-2878-43fd-8db5-ebbea182d035',
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