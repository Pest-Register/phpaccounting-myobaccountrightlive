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
                'reference' => 'CUS0004',
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email_address' => $faker->email,
                'status' => 'ACTIVE',
                'type' => ['CUSTOMER'],
                'is_individual' => true,
                'tax_type_id' => '50a917ff-65a0-4fff-aa20-f5c541c4f125',
                'freight_tax_type_id' => '50a917ff-65a0-4fff-aa20-f5c541c4f125',
                'addresses' => [
                    [
                        'type' => 'BILLING',
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
                        'type' => 'MOBILE',
                        'accounting_id' => 0,
                        'accounting_slot_id' => 0
                    ],
                    [
                        'country_code' => '',
                        'area_code' => '',
                        'phone_number' => '0435567535',
                        'type' => 'FAX',
                        'accounting_id' => 0,
                        'accounting_slot_id' => 'Fax'
                    ],
                    [
                        'country_code' => '',
                        'area_code' => '',
                        'phone_number' => '0435567535',
                        'type' => 'FAX',
                        'accounting_id' => 1,
                        'accounting_slot_id' => 'Fax'
                    ],
                    [
                        'country_code' => '',
                        'area_code' => '',
                        'phone_number' => '0435567535',
                        'type' => 'MOBILE',
                        'accounting_id' => null,
                        'accounting_slot_id' => null
                    ],
                    [
                        'country_code' => '',
                        'area_code' => '',
                        'phone_number' => '0435567535',
                        'type' => 'MOBILE',
                        'accounting_id' => null,
                        'accounting_slot_id' => null
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