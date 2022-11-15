<?php


namespace PHPAccounting\MyobAccountRightLive\Message\Contacts\Requests;


use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\BuildEndpointHelper;
use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\IndexSanityCheckHelper;
use PHPAccounting\MyobAccountRightLive\Message\AbstractMYOBRequest;
use PHPAccounting\MyobAccountRightLive\Message\Contacts\Requests\Traits\ContactRequestTrait;
use PHPAccounting\MyobAccountRightLive\Message\Contacts\Responses\UpdateContactResponse;
use PHPAccounting\MyobAccountRightLive\Traits\AccountingIDRequestTrait;

class UpdateContactRequest extends AbstractMYOBRequest
{
    use ContactRequestTrait;

    public string $model = 'Contact';

    public function getData()
    {
        $this->validate('is_individual', 'accounting_id');
        $this->issetParam('UID', 'accounting_id');
        $this->issetParam('DisplayID', 'reference');
        $this->issetParam('FirstName', 'first_name');
        $this->issetParam('LastName', 'last_name');
        $this->issetParam('IsIndividual', 'is_individual');
        $this->issetParam('RowVersion', 'sync_token');
        if ($this->getIsIndividual() == false) {
            $this->issetParam('CompanyName', 'name');
        }
        $this->data['Addresses'] = [
            [
                "Location" => 1,
                "Street" => '',
                "City" => '',
                "State" => '',
                "PostCode" => '',
                "Country" => '',
                "Phone1" => '',
                "Phone2" => '',
                "Phone3" => '',
                "Fax" => '',
                "Email" => $this->getEmailAddress() ?: '',
                "Website" => $this->getWebsite() ?: '',
            ],
            [
                "Location" => 2,
                "Street" => '',
                "City" => '',
                "State" => '',
                "PostCode" => '',
                "Country" => '',
                "Phone1" => '',
                "Phone2" => '',
                "Phone3" => '',
                "Fax" => '',
            ]
        ];

        if ($this->getStatus() !== null) {
            $this->data['IsActive'] = ($this->getStatus() === 'ACTIVE' ? true : false);
        }

        if ($this->getAddresses()) {
            $this->data = $this->parseAddresses($this->getAddresses(), $this->data);
        }

        if ($this->getPhones()) {
            $this->data = $this->parsePhones($this->getPhones(), $this->data);
        }

        $this->data['SellingDetails'] = [];
        if ($this->getTaxTypeID()) {
            $this->data['SellingDetails']['TaxCode'] = [
                'UID' => $this->getTaxTypeID()
            ];
        }
        if ($this->getFreightTaxTypeID()) {
            $this->data['SellingDetails']['FreightTaxCode'] = [
                'UID' => $this->getFreightTaxTypeID()
            ];
        }

        return $this->data;
    }

    public function getEndpoint()
    {
        $endpoint = 'Contact/Customer?returnBody=true';
        if ($this->getType()) {
            if (in_array('SUPPLIER', $this->getType())) {
                $endpoint = 'Contact/Supplier?returnBody=true';
            }
        }

        if ($this->getAccountingID()) {
            if ($this->getAccountingID() !== "") {
                $endpoint = 'Contact/Customer';
                if ($this->getType()) {
                    if (in_array('SUPPLIER', $this->getType())) {
                        $endpoint = 'Contact/Supplier';
                    }
                }
                $endpoint = BuildEndpointHelper::createForGUID($endpoint, $this->getAccountingID());
            }
        }
        return $endpoint;
    }

    public function getHttpMethod()
    {
        return 'PUT';
    }

    protected function createResponse($data, $headers = [])
    {
        return $this->response = new UpdateContactResponse($this, $data);
    }
}
