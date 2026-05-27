<?php


namespace Tests\Journals\Legacy;


use Tests\BaseTest;

class GetJournalTest extends BaseTest
{

    public function testGetJournals()
    {
        $this->setUp();
        try {
            $params = [
                'accounting_ids' => [""],
                'page' => 1,
                'toDate' => '2019-10-09',
                'fromDate' => '2018-10-09'
            ];

            $response = $this->gateway->getJournal($params)->send();
            if ($response->isSuccessful()) {
                var_dump($response->getJournals());
            } else {
                var_dump($response->getErrorMessage());
            }
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
        }
    }
}