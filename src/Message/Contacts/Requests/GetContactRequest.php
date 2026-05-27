<?php
namespace PHPAccounting\MyobAccountRightLive\Message\Contacts\Requests;

use PHPAccounting\MyobAccountRightLive\Helpers\Current\BuildEndpointHelper;
use PHPAccounting\MyobAccountRightLive\Message\AbstractMYOBRequest;
use PHPAccounting\MyobAccountRightLive\Message\Contacts\Responses\GetContactResponse;
use PHPAccounting\MyobAccountRightLive\Traits\GetRequestTrait;

/**
 * Get Contact(s)
 * @package PHPAccounting\MyobAccountRightLive\Message\Contacts\Requests\NewEssentials
 */
class GetContactRequest extends AbstractMYOBRequest
{
    use GetRequestTrait;

    public string $model = 'Contact';


    public function getEndpoint()
    {

        $endpoint = 'Contact/';

        if ($this->getAccountingID()) {
            if ($this->getAccountingID() !== "") {
                $endpoint = BuildEndpointHelper::loadByGUID($endpoint, $this->getAccountingID());
            }
        } else {
            if($this->getSearchParams() || $this->getSearchFilters())
            {
                $endpoint = BuildEndpointHelper::search(
                    $endpoint,
                    $this->getSearchParams(),
                    $this->getExactSearchValue(),
                    $this->getSearchFilters(),
                    $this->getMatchAllFilters(),
                    'substringof',
                    $this->getPage(),
                    $this->getSkip(),
                    modifiedSince: $this->getLastModifiedSince()
                );
            }
            else if ($this->getPage()) {
                if ($this->getPage() !== "") {
                    $endpoint = BuildEndpointHelper::paginate(
                        $endpoint,
                        $this->getPage(),
                        $this->getSkip(),
                        modifiedSince: $this->getLastModifiedSince()
                    );
                }
            }
        }
        return $endpoint;
    }

    public function getHttpMethod()
    {
        return 'GET';
    }

    protected function createResponse($data, $headers = [], ?int $statusCode = null)
    {
        return $this->response = new GetContactResponse($this, $data, $headers, $statusCode);
    }

}