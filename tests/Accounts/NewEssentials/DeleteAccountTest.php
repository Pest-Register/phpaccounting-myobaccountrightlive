<?php


namespace Tests\Accounts\NewEssentials;


use Tests\BaseTest;

class DeleteAccountTest extends BaseTest
{
    /**
     *
     */
    public function testDeleteAccount()
    {
        $this->setUp();
        try {

            $params = [
                'accounting_id' => '77d77139-e1cf-46d6-8a22-2392d5c24579',
            ];

            $response = $this->gateway->deleteAccount($params)->send();
            if ($response->isSuccessful()) {
                $accounts = $response->getAccounts();
                var_dump($accounts);
                $this->assertIsArray($accounts);
            } else {
                var_dump($response->getErrorMessage());
            }
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
        }
    }
}