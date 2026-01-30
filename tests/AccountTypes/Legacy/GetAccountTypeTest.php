<?php


namespace Tests\AccountTypes\Legacy;


use Tests\BaseTest;

class GetAccountTypeTest extends BaseTest
{
    public function testGetAccountTypes()
    {
        $this->setUp();
        try {
            $params = [
                'accounting_id' => "",
                'page' => 2
            ];

            $response = $this->gateway->getAccountType($params)->send();
            if ($response->isSuccessful()) {
                var_dump($response->getAccountTypes());
            } else {
                var_dump($response->getErrorMessage());
            }
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
        }
    }
}