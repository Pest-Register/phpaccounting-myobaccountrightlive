<?php


namespace Tests\InventoryItems\NewEssentials;


use Tests\BaseTest;

class CreateInventoryItemTest extends BaseTest
{
    public function testCreateInventoryItem(){
        $this->setUp();
        try {

            $params = [
                'code' => 'TEST05',
                'name' => 'Testing Ledger Sync',
                'description' => 'Testing Ledger Sync',
                'type' => 'PRODUCT',
                'is_buying' => false,
                'is_selling' => true,
                'is_tracked' => false,
                'buying_details' => [],
                'sales_details' => [
                        'selling_unit_price' => 150.0,
                        'selling_account_id' => '8e52f2a4-0770-4e1f-972e-305b8eb4295f',
                        'selling_account_code' => '002',
                        'selling_tax_type_id' => '50a917ff-65a0-4fff-aa20-f5c541c4f125',
                        'selling_tax_type_code' => NULL,
                    ],
                'asset_details' => [],
                'buying_description' => NULL,
                'selling_description' => 'Testing Ledger Sync',
                'quantity' => 0.0,
                'cost_pool' => 0.0,
                'accounting_id' => NULL,
                'status' => 'ACTIVE',
                'unit' => 'QTY',
                'sync_token' => NULL,
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