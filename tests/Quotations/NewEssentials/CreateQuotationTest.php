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
                'address' => [
                    'address_line_1' => '18 Princes Street',
                    'city' => 'St Kilda',
                    'postal_code' => '3182',
                    'state' => 'Victoria',
                    'country' => 'Australia'
                ],
                'date' => Carbon::now(),
                'expiry_date' => Carbon::now(),
                'contact' => 'f9db97a3-a4c9-4c66-bf24-8cfab6b3f0ce',
                'email_status' => false,
                'quotation_data' => [
                    [
                        'description' => 'HDMI 2.0 Cables',
                        'accounting_id' => NULL,
                        'amount' => '100.00',
                        'quantity' => 1.0,
                        'unit_amount' => 100.00,
                        'discount_rate' => 0.0,
                        'code' => 'HDMI01',
                        'tax_type' => 'GST',
                        'item_code' => 'HDMI01',
                        'item_id' => 'efc0da97-c866-435d-8f25-18d1c33444d8',
                        'unit' => 'QTY',
                        'tax_id' => '50a917ff-65a0-4fff-aa20-f5c541c4f125',
                        'account_id' => '527d8f24-0175-4e98-addb-faae929b98bf',
                    ]
                ],
                'total_discount' => 0,
                'gst_registered' => true,
                'quotation_number' => '20200714_0004',
                'quotation_reference' => '20200714_0004',
                'total' => 100.00,
                'discount_amount' => '0.00',
                'discount_rate' => '0.0000',
                'gst_inclusive' => 'INCLUSIVE',
                'sync_token' => NULL,
                'total_tax' => 10.00,
                'tax_lines' => [],
                'status' => 'Open'
            ];

            $response = $this->gateway->createQuotation($params)->send();
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