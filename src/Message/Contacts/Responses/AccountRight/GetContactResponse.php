<?php
namespace PHPAccounting\MyobAccountRightLive\Message\Contacts\Responses\AccountRight;

use Omnipay\Common\Message\AbstractResponse;
use PHPAccounting\MyobAccountRightLive\Helpers\AccountRight\IndexSanityCheckHelper;

/**
 * Get Contact(s) Response
 * @package PHPAccounting\MyobAccountRightLive\Message\Contacts\Responses\AccountRight
 */
class GetContactResponse extends AbstractResponse
{

    /**
     * Check Response for Error or Success
     * @return boolean
     */
    public function isSuccessful()
    {
        if(array_key_exists('Errors', $this->data)){
            return !$this->data['Errors'][0]['Severity'] == 'Error';
        }
        if (array_key_exists('Items', $this->data)) {
            if (count($this->data['Items']) === 0) {
                return false;
            }
        }
        return true;
    }

    /**
     * Fetch Error Message from Response
     * @return array
     */
    public function getErrorMessage()
    {
        if (array_key_exists('Errors', $this->data)) {
            if ($this->data['Errors'][0]['Message'] === 'The supplied OAuth token (Bearer) is not valid') {
                return 'The access token has expired';
            }
            else {
                return $this->data['Errors'][0]['Message'];
            }
        }
        if (array_key_exists('Items', $this->data)) {
            if (count($this->data['Items']) === 0) {
                return ['message' => 'NULL Returned from API or End of Pagination'];
            }
        }

        return null;
    }

    public function addPhone($contact, $data, $type = '') {
        $newPhone = [];
        switch ($type) {
            case 'Default':
                $newPhone['type'] = 'DEFAULT';
                break;
            case 'Phone1':
                $newPhone['type'] = 'EXTRA';
                break;
            case 'Phone2':
                $newPhone['type'] = 'EXTRA';
                break;
            case 'Phone3':
                $newPhone['type'] = 'EXTRA';
                break;
            case 'Fax':
                $newPhone['type'] = 'FAX';
                break;
            default:
                $newPhone['type'] = 'OTHER';
                break;

        }
        if ($data !== '') {
            $newPhone['phone_number'] = $data;
            array_push($contact['phones'], $newPhone);
        }
        return $contact;

    }
    private function createNoteForAddress($data, $address) {
        $note = '';
        if (array_key_exists('Phone1', $data)) {
            if ($data['Phone1'] !== '') {
                $note = $note . 'Phone 1: '.$data['Phone1']. '\n';
            }
        }
        if (array_key_exists('Phone2', $data)) {
            if ($data['Phone2'] !== '') {
                $note = $note . 'Phone 2: '.$data['Phone2']. '\n';
            }

        }
        if (array_key_exists('Phone3', $data)) {
            if ($data['Phone3'] !== '') {
                $note = $note . 'Phone 3: '.$data['Phone3']. '\n';
            }

        }
        if (array_key_exists('Fax', $data)) {
            if ($data['Fax'] !== '') {
                $note = $note . 'Fax: '.$data['Fax']. '\n';
            }

        }
        if (array_key_exists('Email', $data)) {
            if ($data['Email'] !== '') {
                $note = $note . 'Email: '.$data['Email'].'\n';
            }

        }
        if (array_key_exists('Website', $data)) {
            if ($data['Website'] !== '') {
                $note = $note . 'Website: '.$data['Website']. '\n';
            }

        }
        if (array_key_exists('ContactName', $data)) {
            if ($data['ContactName'] !== '') {
                $note = $note . 'Contact: '.$data['ContactName']. '\n';
            }
        }
        if (array_key_exists('Salutation', $data)) {
            if ($data['Salutation'] !== '') {
                $note = $note . 'Salutation'.$data['Salutation']. '\n';
            }
        }

        if ($note !== '') {
            $address['note'] = $note;
        }

        return $address;
    }

    private function parseType($contact, $type) {
        $contact['types'] = [];
        switch($type) {
            case 'Customer':
                array_push($contact['types'], 'CUSTOMER');
                break;
            case 'Supplier':
                array_push($contact['types'], 'SUPPLIER');
                break;
            case 'Employee':
                array_push($contact['types'], 'EMPLOYEE');
                break;
            case 'Personal':
                array_push($contact['types'], 'PERSONAL');
                break;
        }
        return $contact;
    }

    public function parseAddressesAndPhones($contact, $data) {
        $contact['addresses'] = [];
        $contact['phones'] = [];
        if ($data) {
            $addresses = [];
            $default = true;
            foreach($data as $address) {
                $newAddress = [];
                if ($default) {
                    $newAddress['address_type'] = 'PRIMARY';
                } else {
                    $newAddress['address_type'] = 'EXTRA';
                }

                $newAddress['address_line_1'] = IndexSanityCheckHelper::indexSanityCheck('Street', $address);
                $newAddress['city'] = IndexSanityCheckHelper::indexSanityCheck('City', $address);
                $newAddress['postal_code'] = IndexSanityCheckHelper::indexSanityCheck('PostCode', $address);
                $newAddress['country'] = IndexSanityCheckHelper::indexSanityCheck('Country', $address);

                if (array_key_exists('Phone1', $address)) {
                    if ($default) {
                        $contact = $this->addPhone($contact, $address['Phone1'], 'Default');
                    }
                    else {
                        $contact = $this->addPhone($contact, $address['Phone1'], 'Phone1');
                    }
                }
                if (array_key_exists('Phone2', $address)) {
                    $contact = $this->addPhone($contact, $address['Phone2'], 'Phone2');
                }
                if (array_key_exists('Phone3', $address)) {
                    $contact = $this->addPhone($contact, $address['Phone3'], 'Phone3');
                }
                if (array_key_exists('Fax', $address)) {
                    if ($default) {
                        $contact = $this->addPhone($contact, $address['Fax'], 'Fax');
                    }
                    else {
                        $contact = $this->addPhone($contact, $address['Fax']);
                    }
                }
                $newAddress = $this->createNoteForAddress($address, $newAddress);
                array_push($addresses, $newAddress);
                $default = false;
            }
            $contact['addresses'] = $addresses;
        }
        return $contact;
    }
    /**
     * Return all Contacts with Generic Schema Variable Assignment
     * @return array
     */
    public function getContacts(){
        $contacts = [];
        foreach ($this->data['Items'] as $contact) {
            $newContact = [];
            $newContact['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $contact);
            $newContact['first_name'] = IndexSanityCheckHelper::indexSanityCheck('FirstName', $contact);
            $newContact['last_name'] = IndexSanityCheckHelper::indexSanityCheck('LastName', $contact);
            $newContact['is_individual'] = IndexSanityCheckHelper::indexSanityCheck('IsIndividual', $contact);
            if ($newContact['is_individual']) {
                $newContact['display_name'] = $newContact['first_name']. ' '.$newContact['last_name'];
            } else {
                $newContact['display_name'] = IndexSanityCheckHelper::indexSanityCheck('CompanyName', $contact);
            }
            $newContact['updated_at'] = IndexSanityCheckHelper::indexSanityCheck('LastModified', $contact);

            if (array_key_exists('Type', $contact)) {
                $newContact = $this->parseType($newContact, $contact['Type']);
            }

            if (array_key_exists('Addresses', $contact)) {
                $newContact = $this->parseAddressesAndPhones($newContact, $contact['Addresses']);
            }

            array_push($contacts, $newContact);
        }

        return $contacts;
    }
}
