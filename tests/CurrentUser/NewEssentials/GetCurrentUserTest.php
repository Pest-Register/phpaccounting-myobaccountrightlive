<?php


namespace Tests\CurrentUser;


use Tests\BaseTest;

class GetCurrentUserTest extends BaseTest
{

    public function testGetCurrentUser()
    {
        $this->setUp();
        try {

            $response = $this->gateway->getCurrentUser()->send();
            if ($response->isSuccessful()) {
                var_dump($response->getCurrentUser());
            } else {
                var_dump($response->getErrorMessage());
            }
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
        }
    }
}