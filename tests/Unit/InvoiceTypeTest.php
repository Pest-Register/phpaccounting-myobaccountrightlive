<?php

namespace Tests\Unit;

use PHPAccounting\MyobAccountRightLive\Gateway;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for invoice type support.
 *
 * @group unit
 */
class InvoiceTypeTest extends TestCase
{
    private Gateway $gateway;

    protected function setUp(): void
    {
        parent::setUp();
        $this->gateway = new Gateway();
        $this->gateway->setProduct('accountright_live');
    }

    public function testCreateInvoiceDefaultsToItemType(): void
    {
        $request = $this->gateway->createInvoice([]);
        $endpoint = $request->getEndpoint();

        $this->assertStringContainsString('Sale/Invoice/Item', $endpoint);
    }

    public function testCreateInvoiceWithServiceType(): void
    {
        $request = $this->gateway->createInvoice([
            'invoice_type' => 'Service'
        ]);
        $endpoint = $request->getEndpoint();

        $this->assertStringContainsString('Sale/Invoice/Service', $endpoint);
    }

    public function testCreateInvoiceWithProfessionalType(): void
    {
        $request = $this->gateway->createInvoice([
            'invoice_type' => 'Professional'
        ]);
        $endpoint = $request->getEndpoint();

        $this->assertStringContainsString('Sale/Invoice/Professional', $endpoint);
    }

    public function testUpdateInvoiceWithInvoiceType(): void
    {
        $request = $this->gateway->updateInvoice([
            'invoice_type' => 'TimeBilling',
            'accounting_id' => 'test-id'
        ]);
        $endpoint = $request->getEndpoint();

        $this->assertStringContainsString('Sale/Invoice/TimeBilling', $endpoint);
    }

    /**
     * @dataProvider invoiceTypeProvider
     */
    public function testAllInvoiceTypesAreSupported(string $type): void
    {
        $request = $this->gateway->createInvoice([
            'invoice_type' => $type
        ]);
        $endpoint = $request->getEndpoint();

        $this->assertStringContainsString("Sale/Invoice/$type", $endpoint);
    }

    public static function invoiceTypeProvider(): array
    {
        return [
            'Item' => ['Item'],
            'Service' => ['Service'],
            'Professional' => ['Professional'],
            'TimeBilling' => ['TimeBilling'],
            'Miscellaneous' => ['Miscellaneous'],
        ];
    }
}
