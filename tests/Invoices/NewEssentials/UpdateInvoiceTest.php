<?php


namespace Tests\Invoices\NewEssentials;


use Carbon\Carbon;
use Tests\BaseTest;

class UpdateInvoiceTest extends BaseTest
{
    public function testUpdateInvoices(){
        $this->setUp();
        try {
            $params = [
                'accounting_id' => '7b9db40b-51e0-4d24-b7cb-8a4fe0c8aa0f',
                'address' => [],
                'type' => 'ACCREC',
                'date' => Carbon::create('2020-07-29'),
                'due_date' => Carbon::create('2020-09-04'),
                'contact' => '09994328-1238-4670-baec-b567747f429b',
                'email_status' => false,
                'amount_paid' => 0.0,
                'amount_due' => 334.0,
                'sync_token' => '5957136407104323584',
                'invoice_data' => [
                    [
                        'description' => 'Testing Selling Ledger',
                        'accounting_id' => NULL,
                        'amount' => 132.0,
                        'sync_token' => '6450562041278103552',
                        'quantity' => 1.0,
                        'unit_amount' => 132.0,
                        'discount_rate' => 0.0,
                        'code' => 18440,
                        'tax_type' => 'GST',
                        'item_code' => 'TEST05',
                        'item_id' => '4a854435-a6e7-4abb-84ff-3cfcec10ce1f',
                        'unit' => 'QTY',
                        'tax_id' => '50a917ff-65a0-4fff-aa20-f5c541c4f125',
                        'account_id' => '8e52f2a4-0770-4e1f-972e-305b8eb4295f',
                    ],
                    [
                        'description' => 'Test Refresh Token',
                        'accounting_id' => NULL,
                        'amount' => 202.0,
                        'sync_token' => '6522619635316031488',
                        'quantity' => 1.0,
                        'unit_amount' => 202.0,
                        'discount_rate' => 0.0,
                        'code' => 18425,
                        'tax_type' => 'N-T',
                        'item_code' => 'TEST03',
                        'item_id' => '5bbf85f3-26cf-4e25-b991-712ed489d442',
                        'unit' => 'QTY',
                        'tax_id' => '8d9cfae6-0f23-4c3e-904e-3e212cf67156',
                        'account_id' => '70f0be25-6b47-4cf2-9418-08673b35a0ec',
                      ],
                ],
                'total_discount' => 0,
                'gst_registered' => true,
                'invoice_number' => '00000017',
                'invoice_reference' => '00000017',
                'total' => 334.0,
                'discount_amount' => '0.00',
                'discount_rate' => '0.0000',
                'deposit_amount' => NULL,
                'gst_inclusive' => 'INCLUSIVE',
                'total_tax' => 12.0,
                'tax_lines' => ['status' => 'Open']
            ];

            $response = $this->gateway->updateInvoice($params)->send();
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