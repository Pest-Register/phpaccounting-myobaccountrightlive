<?php

namespace Tests\Unit;

use PHPAccounting\MyobAccountRightLive\Gateway;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for Gateway class.
 *
 * @group unit
 */
class GatewayTest extends TestCase
{
    private Gateway $gateway;

    protected function setUp(): void
    {
        parent::setUp();
        $this->gateway = new Gateway();
    }

    public function testGetNameReturnsMyob(): void
    {
        $this->assertEquals('Myob', $this->gateway->getName());
    }

    public function testSetAndGetApiKey(): void
    {
        $this->gateway->setAPIKey('test-api-key');
        $this->assertEquals('test-api-key', $this->gateway->getAPIKey());
    }

    public function testSetAndGetAccessToken(): void
    {
        $this->gateway->setAccessToken('test-token');
        $this->assertEquals('test-token', $this->gateway->getAccessToken());
    }

    public function testSetAndGetProduct(): void
    {
        $this->gateway->setProduct('accountright_live');
        $this->assertEquals('accountright_live', $this->gateway->getProduct());
    }

    public function testSetAndGetCompanyEndpoint(): void
    {
        $this->gateway->setCompanyEndpoint('12345-guid/');
        $this->assertEquals('12345-guid/', $this->gateway->getCompanyEndpoint());
    }

    public function testSetAndGetCompanyFile(): void
    {
        $encoded = base64_encode('user:pass');
        $this->gateway->setCompanyFile($encoded);
        $this->assertEquals($encoded, $this->gateway->getCompanyFile());
    }

    public function testSetAndGetCountryCode(): void
    {
        $this->gateway->setCountryCode('au');
        $this->assertEquals('au', $this->gateway->getCountryCode());
    }

    public function testSetBusinessIdPrependsBusinessesPrefix(): void
    {
        $this->gateway->setBusinessID('123456');
        $this->assertEquals('businesses/123456', $this->gateway->getBusinessID());
    }

    public function testCreateAccountRequestReturnsRequestInterface(): void
    {
        $request = $this->gateway->createAccount(['code' => '1000']);

        $this->assertInstanceOf(
            \PHPAccounting\MyobAccountRightLive\Foundation\Contracts\RequestInterface::class,
            $request
        );
    }

    public function testCreateContactRequestReturnsRequestInterface(): void
    {
        $request = $this->gateway->createContact(['name' => 'Test']);

        $this->assertInstanceOf(
            \PHPAccounting\MyobAccountRightLive\Foundation\Contracts\RequestInterface::class,
            $request
        );
    }

    public function testGatewayParametersArePassedToRequest(): void
    {
        $this->gateway->setAPIKey('my-api-key');
        $this->gateway->setProduct('accountright_live');

        $request = $this->gateway->getAccount([]);

        $this->assertEquals('my-api-key', $request->getParameter('apiKey'));
        $this->assertEquals('accountright_live', $request->getParameter('product'));
    }
}
