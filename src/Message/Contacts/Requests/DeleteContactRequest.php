<?php


namespace PHPAccounting\MyobAccountRightLive\Message\Contacts\Requests;

use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\BuildEndpointHelper;
use PHPAccounting\MyobAccountRightLive\Message\AbstractMYOBRequest;
use PHPAccounting\MyobAccountRightLive\Message\Contacts\Responses\DeleteContactResponse;
use PHPAccounting\MyobAccountRightLive\Traits\AccountingIDRequestTrait;

class DeleteContactRequest extends AbstractMYOBRequest
{
    use AccountingIDRequestTrait;

    public string $model = 'Contact';


    /**
     * Get Type Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/contacts
     * @return mixed
     */
    public function getType(){
        return $this->getParameter('type');
    }

    /**
     * Set Type Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/contacts
     * @param array $value Array of Contact Phone Numbers
     * @return DeleteContactRequest
     */
    public function setType($value){
        return $this->setParameter('type', $value);
    }

    public function getData()
    {
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
                $endpoint = BuildEndpointHelper::deleteForGUID($endpoint, $this->getAccountingID());
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
        return $this->response = new DeleteContactResponse($this, $data);
    }
}