<?php

namespace Tests\Invoices\NewEssentials;


use Tests\BaseTest;

class CreateInvoiceTest extends BaseTest
{
    public function testCreateInvoice(){
        $this->setUp();
        try {

            $params = [
                'type' => 'Item',
                'date' => '2020-05-01',
                'due_date' => '2020-05-1',
                'contact' => '5a225a1e-994f-4f9a-81ae-d94daa31b3ec',
                'deposit' => 0.0,
                'invoice_data' => [
                    [
                        'description' => 'Test',
                        'accounting_id' => '',
                        'amount' => 494.55,
                        'quantity' => 1.0,
                        'unit_amount' => 494.55,
                        'discount_rate' => 0.0,
                        'code' => 7185,
                        'tax_type' => 'GST',
                        'unit' => 'QTY',
                        'tax_id' => '50a917ff-65a0-4fff-aa20-f5c541c4f125',
                        'account_id' => '527d8f24-0175-4e98-addb-faae929b98bf',
                        'discount_amount' => 0.0,
                        'tax_inclusive_amount' => 544.0,
                    ],
                    [
                        'description' => 'Test',
                        'amount' => 181.82,
                        'quantity' => 1.0,
                        'unit_amount' => 181.82,
                        'discount_rate' => 0.0,
                        'code' => 7185,
                        'tax_type' => 'ITS',
                        'unit' => 'QTY',
                        'tax_id' => '623b4a09-fd63-47d4-a632-b4b0294f9ce1',
                        'account_id' => '4862df87-39d7-407f-a51b-716284818aa3',
                        'discount_amount' => 0.0,
                        'tax_inclusive_amount' => 200.0,
                    ]
                ],
                'total_discount' => 0.0,
                'gst_registered' => true,
                'invoice_number' => '20200327_0002',
                'invoice_reference' => '20200327_0002',
                'total' => 1897.40,
                'discount_amount' => 97.60,
                'discount_rate' => 4.89223,
                'deposit_amount' => NULL,
                'gst_inclusive' => 'INCLUSIVE',
                'total_tax' => 172.49,
                'tax_lines' => [
                    [
                        'tax_id' => '10',
                        'tax_rate_id' => 20,
                        'tax_percent' => 10.0,
                        'net_amount' => 1724.91,
                        'percent_based' => true,
                        'total_tax' => 172.49,
                    ],
                ],
                'address' => [
                    'address_line_1' => ' ',
                    'city' => NULL,
                    'postal_code' => NULL,
                    'state' => NULL,
                    'country' => 'Australia',
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