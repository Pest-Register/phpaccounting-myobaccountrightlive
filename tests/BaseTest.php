<?php
namespace Tests;


use Dotenv\Dotenv;
use Omnipay\Omnipay;
use PHPUnit\Framework\TestCase;

class BaseTest extends TestCase
{
    public $gateway;

    public function setUp()
    {
        parent::setUp();
        $dotenv = Dotenv::create(__DIR__ . '/..');
        $dotenv->load();
        $this->gateway = Omnipay::create('\PHPAccounting\MyobAccountRightLive\Gateway');

        $this->gateway->setAPIKey(getenv('API_KEY'));
        $this->gateway->setAccessToken(getenv('ACCESS_TOKEN'));
        $this->gateway->setCompanyEndpoint(getenv('COMPANY_FILE_URI'));
        $this->gateway->setCompanyFile(base64_encode('Administrator:'));
        $this->gateway->setAccessFlag(getenv('ACCESS_FLAG'));
        $this->gateway->setProduct(getenv('PRODUCT'));
        $this->gateway->setBusinessID(getenv('BUSINESS_ID'));
        $this->gateway->setCountryCode(getenv('COUNTRY_CODE'));
    }
}