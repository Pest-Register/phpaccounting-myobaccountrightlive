<?php
namespace Tests;


use Dotenv\Dotenv;
use PHPAccounting\MyobAccountRightLive\Gateway;
use PHPUnit\Framework\TestCase;

class BaseTest extends TestCase
{
    public $gateway;

    public function setUp(): void
    {
        parent::setUp();
        $dotenv = Dotenv::createImmutable(__DIR__ . '/..');
        $dotenv->safeLoad();
        $this->gateway = new Gateway();

        $this->gateway->setAPIKey($_ENV['API_KEY'] ?? '');
        $this->gateway->setAccessToken($_ENV['ACCESS_TOKEN'] ?? '');
        $this->gateway->setCompanyEndpoint($_ENV['COMPANY_FILE_URI'] ?? '');
        $this->gateway->setCompanyFile(base64_encode('Administrator:'));
        $this->gateway->setAccessFlag($_ENV['ACCESS_FLAG'] ?? '');
        $this->gateway->setProduct($_ENV['PRODUCT'] ?? '');
        $this->gateway->setBusinessID($_ENV['BUSINESS_ID'] ?? '');
        $this->gateway->setCountryCode($_ENV['COUNTRY_CODE'] ?? '');
    }
}
