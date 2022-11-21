<?php

namespace PHPAccounting\MyobAccountRightLive\Message\Accounts\Requests;

use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\BuildEndpointHelper;
use PHPAccounting\MyobAccountRightLive\Message\AbstractMYOBRequest;
use PHPAccounting\MyobAccountRightLive\Message\Accounts\Responses\GetAccountResponse;
use PHPAccounting\MyobAccountRightLive\Traits\GetRequestTrait;

/**
 * Get Account(s)
 * @package PHPAccounting\MyobAccountRightLive\Message\Accounts\Requests\NewEssentials
 */
class GetAccountRequest extends AbstractMYOBRequest
{
    use GetRequestTrait;

    public string $model = 'Account';


    public function getEndpoint()
    {

        $endpoint = 'GeneralLedger/Account/';

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
                    $this->getSkip()
                );
            }
            else if ($this->getPage()) {
                if ($this->getPage() !== "") {
                    $endpoint = BuildEndpointHelper::paginate($endpoint, $this->getPage(), $this->getSkip());
                }
            }
        }
        return $endpoint;
    }

    public function getHttpMethod()
    {
        return 'GET';
    }

    protected function createResponse($data, $headers = [])
    {
        return $this->response = new GetAccountResponse($this, $data);
    }

}