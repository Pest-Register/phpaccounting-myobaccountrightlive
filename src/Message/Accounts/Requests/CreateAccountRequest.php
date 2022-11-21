<?php

namespace PHPAccounting\MyobAccountRightLive\Message\Accounts\Requests;

use PHPAccounting\MyobAccountRightLive\Message\AbstractMYOBRequest;
use PHPAccounting\MyobAccountRightLive\Message\Accounts\Requests\Traits\AccountRequestTrait;
use PHPAccounting\MyobAccountRightLive\Message\Accounts\Responses\CreateAccountResponse;

/**
 * Create Account(s)
 * @package PHPAccounting\MyobAccountRightLive\Message\Accounts\NewEssentials\Requests
 */
class CreateAccountRequest extends AbstractMYOBRequest
{
    use AccountRequestTrait;

    public string $model = 'Account';


    public function getData()
    {
        $this->validate('code', 'name', 'type', 'tax_type', 'accounting_parent_id');

        $this->issetParam('DisplayID', 'code');
        $this->issetParam('Name', 'name');
        $this->issetParam('Type', 'type');
        $this->issetParam('Description','description');
        $this->issetParam('IsHeader', 'is_header');
        $this->issetParam('RowVersion', 'sync_token');

        if($this->getAccountingParentID()) {
            $this->data['ParentAccount'] = [
                'UID' => $this->getAccountingParentID()
            ];
        }

        if($this->getStatus() !== null) {
            $this->data['IsActive'] = ($this->getStatus() === 'ACTIVE' ? true : false);
        }

        if ($this->getTaxType() !== null && $this->getTaxTypeID() !== null) {
            $this->data['TaxCode'] = [
              'UID' => $this->getTaxTypeID()
            ];
        }

        return $this->data;
    }

    public function getEndpoint()
    {

        $endpoint = 'GeneralLedger/Account?returnBody=true';
        return $endpoint;
    }

    public function getHttpMethod()
    {
        return 'POST';
    }

    protected function createResponse($data, $headers = [])
    {
        return $this->response = new CreateAccountResponse($this, $data);
    }
}