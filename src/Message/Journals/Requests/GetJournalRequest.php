<?php

namespace PHPAccounting\MyobAccountRightLive\Message\Journals\Requests;

use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\BuildEndpointHelper;
use PHPAccounting\MyobAccountRightLive\Message\AbstractMYOBRequest;
use PHPAccounting\MyobAccountRightLive\Message\Journals\Responses\GetJournalResponse;
use PHPAccounting\MyobAccountRightLive\Traits\GetRequestTrait;


/**
 * Get Journal(s)
 * @package PHPAccounting\MyobAccountRightLive\Message\Journals\Requests\NewEssentials
 */
class GetJournalRequest extends AbstractMYOBRequest
{
    use GetRequestTrait;

    public string $model = 'Journal';


    public function getEndpoint()
    {

        $endpoint = 'GeneralLedger/JournalTransaction/';

        if ($this->getAccountingID()) {
            if ($this->getAccountingID() !== "") {
                $endpoint = BuildEndpointHelper::loadByGUID($endpoint, $this->getAccountingID());
            }
        } else {
            if ($this->getPage()) {
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
        return $this->response = new GetJournalResponse($this, $data);
    }

}