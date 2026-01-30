<?php

namespace Tests\Unit;

use PHPAccounting\MyobAccountRightLive\Foundation\Contracts\RequestInterface;
use PHPAccounting\MyobAccountRightLive\Message\Accounts\Responses\GetAccountResponse;
use PHPAccounting\MyobAccountRightLive\Message\Contacts\Responses\GetContactResponse;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for response parsing.
 *
 * @group unit
 */
class ResponseParsingTest extends TestCase
{
    private function createMockRequest(): RequestInterface
    {
        return new class implements RequestInterface {
            public string $model = 'Test';

            public function getData() { return []; }
            public function send() { return null; }
            public function getParameters(): array { return []; }
            public function getParameter(string $key) { return null; }
            public function setParameter(string $key, $value) { return $this; }
        };
    }

    public function testGetAccountResponseParsesAccountData(): void
    {
        $mockData = [
            'Items' => [
                [
                    'UID' => 'test-uid-123',
                    'DisplayID' => '1-1000',
                    'Name' => 'Sales Account',
                    'Description' => 'Test description',
                    'Type' => 'Income',
                    'IsHeader' => false,
                    'RowVersion' => '12345',
                ]
            ]
        ];

        $response = new GetAccountResponse($this->createMockRequest(), $mockData);

        $this->assertTrue($response->isSuccessful());

        $accounts = $response->getAccounts();
        $this->assertCount(1, $accounts);

        $account = $accounts[0];
        $this->assertEquals('test-uid-123', $account['accounting_id']);
        $this->assertEquals('1-1000', $account['code']);
        $this->assertEquals('Sales Account', $account['name']);
        $this->assertEquals('Income', $account['type']);
        $this->assertEquals('12345', $account['sync_token']);
    }

    public function testGetAccountResponseHandlesEmptyItems(): void
    {
        $mockData = [
            'Items' => []
        ];

        $response = new GetAccountResponse($this->createMockRequest(), $mockData);

        $this->assertFalse($response->isSuccessful());
        $accounts = $response->getAccounts();
        $this->assertEmpty($accounts);
    }

    public function testGetAccountResponseHandlesSingleAccount(): void
    {
        // When fetching by ID, MYOB returns the object directly, not in Items array
        $mockData = [
            'UID' => 'single-uid',
            'DisplayID' => '1-2000',
            'Name' => 'Single Account',
            'Type' => 'Expense',
        ];

        $response = new GetAccountResponse($this->createMockRequest(), $mockData);

        $this->assertTrue($response->isSuccessful());

        $accounts = $response->getAccounts();
        $this->assertCount(1, $accounts);
        $this->assertEquals('single-uid', $accounts[0]['accounting_id']);
    }

    public function testGetAccountResponseHandlesErrorResponse(): void
    {
        $mockData = [
            'Errors' => [
                [
                    'Severity' => 'Error',
                    'ErrorCode' => 12345,
                    'Message' => 'Something went wrong',
                    'AdditionalDetails' => 'More info here'
                ]
            ]
        ];

        $response = new GetAccountResponse($this->createMockRequest(), $mockData);

        $this->assertFalse($response->isSuccessful());

        $error = $response->getErrorMessage();
        $this->assertIsArray($error);
        $this->assertStringContainsString('Something went wrong', $error['message'] ?? '');
    }

    public function testGetContactResponseParsesContactData(): void
    {
        $mockData = [
            'Items' => [
                [
                    'UID' => 'contact-uid-123',
                    'FirstName' => 'John',
                    'LastName' => 'Doe',
                    'IsIndividual' => true,
                    'CompanyName' => '',
                    'RowVersion' => '67890',
                    'Type' => 'Customer',
                    'Addresses' => [],
                ]
            ]
        ];

        $response = new GetContactResponse($this->createMockRequest(), $mockData);

        $this->assertTrue($response->isSuccessful());

        $contacts = $response->getContacts();
        $this->assertCount(1, $contacts);

        $contact = $contacts[0];
        $this->assertEquals('contact-uid-123', $contact['accounting_id']);
        $this->assertEquals('John', $contact['first_name']);
        $this->assertEquals('Doe', $contact['last_name']);
        $this->assertTrue($contact['is_individual']);
        $this->assertEquals('67890', $contact['sync_token']);
    }

    public function testResponseHandlesNullData(): void
    {
        $response = new GetAccountResponse($this->createMockRequest(), null);

        $this->assertTrue($response->isSuccessful()); // null is considered "no error"
        $this->assertEmpty($response->getAccounts());
    }

    public function testResponseFailsOnHttpError(): void
    {
        // HTTP 401 should be detected as failure even with valid-looking data
        $mockData = [
            'Items' => [
                ['UID' => 'test-uid', 'Name' => 'Test']
            ]
        ];

        $response = new GetAccountResponse($this->createMockRequest(), $mockData, [], 401);

        $this->assertFalse($response->isSuccessful());
        $this->assertEquals(401, $response->getHttpStatusCode());
    }

    public function testResponseSucceedsOn200(): void
    {
        $mockData = [
            'Items' => [
                ['UID' => 'test-uid', 'Name' => 'Test', 'IsHeader' => false]
            ]
        ];

        $response = new GetAccountResponse($this->createMockRequest(), $mockData, [], 200);

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals(200, $response->getHttpStatusCode());
    }

    public function testResponseDetectsErrorSeverityCorrectly(): void
    {
        // This tests the fixed operator precedence bug
        // The old code had: !$this->data['Errors'][0]['Severity'] == 'Error'
        // Which evaluates as: (!$this->data['Errors'][0]['Severity']) == 'Error'
        // The fix is: $this->data['Errors'][0]['Severity'] !== 'Error'

        $mockData = [
            'Errors' => [
                [
                    'Severity' => 'Error',
                    'Message' => 'Test error'
                ]
            ]
        ];

        $response = new GetAccountResponse($this->createMockRequest(), $mockData);

        // This should now correctly return false
        $this->assertFalse($response->isSuccessful());
    }

    public function testResponseAllowsWarningsSeverity(): void
    {
        $mockData = [
            'Errors' => [
                [
                    'Severity' => 'Warning',
                    'Message' => 'Just a warning'
                ]
            ]
        ];

        $response = new GetAccountResponse($this->createMockRequest(), $mockData);

        // Warnings are not errors, so this should succeed
        $this->assertTrue($response->isSuccessful());
    }

    public function testResponseHandles404NotFound(): void
    {
        $mockData = [
            'Message' => 'Resource not found'
        ];

        $response = new GetAccountResponse($this->createMockRequest(), $mockData, [], 404);

        $this->assertFalse($response->isSuccessful());
        $this->assertEquals(404, $response->getHttpStatusCode());
    }

    public function testResponseHandles500ServerError(): void
    {
        $response = new GetAccountResponse($this->createMockRequest(), null, [], 500);

        $this->assertFalse($response->isSuccessful());
        $this->assertEquals(500, $response->getHttpStatusCode());
    }
}
