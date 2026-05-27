<?php
/**
 * Created by IntelliJ IDEA.
 * User: Dylan
 * Date: 19/07/2019
 * Time: 2:48 PM
 */

namespace Tests\InventoryItems\Legacy;


use Tests\BaseTest;

class UpdateInventoryItemTest extends BaseTest
{
    public function testUpdateInventoryItem()
    {
        $this->setUp();
        try {

            $params = [
                'accounting_id' => 8101813,
                'code' => 'DEV-OPS',
                'name' => 'Development Operations Test',
                'is_selling' => true,
                'is_buying' => true,
                'description' => 'Development Operations',
                'buying_description' => 'Development Operations',
                'status' => 'ACTIVE',
                'unit' => 'QTY',
                'type' => 'Stock',
                'purchase_details' => [
                    'buying_account_id' => 55970294,
                    'buying_unit_price' => 120,
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

            $response = $this->gateway->updateInventoryItem($params)->send();
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