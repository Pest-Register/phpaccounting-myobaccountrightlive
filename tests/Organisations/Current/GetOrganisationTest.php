<?php


namespace Tests\Organisations\Current;


use Tests\BaseTest;

class GetOrganisationTest extends BaseTest
{
    public function testGetOrganisation()
    {
        $this->setUp();
        try {
            $response = $this->gateway->getOrganisation()->send();
            if ($response->isSuccessful()) {
                var_dump($response->getOrganisations());
            } else {
                var_dump($response->getErrorMessage());
            }
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
        }
    }
}