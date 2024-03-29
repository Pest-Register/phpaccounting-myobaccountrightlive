<?php

namespace Tests;


/**
 * Created by IntelliJ IDEA.
 * User: Dylan
 * Date: 14/05/2019
 * Time: 9:54 AM
 */

class GetContactTest extends BaseTest
{

    public function testGetContacts()
    {
        $this->setUp();
        $params = [
//            'search_params' => [
//                'FirstName' => 'Brice',
//                'LastName' => 'Yendy'
//            ],
//            'accounting_id' => "",
//            'page' => 1000,
//            'skip' => 0
        ];

        try {

            $response = $this->gateway->getContact($params)->send();
            if ($response->isSuccessful()) {
                var_dump($response->getContacts());
            } else {
                var_dump($response->getErrorMessage());
            }
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
        }
    }
}
