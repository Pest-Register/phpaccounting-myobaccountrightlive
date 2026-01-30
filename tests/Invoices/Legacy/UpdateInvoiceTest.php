<?php
/**
 * Created by IntelliJ IDEA.
 * User: Max
 * Date: 5/29/2019
 * Time: 6:21 PM
 */

namespace Tests\Invoices\Legacy;


use Tests\BaseTest;
use Faker;
class UpdateInvoiceTest extends BaseTest
{
    public function testUpdateInvoices()
    {
        $this->setUp();
        $faker = Faker\Factory::create();
        try {

            $params = [
                'accounting_id' => '426865532',
                'invoice_reference' => '20190806_0001',
                'type' => 'ACCREC',
                'date' => '2019-01-27',
                'due_date' => '2019-01-28',
                'contact' => '29140824',
                'status' => 'Open',
                'gst_inclusive' => true,
                'gst_registered' => true,
                'invoice_data' => [
                    [
                        'description' => 'Consulting services as agreed (20% off standard rate)',
                        'quantity' => 10,
                        'unit_amount' => 90,
                        'discount_rate' => 20,
                        'amount' => 600,
                        'code' => 200,
                        'unit' => 'QTY',
                        'tax_id' => '10',
                        'account_id' => '63240545',
                        'item_id' => '8101813'
                    ]
                ]
            ];

            $response = $this->gateway->updateInvoice($params)->send();
            if ($response->isSuccessful()) {
                $invoices = $response->getInvoice();
                var_dump($invoices);
                $this->assertIsArray($invoices);
            } else {
                var_dump($response->getErrorMessage());
            }
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
        }
    }
}