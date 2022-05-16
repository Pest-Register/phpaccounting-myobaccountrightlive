<?php

namespace PHPAccounting\MyobAccountRightLive\Message\Contacts\Requests\NewEssentials;

use Faker\Provider\Payment;
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
     * gET Is Individual Boolean Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/contacts
     * @param string $value Contact Individual Status
     * @return CreateContactRequest
     */
    public function getIsIndividual() {
        return $this->getParameter('is_individual');
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
     * Get Email Address Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/contacts
     * @param string $value Contact Email Address
     * @return CreateContactRequest
     */
    public function getEmailAddress(){
        return $this->getParameter('email_address');
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
     * Set Freight Tax Type ID Parameter from Parameter Bag
     * @return mixed
     */
    public function setFreightTaxTypeID($value) {
        return $this->setParameter('freight_tax_type_id', $value);
    }

    /**
     * Get Freight Tax Type ID Parameter from Parameter Bag
     * @return mixed
     */
    public function getFreightTaxTypeID(){
        return $this->getParameter('freight_tax_type_id');
    }

    /**
     * Set Website Parameter from Parameter Bag
     * @return mixed
     */
    public function setWebsite($value) {
        return $this->setParameter('website', $value);
    }

    /**
     * Get Website Parameter from Parameter Bag
     * @return mixed
     */
    public function getWebsite(){
        return $this->getParameter('website');
    }

    /**
     * Set Tax Type ID Parameter from Parameter Bag
     * @return mixed
     */
    public function setTaxTypeID($value) {
        return $this->setParameter('tax_type_id', $value);
    }

    /**
     * Get Tax Type ID Parameter from Parameter Bag
     * @return mixed
     */
    public function getTaxTypeID(){
        return $this->getParameter('tax_type_id');
    }

    /**
     * Set Referece Parameter from Parameter Bag
     * @return mixed
     */
    public function setReference($value) {
        return $this->setParameter('reference', $value);
    }

    /**
     * Get Reference Parameter from Parameter Bag
     * @return mixed
     */
    public function getReference(){
        return $this->getParameter('reference');
    }

    /**
     * Set Sync Token Parameter from Parameter Bag
     * @return mixed
     */
    public function setSyncToken($value) {
        return $this->setParameter('sync_token', $value);
    }

    /**
     * Get Sync Token Parameter from Parameter Bag
     * @return mixed
     */
    public function getSyncToken(){
        return $this->getParameter('sync_token');
    }

    /**
     * @param $addresses
     * @return
     */
    private function parseAddresses($addresses,$data) {
        foreach($addresses as $address) {
            $location = null;
            switch($address['type']) {
                case 'BILLING':
                    $location = 0;
                    break;
                case 'PRIMARY':
                    $location = 1;
                    break;
                default:
                    break;
            }
            if ($location !== 0) {
                $data['Addresses'][$location]['Email'] = IndexSanityCheckHelper::indexSanityCheck('email', $address);
                $data['Addresses'][$location]['Website'] = IndexSanityCheckHelper::indexSanityCheck('website', $address);
            }
            $data['Addresses'][$location]['Street'] = IndexSanityCheckHelper::indexSanityCheck('address_line_1', $address);
            $data['Addresses'][$location]['City'] = IndexSanityCheckHelper::indexSanityCheck('suburb', $address);
            $data['Addresses'][$location]['State'] = IndexSanityCheckHelper::indexSanityCheck('state', $address);
            $data['Addresses'][$location]['PostCode'] = IndexSanityCheckHelper::indexSanityCheck('postal_code', $address);
            $data['Addresses'][$location]['Country'] = IndexSanityCheckHelper::indexSanityCheck('country', $address);
            $data['Addresses'][$location]['ContactName'] = IndexSanityCheckHelper::indexSanityCheck('contact_name', $address);
            $data['Addresses'][$location]['Salutation'] = IndexSanityCheckHelper::indexSanityCheck('salutation', $address);
        }

        return $data;
    }

    /**
     * Assign phones to relative addresses
     * @param $data
     * @param $phone
     * @return
     */
    private function assignPhonesToSlot($data, $phones, $addressIndex) {
        $address = $data['Addresses'][$addressIndex];

        foreach ($phones as $phone) {
            $phoneNumber = $phone['country_code'] . $phone['area_code'].$phone['phone_number'];
            switch ($phone['accounting_slot_id']) {
                case '0':
                    $address['Phone1'] = $phoneNumber;
                    break;
                case '1':
                    $address['Phone2'] = $phoneNumber;
                    break;
                case '2':
                    $address['Phone3'] = $phoneNumber;
                    break;
                case 'Fax':
                    $address['Fax'] = $phoneNumber;
                    break;
            }
            $data['Addresses'][$addressIndex] = $address;
        }

        return $data;
    }

    /**
     * @param $phones
     * @param $data
     * @return
     */
    private function parsePhones($phones, $data) {
        $billingPhones = array_filter($phones, function ($item) {
            return $item['accounting_id'] == 1;
        });

        $shippingPhones = array_filter($phones, function ($item) {
            return $item['accounting_id'] == 2;
        });

        $unassignedPhones = array_filter($phones, function ($item) {
           return $item['accounting_id'] == null;
        });

        $data = $this->assignPhonesToSlot($data, $billingPhones, 0);
        $data = $this->assignPhonesToSlot($data, $shippingPhones, 1);

        // Assign unassigned phones
        if (count($unassignedPhones) > 0) {
            // No more slots to add phones
            if (count($billingPhones) == 4 && count($shippingPhones) == 4) {
                return $data;
            }
            // Try to add unassigned phones
            foreach ($unassignedPhones as $phone) {
                $phoneNumber = $phone['country_code'] . $phone['area_code'].$phone['phone_number'];
                if ($data['Addresses'][0]['Phone1'] == '') {
                    $data['Addresses'][0]['Phone1'] = $phoneNumber;
                    continue;
                }
                elseif ($data['Addresses'][0]['Phone2'] == '') {
                    $data['Addresses'][0]['Phone2'] = $phoneNumber;
                    continue;
                }
                elseif ($data['Addresses'][0]['Phone3'] == '') {
                    $data['Addresses'][0]['Phone3'] = $phoneNumber;
                    continue;
                }
                elseif ($data['Addresses'][1]['Phone1'] == '') {
                    $data['Addresses'][1]['Phone1'] = $phoneNumber;
                    continue;
                }
                elseif ($data['Addresses'][1]['Phone2'] == '') {
                    $data['Addresses'][1]['Phone2'] = $phoneNumber;
                    continue;
                }
                elseif ($data['Addresses'][1]['Phone3'] == '') {
                    $data['Addresses'][1]['Phone3'] = $phoneNumber;
                    continue;
                }
                break;
            }
        }
        return $data;
    }

    public function getData()
    {
        $this->validate('is_individual');
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
        return 'POST';
    }

    protected function createResponse($data, $headers = [])
    {
        return $this->response = new CreateContactResponse($this, $data);
    }
}