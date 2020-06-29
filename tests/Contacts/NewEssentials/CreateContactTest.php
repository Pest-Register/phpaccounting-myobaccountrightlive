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
                'name' => 'Max Yendy Business 1',
                'first_name' => NULL,
                'last_name' => NULL,
                'addresses' =>
                    [
                        [
                            'type' => 'PRIMARY',
                            'address_line_1' => '18 Princes Street',
                            'city' => 'St Kilda',
                            'postal_code' => '3182',
                            'state' => 'Victoria',
                            'country' => 'Australia',
                        ],
                    ],
                'is_individual' => false,
                'email_address' => 'maxbusiness@pestregister.com',
                'phones' =>
                    [
                        [
                            'type' => 'DEFAULT',
                            'area_code' => NULL,
                            'country_code' => NULL,
                            'phone_number' => '0435567535',
                            'accounting_id' => NULL,
                            'accounting_slot_id' => NULL,
                        ],
                    ],
                'type' => ['CUSTOMER'],
                'status' => 'ACTIVE',
                'sync_token' => NULL,
                'website' => 'www.maxyendall.com',
                'tax_type_id' => '50a917ff-65a0-4fff-aa20-f5c541c4f125',
                'freight_tax_type_id' => '50a917ff-65a0-4fff-aa20-f5c541c4f125',
                'reference' => 'MAXYENDYBUSINESS1',
            ];

            $response = $this->gateway->createContact($params)->send();
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