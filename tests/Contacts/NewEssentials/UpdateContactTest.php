<?php


namespace Tests\Contacts\NewEssentials;

use Tests\BaseTest;
use Faker;
class UpdateContactTest extends BaseTest
{
    public function testUpdateContacts()
    {
        $this->setUp();
        $faker = Faker\Factory::create();
        try {
//            $params = [
//                'accounting_id' => '779d009a-e138-4629-af2d-e68adb9d8858',
//                'reference' => '1',
//                'first_name' => $faker->firstName,
//                'last_name' => $faker->lastName,
//                'email_address' => $faker->email,
//                'status' => 'ACTIVE',
//                'type' => ['CUSTOMER'],
//                'is_individual' => true,
//                'tax_type_id' => '50a917ff-65a0-4fff-aa20-f5c541c4f125',
//                'freight_tax_type_id' => '50a917ff-65a0-4fff-aa20-f5c541c4f125',
//                'sync_token' => '1382605085602742272',
//                'addresses' => [
//                    [
//                        'type' => 'BILLING',
//                        'address_line_1' => $faker->streetAddress,
//                        'city' => $faker->city,
//                        'postal_code' => $faker->postcode,
//                        'country' => $faker->country,
//                        'contact_name' => $faker->name,
//                        'salutation' => 'test'
//                    ],
//                    [
//                        'type' => 'PRIMARY',
//                        'address_line_1' => $faker->streetAddress,
//                        'city' => $faker->city,
//                        'postal_code' => $faker->postcode,
//                        'country' => $faker->country,
//                        'contact_name' => $faker->name,
//                        'salutation' => 'test',
//                        'email' => $faker->email,
//                        'website' => $faker->url
//                    ]
//                ],
//                'phones' => [
//                    [
//                        'country_code' => '',
//                        'area_code' => '',
//                        'phone_number' => '0415143787',
//                        'type' => 'MOBILE',
//                        'accounting_id' => 1,
//                        'accounting_slot_id' => 0
//                    ],
//                    [
//                        'country_code' => '',
//                        'area_code' => '',
//                        'phone_number' => 'Fax as',
//                        'type' => 'FAX',
//                        'accounting_id' => 1,
//                        'accounting_slot_id' => 'Fax'
//                    ],
//                    [
//                        'country_code' => '',
//                        'area_code' => '',
//                        'phone_number' => '0435567535',
//                        'type' => 'FAX',
//                        'accounting_id' => 2,
//                        'accounting_slot_id' => 'Fax'
//                    ],
//                    [
//                        'country_code' => '',
//                        'area_code' => '',
//                        'phone_number' => '0435567535',
//                        'type' => 'MOBILE',
//                        'accounting_id' => null,
//                        'accounting_slot_id' => null
//                    ],
//                    [
//                        'country_code' => '',
//                        'area_code' => '',
//                        'phone_number' => '0435567535',
//                        'type' => 'MOBILE',
//                        'accounting_id' => null,
//                        'accounting_slot_id' => null
//                    ]
//                ]
//            ];

            $params = [
                'accounting_id' => '5a225a1e-994f-4f9a-81ae-d94daa31b3ec',
                'name' => 'Max Yendy',
                'first_name' => 'Max',
                'last_name' => 'Yendy',
                'addresses' =>
                    [
                        [
                            'type' => 'BILLING',
                            'contact_name' => '',
                            'salutation' => '',
                            'address_line_1' => '22 Muswellbrook Grove',
                            'city' => 'Mernda',
                            'postal_code' => '3754',
                            'state' => 'Victoria',
                            'country' => 'Australia',
                        ],

                        [
                            'type' => 'PRIMARY',
                            'contact_name' => '',
                            'salutation' => '',
                            'email' => '',
                            'website' => '',
                            'address_line_1' => ' ',
                            'city' => NULL,
                            'postal_code' => NULL,
                            'state' => NULL,
                            'country' => 'Australia',
                        ],
                    ],
                'is_individual' => true,
                'email_address' => NULL,
                'phones' =>
                    [
                        [
                            'type' => 'DEFAULT',
                            'area_code' => NULL,
                            'country_code' => NULL,
                            'phone_number' => '0435567535',
                            'accounting_id' => NULL,
                            'accounting_slot_id' => '0',
                        ],
                        [
                            'type' => 'EXTRA',
                            'area_code' => NULL,
                            'country_code' => NULL,
                            'phone_number' => '0435567535',
                            'accounting_id' => NULL,
                            'accounting_slot_id' => '1',
                        ],
                    ],
                'type' => ['CUSTOMER'],
                'status' => 'ACTIVE',
                'sync_token' => '1878282519590207488',
                'website' => NULL,
                'tax_type' => NULL,
                'freight_tax_type' => NULL,
                'reference' => 'XUMKO6PN',
            ];

            $response = $this->gateway->updateContact($params)->send();
            if ($response->isSuccessful()) {
                $contacts = $response->getContacts();
                var_dump($contacts);
                $this->assertIsArray($contacts);
            } else {
                var_dump($response->getErrorMessage());
            }
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
        }
    }
}