<?php

namespace Tests\Invoices\NewEssentials;


use Carbon\Carbon;
use Tests\BaseTest;

class CreateInvoiceTest extends BaseTest
{
    public function testCreateInvoice(){
        $this->setUp();
        try {

            $params = [
                    'address' => [
                        'address_line_1' => '18 Princes Street',
                        'city' => 'St Kilda',
                        'postal_code' => '3182',
                        'state' => 'Victoria',
                        'country' => 'Australia'
                    ],
                    'type' => 'ACCREC',
                    'date' => Carbon::now(),
                    'due_date' => Carbon::now(),
                    'contact' => '2b45792a-3128-4af6-b2f6-e9586df8bcd0',
                    'email_status' => false,
                    'amount_paid' => 0.0,
                    'amount_due' => 350.0,
                    'invoice_data' => [
                            [
                                'description' => 'Testing Selling Ledger',
                                'accounting_id' => NULL,
                                'amount' => '150.0000',
                                'quantity' => 1.0,
                                'unit_amount' => 150.0,
                                'discount_rate' => 0.0,
                                'code' => 14270,
                                'tax_type' => 'GST',
                                'item_code' => 'TEST05',
                                'item_id' => '4a854435-a6e7-4abb-84ff-3cfcec10ce1f',
                                'unit' => 'QTY',
                                'tax_id' => '50a917ff-65a0-4fff-aa20-f5c541c4f125',
                                'account_id' => '8e52f2a4-0770-4e1f-972e-305b8eb4295f',
                            ],
                            [
                                'description' => 'Test Array Seek',
                                'accounting_id' => NULL,
                                'amount' => '200.0000',
                                'quantity' => 1.0,
                                'unit_amount' => 200.0,
                                'discount_rate' => 0.0,
                                'code' => 14270,
                                'tax_type' => 'GST',
                                'item_code' => 'TEST04',
                                'item_id' => 'e317ebf2-ff6d-42e7-a1ca-29936fa53883',
                                'unit' => 'QTY',
                                'tax_id' => '50a917ff-65a0-4fff-aa20-f5c541c4f125',
                                'account_id' => '8e52f2a4-0770-4e1f-972e-305b8eb4295f',
                            ],
                    ],
                    'total_discount' => 0,
                    'gst_registered' => false,
                    'invoice_number' => '20200714_0004',
                    'invoice_reference' => '20200714_0004',
                    'total' => 350.0,
                    'discount_amount' => '0.00',
                    'discount_rate' => '0.0000',
                    'deposit_amount' => NULL,
                    'gst_inclusive' => 'INCLUSIVE',
                    'sync_token' => NULL,
                    'total_tax' => 31.82,
                    'tax_lines' => [],
                    'status' => 'Open'
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