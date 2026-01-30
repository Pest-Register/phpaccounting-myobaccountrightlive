<?php

namespace Tests\Accounts\Legacy;
use Tests\BaseTest;
use Faker;

class CreateAccountTest extends BaseTest
{
    public function testCreateAccount(){
        $this->setUp();
        try {

            $params = [
                'code' => 002,
                'name' => 'PESTREGISTER_Sales',
                'type' => 'Current Assets',
                'type_id' => 2,
                'status' => 'ACTIVE',
                'description' => 'Test Description',
                'tax_type' => 'GST Free',
                'tax_type_id' => 8
            ];

            $response = $this->gateway->createAccount($params)->send();
            if ($response->isSuccessful()) {
                $this->assertIsArray($response->getData());
                var_dump($response->getAccounts());
            } else {
                var_dump($response->getErrorMessage());
            }

        } catch (\Exception $exception) {
            var_dump($exception->getTrace());
        }
    }
}