<?php


namespace Tests\InventoryItems\NewEssentials;


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
                'is_tracked' => false,
                'description' => 'Development Operations',
                'buying_description' => 'Development Operations',
                'status' => 'ACTIVE',
                'unit' => 'QTY',
                'type' => 'Stock',
                'buying_details' => [
                    'buying_account_id' => '42872548-8060-4678-b910-29e8eede8945',
                    'buying_unit_price' => 100,
                    'buying_account_code' => '6-1000',
                    'buying_tax_type_id' => '8d9cfae6-0f23-4c3e-904e-3e212cf67156',
                    'buying_tax_type_code' => 'N-T'
                ],
                'sales_details' => [
                    'selling_account_id' => '527d8f24-0175-4e98-addb-faae929b98bf',
                    'selling_unit_price' => 150,
                    'selling_account_code' => '4-1000',
                    'selling_tax_type_id' => '527d8f24-0175-4e98-addb-faae929b98bf',
                    'selling_tax_type_code' => 'GST'
                ]
            ];

            $response = $this->gateway->createInventoryItem($params)->send();
            var_dump($response);
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