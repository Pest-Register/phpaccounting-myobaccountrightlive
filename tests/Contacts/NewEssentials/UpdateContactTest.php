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

            $params = [
                'accounting_id' => 'c66ae46d-d3ca-4283-a2ea-f9cfff0ee177',
                'reference' => 'CUS0004',
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email_address' => $faker->email,
                'status' => 'ACTIVE',
                'type' => ['CUSTOMER'],
                'is_individual' => true,
                'tax_type_id' => '50a917ff-65a0-4fff-aa20-f5c541c4f125',
                'freight_tax_type_id' => '50a917ff-65a0-4fff-aa20-f5c541c4f125',
                'sync_token' => '-2656842305171881984',
                'addresses' => [
                    [
                        'type' => 'BILLING',
                        'address_line_1' => $faker->streetAddress,
                        'city' => $faker->city,
                        'postal_code' => $faker->postcode,
                        'country' => $faker->country,
                        'contact_name' => $faker->name,
                        'salutation' => $faker->name
                    ],
                    [
                        'type' => 'PRIMARY',
                        'address_line_1' => $faker->streetAddress,
                        'city' => $faker->city,
                        'postal_code' => $faker->postcode,
                        'country' => $faker->country,
                        'contact_name' => $faker->name,
                        'salutation' => $faker->name,
                        'email' => $faker->email,
                        'website' => $faker->url
                    ]
                ],
                'phones' => [
                    [
                        'country_code' => '',
                        'area_code' => '',
                        'phone_number' => '0415143787',
                        'type' => 'MOBILE',
                        'accounting_id' => 1,
                        'accounting_slot_id' => 0
                    ],
                    [
                        'country_code' => '',
                        'area_code' => '',
                        'phone_number' => 'Fax as',
                        'type' => 'FAX',
                        'accounting_id' => 1,
                        'accounting_slot_id' => 'Fax'
                    ],
                    [
                        'country_code' => '',
                        'area_code' => '',
                        'phone_number' => '0435567535',
                        'type' => 'FAX',
                        'accounting_id' => 2,
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

            $response = $this->gateway->updateContact($params)->send();
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