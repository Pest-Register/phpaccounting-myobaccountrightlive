<?php

namespace Tests\Integration;

use Tests\BaseTest;

/**
 * Integration tests for Account operations.
 * These tests require valid API credentials in .env
 *
 * @group integration
 */
class AccountsIntegrationTest extends BaseTest
{
    public function setUp(): void
    {
        parent::setUp();

        // Skip if no credentials configured
        if (empty($_ENV['ACCESS_TOKEN'] ?? '')) {
            $this->markTestSkipped('API credentials not configured');
        }
    }

    public function testGetAccountsReturnsArray(): void
    {
        $params = [
            'page' => 1
        ];

        $response = $this->gateway->getAccount($params)->send();

        $errorMsg = '';
        if (!$response->isSuccessful()) {
            $error = $response->getErrorMessage();
            $errorMsg = is_array($error) ? json_encode($error) : (string)$error;
        }

        $this->assertTrue($response->isSuccessful(), 'API request failed: ' . $errorMsg);

        $accounts = $response->getAccounts();
        $this->assertIsArray($accounts, 'getAccounts should return an array');
    }

    public function testGetAccountsWithSearchParams(): void
    {
        $params = [
            'search_params' => [
                'Type' => 'Income',
            ],
            'page' => 1
        ];

        $response = $this->gateway->getAccount($params)->send();

        $this->assertTrue($response->isSuccessful(), 'API request should succeed');

        $accounts = $response->getAccounts();
        $this->assertIsArray($accounts);

        // If we got results, verify they match the filter
        foreach ($accounts as $account) {
            $this->assertEquals('Income', $account['type'] ?? null, 'Filtered accounts should be Income type');
        }
    }

    public function testGetSingleAccountById(): void
    {
        // First get an account to get a valid ID
        $listResponse = $this->gateway->getAccount(['page' => 1])->send();
        $this->assertTrue($listResponse->isSuccessful());

        $accounts = $listResponse->getAccounts();
        if (empty($accounts)) {
            $this->markTestSkipped('No accounts available to test single fetch');
        }

        $accountId = $accounts[0]['accounting_id'];

        // Now fetch that specific account
        $response = $this->gateway->getAccount(['accounting_id' => $accountId])->send();

        $this->assertTrue($response->isSuccessful());

        $fetchedAccounts = $response->getAccounts();
        $this->assertCount(1, $fetchedAccounts);
        $this->assertEquals($accountId, $fetchedAccounts[0]['accounting_id']);
    }

    public function testGetAccountsContainsExpectedFields(): void
    {
        $response = $this->gateway->getAccount(['page' => 1])->send();

        $this->assertTrue($response->isSuccessful());

        $accounts = $response->getAccounts();
        if (empty($accounts)) {
            $this->markTestSkipped('No accounts available to verify fields');
        }

        $account = $accounts[0];

        // Verify expected fields exist
        $expectedFields = ['accounting_id', 'code', 'name', 'type'];
        foreach ($expectedFields as $field) {
            $this->assertArrayHasKey($field, $account, "Account should have '$field' field");
        }
    }
}
