<?php

namespace Tests\Integration;

use Tests\BaseTest;

/**
 * Integration tests for Invoice operations.
 *
 * @group integration
 */
class InvoicesIntegrationTest extends BaseTest
{
    public function setUp(): void
    {
        parent::setUp();

        if (empty($_ENV['ACCESS_TOKEN'] ?? '')) {
            $this->markTestSkipped('API credentials not configured');
        }
    }

    public function testGetInvoicesReturnsArray(): void
    {
        $response = $this->gateway->getInvoice(['page' => 1])->send();

        $this->assertTrue($response->isSuccessful(), 'API request should succeed');

        $invoices = $response->getInvoices();
        $this->assertIsArray($invoices);
    }

    public function testGetSingleInvoiceById(): void
    {
        $listResponse = $this->gateway->getInvoice(['page' => 1])->send();
        $this->assertTrue($listResponse->isSuccessful());

        $invoices = $listResponse->getInvoices();
        if (empty($invoices)) {
            $this->markTestSkipped('No invoices available');
        }

        $invoiceId = $invoices[0]['accounting_id'];

        $response = $this->gateway->getInvoice(['accounting_id' => $invoiceId])->send();

        $this->assertTrue($response->isSuccessful());

        $fetchedInvoices = $response->getInvoices();
        $this->assertCount(1, $fetchedInvoices);
        $this->assertEquals($invoiceId, $fetchedInvoices[0]['accounting_id']);
    }

    public function testGetInvoicesContainsExpectedFields(): void
    {
        $response = $this->gateway->getInvoice(['page' => 1])->send();

        $this->assertTrue($response->isSuccessful());

        $invoices = $response->getInvoices();
        if (empty($invoices)) {
            $this->markTestSkipped('No invoices available');
        }

        $invoice = $invoices[0];

        $expectedFields = ['accounting_id', 'total', 'status'];
        foreach ($expectedFields as $field) {
            $this->assertArrayHasKey($field, $invoice, "Invoice should have '$field' field");
        }
    }

    public function testGetInvoicesByStatus(): void
    {
        $params = [
            'search_params' => [
                'Status' => 'Open',
            ],
            'page' => 1
        ];

        $response = $this->gateway->getInvoice($params)->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertIsArray($response->getInvoices());
    }
}
