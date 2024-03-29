<?php

namespace PHPAccounting\MyobAccountRightLive\Message\Contacts\Requests\Traits;

use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\IndexSanityCheckHelper;

trait ContactRequestTrait
{
    /**
     * Set Name Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/contacts
     * @param string $value Contact Name
     */
    public function setName($value){
        return $this->setParameter('name', $value);
    }

    /**
     * Set First Name Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/contacts
     * @param string $value Contact First Name
     */
    public function setFirstName($value) {
        return $this->setParameter('first_name', $value);
    }

    /**
     * Set Last Name Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/contacts
     * @param string $value Contact Last Name
     */
    public function setLastName($value) {
        return $this->setParameter('last_name', $value);
    }

    /**
     * Set Is Individual Boolean Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/contacts
     * @param string $value Contact Individual Status
     */
    public function setIsIndividual($value) {
        return $this->setParameter('is_individual', $value);
    }

    /**
     * gET Is Individual Boolean Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/contacts
     * @param string $value Contact Individual Status
     */
    public function getIsIndividual() {
        return $this->getParameter('is_individual');
    }

    /**
     * Set Email Address Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/contacts
     * @param string $value Contact Email Address
     */
    public function setEmailAddress($value){
        return $this->setParameter('email_address', $value);
    }

    /**
     * Get Email Address Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/contacts
     * @param string $value Contact Email Address
     */
    public function getEmailAddress(){
        return $this->getParameter('email_address');
    }

    /**
     * Set Phones Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/contacts
     * @param array $value Array of Contact Phone Numbers
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
     */
    public function setAddresses($value){
        return $this->setParameter('addresses', $value);
    }

    /**
     * Set Contact Groups Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/contacts
     * @param array $value Array of Contact Groups
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
                    continue 2;
            }
            if ($location !== 0) {
                $data['Addresses'][$location]['Email'] = IndexSanityCheckHelper::indexSanityCheck('email', $address);
                $data['Addresses'][$location]['Website'] = IndexSanityCheckHelper::indexSanityCheck('website', $address);
            }
            $data['Addresses'][$location]['Street'] = IndexSanityCheckHelper::indexSanityCheck('address_line_1', $address);
            $data['Addresses'][$location]['City'] = IndexSanityCheckHelper::indexSanityCheck('city', $address);
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
                if ($phone['type'] == 'FAX') {
                    if ($data['Addresses'][0]['Fax'] == '') {
                        $data['Addresses'][0]['Fax'] = $phoneNumber;
                        continue;
                    }
                    elseif ($data['Addresses'][1]['Fax'] == '') {
                        $data['Addresses'][1]['Fax'] = $phoneNumber;
                        continue;
                    }
                }

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
}