<?php

namespace Tests;
use Faker;
class CreateContactTest extends BaseTest
{
    public function testCreateContacts()
    {
        $this->setUp();
        $faker = Faker\Factory::create();
        try {

            $params = [
                'name' => $faker->name,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email_address' => $faker->email,
                'status' => 'ACTIVE',
                'type' => ['CUSTOMER'],
                'addresses' => [
                    [
                        'type' => 'PRIMARY',
                        'address_line_1' => $faker->streetAddress,
                        'city' => $faker->city,
                        'postal_code' => $faker->postcode,
                        'country' => $faker->country
                    ]
                ],
                'phones' => [
                    [
                        'country_code' => '',
                        'area_code' => '',
                        'phone_number' => '0435567535',
                        'type' => 'MOBILE'
                    ]
                ]
            ];

            $response = $this->gateway->createContact($params)->send();
            var_dump($response);
            if ($response->isSuccessful()) {
                $contacts = $response->getContacts();
                $this->assertIsArray($contacts);
            } else {
                var_dump($response->getErrorMessage());
            }
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
        }
    }
}