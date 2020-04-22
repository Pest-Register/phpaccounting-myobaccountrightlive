<?php
namespace PHPAccounting\MyobAccountRightLive\Message\Organisations\Requests\AccountRight;

use Omnipay\Common\Message\ResponseInterface;
use PHPAccounting\MyobAccountRightLive\Message\AbstractRequest;
use PHPAccounting\MyobAccountRightLive\Message\Organisations\Responses\AccountRight\GetOrganisationResponse;
/**
 * Get Organisation(s)
 * @package PHPAccounting\MyobAccountRightLive\Message\Contacts\Requests\AccountRight
 */
class GetOrganisationRequest extends AbstractRequest
{

    public function getHttpMethod()
    {
        return 'GET';
    }

    protected function createResponse($data, $headers = [])
    {
        return $this->response =  new GetOrganisationResponse($this, $data);
    }

    public function getEndpoint()
    {
        return '';
    }
}