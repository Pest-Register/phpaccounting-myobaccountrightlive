<?php


namespace Tests\InventoryItems;

use Tests\BaseTest;

class CreateInventoryItemTest extends BaseTest
{
    public function testCreateInventoryItem(){
        $this->setUp();
        try {

            $params = [
                'code' => 'DEV-OPS',
                'name' => 'Development Operations',
                'is_selling' => true,
                'is_buying' => true,
                'description' => 'Development Operations',
                'buying_description' => 'Development Operations',
                'status' => 'ACTIVE',
                'unit' => 'QTY',
                'type' => 'Stock',
                'purchase_details' => [
                    'buying_account_id' => 55970294,
                    'buying_unit_price' => 100,
                    'buying_account_code' => 200,
                    'buying_tax_type_id' => 10,
                    'buying_tax_type_code' => 'OUTPUT'
                ],
                'sales_details' => [
                    'selling_account_id' => 55970288,
                    'selling_unit_price' => 150,
                    'selling_account_code' => 200,
                    'selling_tax_type_id' => 10,
                    'selling_tax_type_code' => 'OUTPUT'
                ]
            ];

            $response = $this->gateway->createInventoryItem($params)->send();
            if ($response->isSuccessful()) {
                $this->assertIsArray($response->getData());
                var_dump($response->getInventoryItems());
            } else {
                var_dump($response->getErrorMessage());
            }
        } catch (\Exception $exception) {
            var_dump($exception->getTrace());
        }
    }
}