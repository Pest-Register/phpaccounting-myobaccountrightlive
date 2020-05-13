<?php
namespace PHPAccounting\MyobAccountRightLive\Message;
use Omnipay\Common\Message\ResponseInterface;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    /**
     * Live or Test Endpoint URL.
     *
     * @var string URL
     */
    protected $data = [];
    protected $version = 'v2';

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

        $headers['x-myobapi-version'] = $this->version;
        $headers['Accept-Encoding'] = 'gzip,deflate';

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

        $headers['x-myobapi-version'] = $this->version;
        $headers['Accept-Encoding'] = 'gzip,deflate';

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
     * @return string
     */
    public function sendData($data)
    {
        $endpoint = '';
        if ($this->getProduct() == 'accountright_live') {
            $endpoint = 'https://api.myob.com/accountright/' . $this->getCompanyEndpoint();
            $headers = $this->getAccountRightLiveHeaders();
            $body = json_encode($data);
        }
        elseif ($this->getProduct() == 'old_essentials') {
            if ($this->getBusinessID() !== '') {
                $endpoint = 'https://api.myob.com/'. $this->getCountryCode().'/essentials/'. $this->getBusinessID().'/';
            } else {
                $endpoint = 'https://api.myob.com/'. $this->getCountryCode().'/essentials/';
            }
            $headers = $this->getOldEssentialsHeaders($this->getHttpMethod());
            $body = json_encode($data);
        }

        $httpResponse = $this->httpClient->request($this->getHttpMethod(), $endpoint . $this->getEndpoint(), $headers, $body);
        $this->createResponse(json_decode($httpResponse->getBody()->getContents(), true), $httpResponse->getHeaders());
        return $this->response;
    }
}