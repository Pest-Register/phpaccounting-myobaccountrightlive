<?php


namespace Tests\Contacts\NewEssentials;


use Tests\BaseTest;

class DeleteContactTest extends BaseTest
{
    /**
     *
     */
    public function testDeleteContact()
    {
        $this->setUp();
        try {

            $params = [
                'accounting_id' => 'c66ae46d-d3ca-4283-a2ea-f9cfff0ee177',
            ];

            $response = $this->gateway->deleteContact($params)->send();
            if ($response->isSuccessful()) {
                $contacts = $response->getContacts();
                var_dump($contacts);
                $this->assertIsArray($contacts);
            } else {
                var_dump($response->getErrorMessage());
            }
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
        }
    }
}