<?php
namespace PHPAccounting\MyobAccountRightLive\Message\Contacts\Requests\Essentials;

use PHPAccounting\MyobAccountRightLive\Helpers\Essentials\BuildEndpointHelper;
use PHPAccounting\MyobAccountRightLive\Message\AbstractRequest;
use PHPAccounting\MyobAccountRightLive\Message\Contacts\Responses\Essentials\DeleteContactResponse;
use PHPAccounting\MyobAccountRightLive\Message\Contacts\Responses\Essentials\GetContactResponse;
/**
 * Delete Contact(s)
 * @package PHPAccounting\MyobAccountRightLive\Message\Contacts\Requests\Essentials
 */
class DeleteContactRequest extends AbstractRequest
{
    /**
     * Set AccountingID from Parameter Bag (UID generic interface)
     * @param $value
     * @return DeleteContactRequest
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

    /**
     * Set Name Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/contacts
     * @param string $value Contact Name
     * @return DeleteContactRequest
     */
    public function setName($value){
        return $this->setParameter('name', $value);
    }

    /**
     * Set First Name Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/contacts
     * @param string $value Contact First Name
     * @return DeleteContactRequest
     */
    public function setFirstName($value) {
        return $this->setParameter('first_name', $value);
    }

    /**
     * Set Last Name Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/contacts
     * @param string $value Contact Last Name
     * @return DeleteContactRequest
     */
    public function setLastName($value) {
        return $this->setParameter('last_name', $value);
    }

    /**
     * Set Page Value for Pagination from Parameter Bag
     * @param $value
     * @return DeleteContactRequest
     */
    public function setPage($value) {
        return $this->setParameter('page', $value);
    }

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

    private function parseTypes($types, $data) {
        $newTypes = [];
        foreach($types as $type) {
            switch($type) {
                case 'CUSTOMER':
                    array_push($newTypes, 'Customer');
                    break;
                case 'SUPPLIER':
                    array_push($newTypes, 'Supplier');
                    break;
                default:
                    array_push($newTypes, 'Other');
                    break;
            }
        }

        $data['types'] = $newTypes;
        return $data;
    }

    public function getData()
    {
        $this->data['active'] = false;
        $this->issetParam('name', 'name');
        if ($this->getType() !== null) {
            $this->data = $this->parseTypes($this->getType(), $this->data);
        }
        return $this->data;
    }

    public function getEndpoint()
    {

        $endpoint = 'contacts';

        if ($this->getAccountingID()) {
            if ($this->getAccountingID() !== "") {
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
        return $this->response = new DeleteContactResponse($this, $data);
    }

}