<?php
namespace PHPAccounting\MyobAccountRightLive\Message;

use GuzzleHttp\Client;
use PHPAccounting\MyobAccountRightLive\Foundation\AbstractRequest;

abstract class AbstractMYOBRequest extends AbstractRequest
{
    /**
     * Live or Test Endpoint URL.
     *
     * @var string URL
     */
    protected $data = [];
    protected $accountRightVersion = 'v2';
    protected $essentialsVersion = 'v0';

    /**
     * Model type for response parsing
     */
    public string $model = '';

    /**
     * Get Access Token
     */
    public function getBusinessID() {
        return $this->getParameter('businessID');
    }

    public function setBusinessID($value) {
        return $this->setParameter('businessID', $value);
    }

    public function getCountryCode() {
        return $this->getParameter('countryCode');
    }

    public function setCountryCode($value) {
        return $this->setParameter('countryCode', $value);
    }

    public function getAccessToken(){
        return $this->getParameter('accessToken');
    }

    public function setAccessToken($value){
        return $this->setParameter('accessToken', $value);
    }

    public function getCompanyEndpoint() {
        return $this->getParameter('companyEndpoint');
    }

    public function setCompanyEndpoint($value) {
        return $this->setParameter('companyEndpoint', $value);
    }

    public function getCompanyFile() {
        return $this->getParameter('companyFile');
    }

    public function setCompanyFile($value) {
        return $this->setParameter('companyFile',$value);
    }

    public function getAPIKey() {
        return $this->getParameter('apiKey');
    }

    public function setProduct($value) {
        return $this->setParameter('product', $value);
    }

    public function getProduct() {
        return $this->getParameter('product');
    }

    public function setAPIKey($value) {
        return $this->setParameter('apiKey',$value);
    }

    abstract public function getEndpoint();

    /**
     * Check if key exists in param bag and add it to array
     * @param $myobKey
     * @param $localKey
     */
    public function issetParam($myobKey, $localKey){
        if(array_key_exists($localKey, $this->getParameters())){
            $this->data[$myobKey] = $this->getParameter($localKey);
        }
    }

    /**
     * Get HTTP Method.
     *
     * This is nearly always POST but can be over-ridden in sub classes.
     *
     * @return string
     */
    public function getHttpMethod()
    {
        return 'POST';
    }

    /**
     * @param $httpMethod
     * @return array
     */

    public function getOldEssentialsHeaders($httpMethod) {
        $headers = array();
        if ($this->getAPIKey()) {
            $headers['x-myobapi-key'] = $this->getAPIKey();
        }

        if ($this->getAccessToken()) {
            $headers['Authorization'] = 'Bearer '.$this->getAccessToken();
        }

        $headers['x-myobapi-version'] = $this->essentialsVersion;
        $headers['Accept-Encoding'] = 'gzip,deflate';
        $headers['Accept'] = 'application/json';

        if ($httpMethod === 'POST' || $httpMethod === 'PUT') {
            $headers['Content-Type'] = 'application/json';
        }


        return $headers;
    }

    /**
     * @return array
     */
    public function getAccountRightLiveHeaders()
    {
        $headers = array();
        if ($this->getCompanyFile()) {
            $headers['x-myobapi-cftoken'] = $this->getCompanyFile();
        }
        if ($this->getAPIKey()) {
            $headers['x-myobapi-key'] = $this->getAPIKey();
        }

        if ($this->getAccessToken()) {
            $headers['Authorization'] = 'Bearer '.$this->getAccessToken();
        }

        $headers['x-myobapi-version'] = $this->accountRightVersion;
        $headers['Accept'] = 'application/json';
        $headers['Content-Type'] = 'application/json';
        return $headers;
    }

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     */
    public function getData()
    {

    }

    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     * @return mixed
     */
    public function sendData($data)
    {
        $endpoint = '';
        $headers = [];
        if ($this->getProduct() == 'accountright_live') {
            $endpoint = 'https://api.myob.com/accountright/' . $this->getCompanyEndpoint();
            $headers = $this->getAccountRightLiveHeaders();
        }
        elseif ($this->getProduct() == 'old_essentials') {
            if ($this->getBusinessID() !== '') {
                $endpoint = 'https://api.myob.com/'. $this->getCountryCode().'/essentials/'. $this->getBusinessID().'/';
            } else {
                $endpoint = 'https://api.myob.com/'. $this->getCountryCode().'essentials/';
            }
            $headers = $this->getOldEssentialsHeaders($this->getHttpMethod());
        }

        $body = $data ? json_encode($data) : null;
        $fullUrl = $endpoint . $this->getEndpoint();

        // Try with default HTTP client first (may use HTTP/2)
        // If we get a protocol error, fallback to HTTP/1.1 using Guzzle
        try {
            $httpClient = $this->getHttpClient();
            $httpResponse = $httpClient->request($this->getHttpMethod(), $fullUrl, [
                'headers' => $headers,
                'body' => $body,
            ]);
            $responseBody = $httpResponse->getBody()->getContents();
            $this->createResponse(json_decode($responseBody, true), $httpResponse->getHeaders());
            return $this->response;
        } catch (\Exception $e) {
            // Check if this is an HTTP/2 protocol error
            $isHttp2Error = stripos($e->getMessage(), 'HTTP/2') !== false
                         || stripos($e->getMessage(), 'PROTOCOL_ERROR') !== false
                         || stripos($e->getMessage(), 'stream error') !== false
                         || stripos($e->getMessage(), 'stream closed') !== false;

            // If it's not an HTTP/2 error, rethrow
            if (!$isHttp2Error) {
                throw $e;
            }

            // Retry with HTTP/1.1 using Guzzle
            $guzzle = new Client([
                'timeout' => 60,
                'http_errors' => false,
            ]);

            $guzzleResponse = $guzzle->request($this->getHttpMethod(), $fullUrl, [
                'headers' => $headers,
                'body' => $body,
                'version' => '1.1', // Force HTTP/1.1
            ]);

            $responseData = json_decode($guzzleResponse->getBody()->getContents(), true);
            $this->createResponse($responseData, $guzzleResponse->getHeaders());
            return $this->response;
        }
    }

    /**
     * Create the response object
     *
     * @param mixed $data
     * @param array $headers
     * @return mixed
     */
    abstract protected function createResponse($data, $headers = []);
}
