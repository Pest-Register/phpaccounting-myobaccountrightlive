<?php


namespace PHPAccounting\MyobAccountRightLive\Message\Accounts\Requests;


use PHPAccounting\MyobAccountRightLive\Message\AbstractRequest;
use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\BuildEndpointHelper;
use PHPAccounting\MyobAccountRightLive\Message\Accounts\Responses\DeleteAccountResponse;

class DeleteAccountRequest extends AbstractRequest
{
    /**
     * Set AccountingID from Parameter Bag (UID generic interface)
     * @param $value
     * @return DeleteAccountRequest
     */
    public function setAccountingID($value) {
        return $this->setParameter('accounting_id', $value);
    }

    /**
     * Return Accounting ID (UID)
     * @return mixed comma-delimited-string
     */
    public function getAccountingID() {
        if ($this->getParameter('accounting_id')) {
            return $this->getParameter('accounting_id');
        }
        return null;
    }

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