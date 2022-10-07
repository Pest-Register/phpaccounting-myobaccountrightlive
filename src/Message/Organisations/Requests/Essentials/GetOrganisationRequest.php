<?php
namespace PHPAccounting\MyobAccountRightLive\Message\Organisations\Requests\Essentials;

use PHPAccounting\MyobAccountRightLive\Message\AbstractMYOBRequest;
use PHPAccounting\MyobAccountRightLive\Message\Organisations\Responses\Essentials\GetOrganisationResponse;
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

    protected function createResponse($data, $headers = [])
    {
        return $this->response = new GetOrganisationResponse($this, $data);
    }

    public function getEndpoint()
    {
        return 'businesses';
    }
}