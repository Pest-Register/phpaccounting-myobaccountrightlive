<?php


namespace Tests\Journals;


use Tests\BaseTest;

class GetJournalTest extends BaseTest
{

    public function testGetJournals()
    {
        $this->setUp();
        try {
            $params = [
                'accounting_id' => "3767661b-3d80-42b2-86e2-44128e155123",
                'page' => 1000
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