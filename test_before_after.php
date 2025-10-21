<?php

require __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;
use Omnipay\Omnipay;

// Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Create gateway
$gateway = Omnipay::create('\PHPAccounting\MyobAccountRightLive\Gateway');

// Configure gateway
$gateway->setAPIKey($_ENV['API_KEY'] ?? '');
$gateway->setAccessToken($_ENV['ACCESS_TOKEN'] ?? '');
$gateway->setCompanyEndpoint($_ENV['COMPANY_FILE_URI'] ?? '');
$gateway->setCompanyFile(base64_encode('Administrator:'));
$gateway->setAccessFlag($_ENV['ACCESS_FLAG'] ?? '');
$gateway->setProduct($_ENV['PRODUCT'] ?? '');
$gateway->setBusinessID($_ENV['BUSINESS_ID'] ?? '');
$gateway->setCountryCode($_ENV['COUNTRY_CODE'] ?? '');

echo "==================================================\n";
echo "Testing MYOB AccountRight Live API Connection\n";
echo "==================================================\n\n";

echo "Configuration:\n";
echo "  Product: " . ($_ENV['PRODUCT'] ?? 'NOT SET') . "\n";
echo "  Business ID: " . ($_ENV['BUSINESS_ID'] ?? 'NOT SET') . "\n";
echo "  Access Token: " . substr($_ENV['ACCESS_TOKEN'] ?? '', 0, 20) . "...\n\n";

try {
    echo "Attempting to get organisation details...\n";
    $response = $gateway->getOrganisation()->send();
    if ($response->isSuccessful()) {
        echo "\n✓ SUCCESS: API call completed successfully\n\n";
        echo "Response Data:\n";
        $organisations = $response->getOrganisations();
        if (!empty($organisations)) {
            foreach ($organisations as $index => $org) {
                echo "  Organisation #" . ($index + 1) . ":\n";
                echo "  Available keys: " . implode(', ', array_keys($org)) . "\n\n";
                foreach ($org as $key => $value) {
                    if (is_array($value)) {
                        echo "    $key: " . json_encode($value) . "\n";
                    } else {
                        echo "    $key: $value\n";
                    }
                }
                echo "\n";
            }
        } else {
            echo "  (No organisation data returned)\n";
        }
    } else {
        echo "\n✗ ERROR: API call failed\n\n";
        $errorMessage = $response->getErrorMessage();
        if (is_array($errorMessage)) {
            echo "Error Message: " . json_encode($errorMessage, JSON_PRETTY_PRINT) . "\n";
        } else {
            echo "Error Message: " . $errorMessage . "\n";
        }
    }
} catch (\GuzzleHttp\Exception\RequestException $e) {
    echo "\n✗ HTTP/2 PROTOCOL ERROR (Expected with current code)\n\n";
    echo "Error: " . $e->getMessage() . "\n\n";
    echo "This error demonstrates the HTTP/2 issue that the fix addresses.\n";
    echo "The fix will catch this error and retry with HTTP/1.1 using Guzzle.\n";
} catch (\Exception $e) {
    echo "\n✗ EXCEPTION CAUGHT\n\n";
    echo "Exception Type: " . get_class($e) . "\n";
    echo "Error Message: " . $e->getMessage() . "\n";
    echo "Stack Trace:\n" . $e->getTraceAsString() . "\n";
}

echo "\n==================================================\n";
echo "Test completed\n";
echo "==================================================\n";
