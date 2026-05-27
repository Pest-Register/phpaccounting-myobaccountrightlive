<?php


namespace Tests\ManualJournals\Legacy;


use Tests\BaseTest;

class CreateManualJournalTest extends BaseTest
{
    public function testCreateManualJournal(){
        $this->setUp();
        try {
            $params = [
                'reference_id' => 'TEST',
                'date' => '2019-01-27',
                'gst_inclusive' => true,
                'narration' => 'A journal transaction note',
                'journal_data' => [
                    [
                        'account_id' => 63240545,
                        'tax_type_id' => '10',
                        'description' => 'Test',
                        'gross_amount' => 550,
                        'tax_amount' => 40,
                        'credit' => true
                    ],
                    [
                        'account_id' => 63240545,
                        'tax_type_id' => '13',
                        'description' => 'Test 2',
                        'gross_amount' => 550,
                        'credit' => false
                    ]
                ]
            ];

            $response = $this->gateway->createManualJournal($params)->send();
            if ($response->isSuccessful()) {
                $this->assertIsArray($response->getData());
                var_dump($response->getManualJournals());
            } else {
                var_dump($response->getErrorMessage());
            }
        } catch (\Exception $exception) {
            var_dump($exception->getTrace());
        }
    }
}