<?php

namespace Tests\Unit;

use PHPAccounting\MyobAccountRightLive\Foundation\Exceptions\InvalidRequestException;
use PHPAccounting\MyobAccountRightLive\Gateway;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for request validation.
 *
 * @group unit
 */
class RequestValidationTest extends TestCase
{
    private Gateway $gateway;

    protected function setUp(): void
    {
        parent::setUp();
        $this->gateway = new Gateway();
        $this->gateway->setProduct('accountright_live');
        $this->gateway->setAPIKey('test');
        $this->gateway->setAccessToken('test');
        $this->gateway->setCompanyEndpoint('test-guid/');
    }

    public function testCreateAccountRequiresCode(): void
    {
        $this->expectException(InvalidRequestException::class);
        $this->expectExceptionMessage('code');

        $request = $this->gateway->createAccount([
            'name' => 'Test Account',
            // missing 'code'
        ]);
        $request->getData();
    }

    public function testCreateAccountRequiresName(): void
    {
        $this->expectException(InvalidRequestException::class);
        $this->expectExceptionMessage('name');

        $request = $this->gateway->createAccount([
            'code' => '1000',
            // missing 'name'
        ]);
        $request->getData();
    }

    public function testUpdateAccountRequiresSyncToken(): void
    {
        $this->expectException(InvalidRequestException::class);
        $this->expectExceptionMessage('sync_token');

        $request = $this->gateway->updateAccount([
            'accounting_id' => 'test-id',
            'code' => '1000',
            'name' => 'Test',
            'type' => 'Income',
            'tax_type' => 'GST',
            'accounting_parent_id' => 'parent-id',
            // missing 'sync_token'
        ]);
        $request->getData();
    }

    public function testUpdateContactRequiresSyncToken(): void
    {
        $this->expectException(InvalidRequestException::class);
        $this->expectExceptionMessage('sync_token');

        $request = $this->gateway->updateContact([
            'accounting_id' => 'test-id',
            'is_individual' => true,
            // missing 'sync_token'
        ]);
        $request->getData();
    }

    public function testCreateInvoiceRequiresContact(): void
    {
        $this->expectException(InvalidRequestException::class);
        $this->expectExceptionMessage('contact');

        $request = $this->gateway->createInvoice([
            'invoice_data' => [],
            'gst_registered' => true,
            'gst_inclusive' => 'INCLUSIVE',
            // missing 'contact'
        ]);
        $request->getData();
    }

    public function testCreateInvoiceRequiresInvoiceData(): void
    {
        $this->expectException(InvalidRequestException::class);
        $this->expectExceptionMessage('invoice_data');

        $request = $this->gateway->createInvoice([
            'contact' => 'contact-id',
            'gst_registered' => true,
            'gst_inclusive' => 'INCLUSIVE',
            // missing 'invoice_data'
        ]);
        $request->getData();
    }
}
