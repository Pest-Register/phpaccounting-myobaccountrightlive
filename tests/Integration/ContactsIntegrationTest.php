<?php

namespace Tests\Integration;

use Tests\BaseTest;

/**
 * Integration tests for Contact operations.
 *
 * @group integration
 */
class ContactsIntegrationTest extends BaseTest
{
    public function setUp(): void
    {
        parent::setUp();

        if (empty($_ENV['ACCESS_TOKEN'] ?? '')) {
            $this->markTestSkipped('API credentials not configured');
        }
    }

    public function testGetContactsReturnsArray(): void
    {
        $response = $this->gateway->getContact(['page' => 1])->send();

        $this->assertTrue($response->isSuccessful(), 'API request should succeed');

        $contacts = $response->getContacts();
        $this->assertIsArray($contacts);
    }

    public function testGetSingleContactById(): void
    {
        // First get a contact to get a valid ID
        $listResponse = $this->gateway->getContact(['page' => 1])->send();
        $this->assertTrue($listResponse->isSuccessful());

        $contacts = $listResponse->getContacts();
        if (empty($contacts)) {
            $this->markTestSkipped('No contacts available');
        }

        $contactId = $contacts[0]['accounting_id'];

        $response = $this->gateway->getContact(['accounting_id' => $contactId])->send();

        $this->assertTrue($response->isSuccessful());

        $fetchedContacts = $response->getContacts();
        $this->assertCount(1, $fetchedContacts);
        $this->assertEquals($contactId, $fetchedContacts[0]['accounting_id']);
    }

    public function testGetContactsContainsExpectedFields(): void
    {
        $response = $this->gateway->getContact(['page' => 1])->send();

        $this->assertTrue($response->isSuccessful());

        $contacts = $response->getContacts();
        if (empty($contacts)) {
            $this->markTestSkipped('No contacts available');
        }

        $contact = $contacts[0];

        $expectedFields = ['accounting_id', 'display_name', 'is_individual'];
        foreach ($expectedFields as $field) {
            $this->assertArrayHasKey($field, $contact, "Contact should have '$field' field");
        }
    }

    public function testGetContactsWithSearchParams(): void
    {
        // First get any contact to know a valid name to search
        $listResponse = $this->gateway->getContact(['page' => 1])->send();
        $this->assertTrue($listResponse->isSuccessful());

        $contacts = $listResponse->getContacts();
        if (empty($contacts)) {
            $this->markTestSkipped('No contacts available');
        }

        // Search by the first contact's name
        $searchName = $contacts[0]['display_name'] ?? '';
        if (empty($searchName)) {
            $this->markTestSkipped('Contact has no display name');
        }

        $params = [
            'search_params' => [
                'CompanyName' => $searchName,
            ],
        ];

        $searchResponse = $this->gateway->getContact($params)->send();
        $this->assertTrue($searchResponse->isSuccessful());
    }
}
