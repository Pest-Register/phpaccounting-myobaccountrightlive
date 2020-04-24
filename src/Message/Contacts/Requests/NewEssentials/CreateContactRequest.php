<?php

namespace PHPAccounting\MyobAccountRightLive\Message\Contacts\Requests\NewEssentials;

use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\BuildEndpointHelper;
use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\IndexSanityCheckHelper;
use PHPAccounting\MyobAccountRightLive\Message\AbstractRequest;
use PHPAccounting\MyobAccountRightLive\Message\Contacts\Responses\NewEssentials\CreateContactResponse;

/**
 * Create Contact(s)
 * @package PHPAccounting\MyobAccountRightLive\Message\Contacts\Requests\Essentials
 */
class CreateContactRequest extends AbstractRequest
{

    /**
     * Set Name Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/contacts
     * @param string $value Contact Name
     * @return CreateContactRequest
     */
    public function setName($value){
        return $this->setParameter('name', $value);
    }

    /**
     * Set First Name Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/contacts
     * @param string $value Contact First Name
     * @return CreateContactRequest
     */
    public function setFirstName($value) {
        return $this->setParameter('first_name', $value);
    }

    /**
     * Set Last Name Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/contacts
     * @param string $value Contact Last Name
     * @return CreateContactRequest
     */
    public function setLastName($value) {
        return $this->setParameter('last_name', $value);
    }

    /**
     * Set Is Individual Boolean Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/contacts
     * @param string $value Contact Individual Status
     * @return CreateContactRequest
     */
    public function setIsIndividual($value) {
        return $this->setParameter('is_individual', $value);
    }

    /**
     * Set Email Address Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/contacts
     * @param string $value Contact Email Address
     * @return CreateContactRequest
     */
    public function setEmailAddress($value){
        return $this->setParameter('email_address', $value);
    }

    /**
     * Set Phones Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/contacts
     * @param array $value Array of Contact Phone Numbers
     * @return CreateContactRequest
     */
    public function setPhones($value){
        return $this->setParameter('phones', $value);
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
     * @return CreateContactRequest
     */
    public function setType($value){
        return $this->setParameter('type', $value);
    }

    /**
     * Get Phones Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/contacts
     * @return mixed
     */
    public function getPhones(){
        return $this->getParameter('phones');
    }

    /**
     * Set Addresses Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/contacts
     * @param array $value Array of Contact Addresses
     * @return CreateContactRequest
     */
    public function setAddresses($value){
        return $this->setParameter('addresses', $value);
    }

    /**
     * Set Contact Groups Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/contacts
     * @param array $value Array of Contact Groups
     * @return CreateContactRequest
     */
    public function setContactGroups($value) {
        return $this->setParameter('contact_groups', $value);
    }

    /**
     * Get ContactGroups Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/contacts
     * @return mixed
     */
    public function getContactGroups() {
        return $this->getParameter('contact_groups');
    }

    /**
     * Get Addresses Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/contacts
     * @return mixed
     */
    public function getAddresses(){
        return $this->getParameter('addresses');
    }


    /**
     * Set Status Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/contacts
     * @param $value
     * @return mixed
     */
    public function setStatus($value){
        return $this->setParameter('status', $value);
    }


    /**
     * Get Status Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/contacts
     * @return mixed
     */
    public function getStatus(){
        return $this->getParameter('status');
    }
    /**
     * Set AccountingID from Parameter Bag (UID generic interface)
     * @param $value
     * @return CreateContactRequest
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
     * @param $addresses
     * @param $phones
     * @param $data
     */
    public function parsePhonesAndAddresses($addresses, $phones, $data) {
        // Check addresses and phones length
        $addressCount = count($addresses);
        $phoneCount = count($phones);



    }

    /**
     * @param $addresses
     * @return
     */
    private function parseAddresses($addresses,$data) {
        $data['Addresses'] = [];
        foreach($addresses as $address) {
            $newAddress = [];
//            $newAddress['addressLine1'] = IndexSanityCheckHelper::indexSanityCheck('address_line_1', $address);
//            $newAddress['addressLine2'] = IndexSanityCheckHelper::indexSanityCheck('address_line_2', $address);
//            $newAddress['suburb'] = IndexSanityCheckHelper::indexSanityCheck('city', $address);
//            $newAddress['state'] = IndexSanityCheckHelper::indexSanityCheck('state', $address);
//            $newAddress['country'] = IndexSanityCheckHelper::indexSanityCheck('country', $address);
//            $newAddress['postCode'] = IndexSanityCheckHelper::indexSanityCheck('postal_code', $address);
            $newAddress['Phone1'] = '0435567535';
            array_push($newAddress, $data['Addresses']);
//            if ($newAddress !== []) {
//                switch($address['type']) {
//                    case 'PRIMARY':
//                        $data['shippingAddress'] = $newAddress;
//                        break;
//                    case 'BILLING':
//                        $data['billingAddress'] = $newAddress;
//                        break;
//                }
//            }
        }

        return $data;
    }

    /**
     * @param $phones
     * @param $data
     * @return
     */
    private function parsePhones($phones, $data) {
        foreach($phones as $phone) {
            $number = $phone['country_code'] . $phone['area_code'].$phone['phone_number'];
            if ($number !== '') {
                switch($phone['type']) {
                    case 'MOBILE':
                        $data['mobile'] = $number;
                        break;
                    case 'DEFAULT':
                        $data['phone'] = $number;
                        break;
                    case 'FAX':
                        $data['fax'] = $number;
                        break;
                }
            }
        }
        return $data;
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
        $this->validate('name');
        $this->issetParam('DisplayID', 'name');
        $this->issetParam('FirstName', 'first_name');
        $this->issetParam('LastName', 'last_name');
//        $this->issetParam('email', 'email_address');
        $this->issetParam('IsIndividual', 'is_individual');

        if ($this->getStatus() !== null) {
            $this->data['IsActive'] = ($this->getStatus() === 'ACTIVE' ? true : false);
        }
//        if ($this->getType() !== null) {
//            $this->data = $this->parseTypes($this->getType(), $this->data);
//        }

//        if ($this->getPhones() !== null) {
//            $this->data = $this->parsePhones($this->getPhones(), $this->data);
//        }

        if ($this->getAddresses() !== null) {
            $this->data = $this->parseAddresses($this->getAddresses(), $this->data);
        }
        return $this->data;
    }

    public function getEndpoint()
    {

        $endpoint = 'Contact/Customer';

        if ($this->getAccountingID()) {
            if ($this->getAccountingID() !== "") {
                $endpoint = BuildEndpointHelper::createForGUID($endpoint, $this->getAccountingID());
            }
        }
        return $endpoint;
    }

    public function getHttpMethod()
    {
        return 'POST';
    }

    protected function createResponse($data, $headers = [])
    {
        return $this->response = new CreateContactResponse($this, $data);
    }
}