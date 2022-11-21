<?php


namespace PHPAccounting\MyobAccountRightLive\Message\Accounts\Requests;


use PHPAccounting\MyobAccountRightLive\Message\AbstractMYOBRequest;
use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\BuildEndpointHelper;
use PHPAccounting\MyobAccountRightLive\Message\Accounts\Responses\DeleteAccountResponse;
use PHPAccounting\MyobAccountRightLive\Traits\AccountingIDRequestTrait;

class DeleteAccountRequest extends AbstractMYOBRequest
{
    use AccountingIDRequestTrait;

    public string $model = 'Account';


    public function getData()
    {
        return $this->data;
    }

    public function getEndpoint()
    {
        $endpoint = 'GeneralLedger/Account?returnBody=true';

        if ($this->getAccountingID()) {
            if ($this->getAccountingID() !== "") {
                $endpoint = BuildEndpointHelper::deleteForGUID('GeneralLedger/Account', $this->getAccountingID());
            }
        }
        return $endpoint;
    }

    public function getHttpMethod()
    {
        return 'DELETE';
    }

    protected function createResponse($data, $headers = [])
    {
        return $this->response = new DeleteAccountResponse($this, $data);
    }
}