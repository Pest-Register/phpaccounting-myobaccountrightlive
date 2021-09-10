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
                'accounting_id' => '779d009a-e138-4629-af2d-e68adb9d8858',
                'name' => 'Brice Yundt 2',
                'first_name' => 'Brice',
                'last_name' => 'Yundt 2',
                'addresses' =>
                    array (
                        0 =>
                            array (
                                'type' => 'BILLING',
                                'address_line_1' => '45450 McKenzie Bypass',
                                'city' => NULL,
                                'postal_code' => '14490-7886',
                                'state' => '',
                                'country' => 'Marshall Islands',
                            ),
                        1 =>
                            array (
                                'type' => 'PRIMARY',
                                'address_line_1' => '5253 Bria Rest',
                                'city' => '',
                                'postal_code' => '06784',
                                'state' => '',
                                'country' => 'Kuwait',
                            ),
                    ),
                'is_individual' => true,
                'email_address' => 'test@test.com',
                'phones' =>
                    array (
                        0 =>
                            array (
                                'type' => 'DEFAULT',
                                'area_code' => NULL,
                                'country_code' => NULL,
                                'phone_number' => '0411234566',
                                'accounting_id' => NULL,
                                'accounting_slot_id' => '0',
                            ),
                        1 =>
                            array (
                                'type' => 'EXTRA',
                                'area_code' => NULL,
                                'country_code' => NULL,
                                'phone_number' => '0411234565',
                                'accounting_id' => NULL,
                                'accounting_slot_id' => '1',
                            ),
                        2 =>
                            array (
                                'type' => 'EXTRA',
                                'area_code' => NULL,
                                'country_code' => NULL,
                                'phone_number' => '0411234566',
                                'accounting_id' => NULL,
                                'accounting_slot_id' => '2',
                            ),
                        3 =>
                            array (
                                'type' => 'EXTRA',
                                'area_code' => NULL,
                                'country_code' => NULL,
                                'phone_number' => '0411276566',
                                'accounting_id' => NULL,
                                'accounting_slot_id' => '0',
                            ),
                    ),
                'type' =>
                    array (
                        0 => 'CUSTOMER',
                    ),
                'status' => 'ACTIVE',
                'sync_token' => '-904659475636420608',
                'website' => NULL,
                'tax_type_id' => '50a917ff-65a0-4fff-aa20-f5c541c4f125',
                'freight_tax_type_id' => '50a917ff-65a0-4fff-aa20-f5c541c4f125',
                'reference' => 'BJBGZDCM',
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