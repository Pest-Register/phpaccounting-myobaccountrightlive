<?php

namespace Tests\Invoices;


use Tests\BaseTest;

class CreateInvoiceTest extends BaseTest
{
    public function testCreateInvoice(){
        $this->setUp();
        try {

            $params = [
                'invoice_reference' => '20190806_0001',
                'type' => 'ACCREC',
                'date' => '2020-04-30',
                'due_date' => '2020-01-28',
                'contact' => '5a225a1e-994f-4f9a-81ae-d94daa31b3ec',
                'total' => 6400,
                'status' => 'Open',
                'gst_inclusive' => true,
                'gst_registered' => true,
                'invoice_data' => [
                    [
                        'description' => 'Consulting services as agreed (20% off standard rate)',
                        'quantity' => 10,
                        'unit_amount' => 100.00,
                        'discount_rate' => 20,
                        'amount' => 800,
                        'code' => 200,
                        'unit' => 'QTY',
                        'tax_id' => '10',
                        'account_id' => '63240545',
                        'item_id' => '8101813'
                    ]
                ]
            ];

            $response = $this->gateway->createInvoice($params)->send();
            if ($response->isSuccessful()) {
                $this->assertIsArray($response->getData());
                var_dump($response->getInvoices());
            } else {
                var_dump($response->getErrorMessage());
            }
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
        }
    }
}