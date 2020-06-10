<?php

namespace Tests;
use Faker;

class CreateAccountTest extends BaseTest
{
    public function testCreateAccount(){
        $this->setUp();
        try {

            $params = [
                'code' => 002,
                'name' => 'PESTREGISTER_LongTermLiability',
                'type' => 'OtherLiability',
                'type_id' => 2,
                'status' => 'ACTIVE',
                'description' => 'Test Description',
                'tax_type' => 'GST Free',
                'tax_type_id' => '56ecd454-f2bc-4ba3-b28f-72b36e6bdef6',
                'accounting_parent_id' => 'b3a7a855-ee14-4b96-a971-db367bde26fd',
                'is_header' => false
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