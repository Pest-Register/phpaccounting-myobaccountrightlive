<?php
namespace PHPAccounting\\MyobAccountRightLive\\Message\\Organisations\\Requests\\Legacy;

use PHPAccounting\MyobAccountRightLive\Message\AbstractMYOBRequest;
use PHPAccounting\\MyobAccountRightLive\\Message\\Organisations\\Responses\\Legacy\\GetOrganisationResponse;
/**
 * Get Organisation(s)
 * @package PHPAccounting\MyobEssentials\Message\Contacts\Requests\Essentials
 */
class GetOrganisationRequest extends AbstractMYOBRequest
{
    public string $model = 'Organisation';

    public function setBusinessID($value)
    {
        return parent::setBusinessID('');
    }

    public function getHttpMethod()
    {
        return 'GET';
    }

    protected function createResponse($data, $headers = [], ?int $statusCode = null)
    {
        return $this->response = new GetOrganisationResponse($this, $data, $headers, $statusCode);
    }

    public function getEndpoint()
    {
        return 'businesses';
    }
}