<?php


namespace Tests\InventoryItems\Current;


use Tests\BaseTest;

class GetInventoryItemsTest extends BaseTest
{
    public function testGetInventoryItems()
    {
        $this->setUp();
        try {
            $params = [
                'accounting_id' => "",
                'page' => 1000
            ];

            $response = $this->gateway->getInventoryItem($params)->send();
            if ($response->isSuccessful()) {
                var_dump($response->getInventoryItems());
            } else {
                var_dump($response->getErrorMessage());
            }
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
        }
    }
}