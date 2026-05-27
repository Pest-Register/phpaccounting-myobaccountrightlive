<?php

namespace Tests\Integration;

use Tests\BaseTest;

/**
 * Integration tests for Tax Rate operations.
 *
 * @group integration
 */
class TaxRatesIntegrationTest extends BaseTest
{
    public function setUp(): void
    {
        parent::setUp();

        if (empty($_ENV['ACCESS_TOKEN'] ?? '')) {
            $this->markTestSkipped('API credentials not configured');
        }
    }

    public function testGetTaxRatesReturnsArray(): void
    {
        $response = $this->gateway->getTaxRate(['page' => 1])->send();

        $this->assertTrue($response->isSuccessful(), 'API request should succeed');

        $taxRates = $response->getTaxRates();
        $this->assertIsArray($taxRates);
        $this->assertNotEmpty($taxRates, 'Should have at least one tax rate');
    }

    public function testGetTaxRatesContainsExpectedFields(): void
    {
        $response = $this->gateway->getTaxRate(['page' => 1])->send();

        $this->assertTrue($response->isSuccessful());

        $taxRates = $response->getTaxRates();
        $this->assertNotEmpty($taxRates);

        $taxRate = $taxRates[0];

        $expectedFields = ['accounting_id', 'name'];
        foreach ($expectedFields as $field) {
            $this->assertArrayHasKey($field, $taxRate, "Tax rate should have '$field' field");
        }
    }

    public function testGetSingleTaxRateById(): void
    {
        $listResponse = $this->gateway->getTaxRate(['page' => 1])->send();
        $this->assertTrue($listResponse->isSuccessful());

        $taxRates = $listResponse->getTaxRates();
        $this->assertNotEmpty($taxRates);

        $taxRateId = $taxRates[0]['accounting_id'];

        $response = $this->gateway->getTaxRate(['accounting_id' => $taxRateId])->send();

        $this->assertTrue($response->isSuccessful());

        $fetchedRates = $response->getTaxRates();
        $this->assertCount(1, $fetchedRates);
        $this->assertEquals($taxRateId, $fetchedRates[0]['accounting_id']);
    }
}
