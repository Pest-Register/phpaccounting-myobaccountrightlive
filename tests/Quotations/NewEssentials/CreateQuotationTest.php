<?php


namespace Tests\Quotations;


use Carbon\Carbon;
use Tests\BaseTest;

class CreateQuotationTest extends BaseTest
{
    public function testCreateQuotation(){
        $this->setUp();
        try {

            $params = [
                    'address' =>
                        array (
                            'address_line_1' => '18 Princes Street',
                            'city' => 'St Kilda',
                            'postal_code' => '3182',
                            'state' => 'Victoria',
                            'country' => 'Australia',
                        ),
                    'type' => 'ACCREC',
                    'date' => Carbon::parse('2021-08-31'),
                    'expiry_date' => Carbon::parse('2021-09-14'),
                    'accepted_date' => NULL,
                    'contact' => '72a2268d-b1e7-4f6a-80e7-bd1e8a5425db',
                    'email_status' => NULL,
                    'amount_paid' => NULL,
                    'quotation_data' =>
                        array (
                            0 =>
                                array (
                                    'description' => 'Development Operations Test',
                                    'accounting_id' => NULL,
                                    'amount' => 130.0,
                                    'quantity' => 1,
                                    'unit_amount' => 130.0,
                                    'discount_rate' => '0.0000000000',
                                    'item_code' => 'DEV-OPS1',
                                    'item_id' => '3e139c99-077a-4141-abd8-7c0d8686cbac',
                                    'unit' => 'QTY',
                                    'tax_id' => '50a917ff-65a0-4fff-aa20-f5c541c4f125',
                                    'tax_type' => 'GST',
                                    'account_id' => '8e52f2a4-0770-4e1f-972e-305b8eb4295f',
                                    'code' => '002',
                                    'tax_inclusive_amount' => 143.0,
                                ),
                            1 =>
                                array (
                                    'description' => 'Test Refresh Token',
                                    'accounting_id' => NULL,
                                    'amount' => 186.36,
                                    'quantity' => 1,
                                    'unit_amount' => 186.36,
                                    'discount_rate' => '20.0000000000',
                                    'item_code' => 'TEST03',
                                    'item_id' => '5bbf85f3-26cf-4e25-b991-712ed489d442',
                                    'unit' => 'QTY',
                                    'tax_id' => '50a917ff-65a0-4fff-aa20-f5c541c4f125',
                                    'tax_type' => 'GST',
                                    'account_id' => '8e52f2a4-0770-4e1f-972e-305b8eb4295f',
                                    'code' => '002',
                                    'tax_inclusive_amount' => 205.0,
                                ),
                        ),
                    'total_discount' => 0,
                    'gst_registered' => true,
                    'quotation_number' => '0001',
                    'quotation_reference' => '0001',
                    'total' => 0.0,
                    'discount_amount' => 0.0,
                    'discount_rate' => '0.00',
                    'deposit_amount' => NULL,
                    'gst_inclusive' => 'INCLUSIVE',
                    'sync_token' => NULL,
                    'total_tax' => '27.91',
                    'sub_total_before_tax' => '316.3600000000',
                    'sub_total_after_tax' => '307.0000000000',
                    'status' => 'Open',
                ];

            $response = $this->gateway->createQuotation($params)->send();
            var_dump($response);
            if ($response->isSuccessful()) {
                $this->assertIsArray($response->getData());
                var_dump($response->getQuotations());
            } else {
                var_dump($response->getErrorMessage());
            }
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
        }
    }
}