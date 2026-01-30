<?php
namespace PHPAccounting\\MyobAccountRightLive\\Message\\Organisations\\Requests\\Current;

use PHPAccounting\MyobAccountRightLive\Message\AbstractMYOBRequest;
use PHPAccounting\\MyobAccountRightLive\\Message\\Organisations\\Responses\\Current\\GetOrganisationResponse;
/**
 * Get Organisation(s)
 * @package PHPAccounting\MyobAccountRightLive\Message\Contacts\Requests\AccountRight
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
        if (parent::getProduct() == 'old_essentials') {
            return 'businesses';
        } else {
            return '';
        }

    }
}