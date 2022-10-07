<?php


namespace PHPAccounting\MyobAccountRightLive\Message\Contacts\Responses;

use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\IndexSanityCheckHelper;
use PHPAccounting\MyobAccountRightLive\Message\AbstractMYOBResponse;

class DeleteContactResponse extends AbstractMYOBResponse
{

    public function addPhone($contact, $data, $locationID, $slotID, $type = '') {
        $newPhone = [];
        switch ($type) {
            case 'Default':
                $newPhone['type'] = $locationID == 1 ? 'DEFAULT' : 'EXTRA';
                break;
            case 'Fax':
                $newPhone['type'] = $locationID == 1 ? 'FAX' : 'EXTRA';
                break;
            default:
                $newPhone['type'] = 'EXTRA';
                break;
        }
        if ($data !== '') {
            $newPhone['phone_number'] = $data;
            $newPhone['accounting_id'] = $locationID;
            $newPhone['accounting_slot_id'] = $slotID;
            $contact['phones'][] = $newPhone;
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
                $contact['types'][] = 'CUSTOMER';
                break;
            case 'Supplier':
                $contact['types'][] = 'SUPPLIER';
                break;
            case 'Employee':
                $contact['types'][] = 'EMPLOYEE';
                break;
            case 'Personal':
                $contact['types'][] = 'PERSONAL';
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
                if ($address['Location'] == 1) {
                    $newAddress['address_type'] = 'BILLING';
                    $contact['email_address'] = IndexSanityCheckHelper::indexSanityCheck('Email', $address);
                } else {
                    $newAddress['address_type'] = 'PRIMARY';
                }

                $newAddress['address_line_1'] = IndexSanityCheckHelper::indexSanityCheck('Street', $address);
                if ($newAddress['address_line_1']) {
                    $newAddress['address_line_1'] = trim($newAddress['address_line_1']);
                }
                $newAddress['city'] = IndexSanityCheckHelper::indexSanityCheck('City', $address);
                if ($newAddress['city']) {
                    $newAddress['city'] = trim($newAddress['city']);
                }
                $newAddress['state'] = IndexSanityCheckHelper::indexSanityCheck('State', $address);
                if ($newAddress['state']) {
                    $newAddress['state'] = trim($newAddress['state']);
                }
                $newAddress['postal_code'] = IndexSanityCheckHelper::indexSanityCheck('PostCode', $address);
                if ($newAddress['postal_code']) {
                    $newAddress['postal_code'] = trim($newAddress['postal_code']);
                }
                $newAddress['country'] = IndexSanityCheckHelper::indexSanityCheck('Country', $address);
                if ($newAddress['country']) {
                    $newAddress['country'] = trim($newAddress['country']);
                }

                if (array_key_exists('Phone1', $address)) {
                    if ($default) {
                        $contact = $this->addPhone($contact, $address['Phone1'], $address['Location'], 0, 'Default');
                    }
                    else {
                        $contact = $this->addPhone($contact, $address['Phone1'], $address['Location'], 0,  'Phone1');
                    }
                }
                if (array_key_exists('Phone2', $address)) {
                    $contact = $this->addPhone($contact, $address['Phone2'], $address['Location'], 1,  'Phone2');
                }
                if (array_key_exists('Phone3', $address)) {
                    $contact = $this->addPhone($contact, $address['Phone3'], $address['Location'], 2,  'Phone3');
                }
                if (array_key_exists('Fax', $address)) {
                    $contact = $this->addPhone($contact, $address['Fax'], $address['Location'], 'Fax','Fax' );
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
     * @param $contact
     * @return array
     */
    private function parseData($contact) {
        $newContact = [];
        $newContact['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $contact);
        $newContact['first_name'] = IndexSanityCheckHelper::indexSanityCheck('FirstName', $contact);
        $newContact['last_name'] = IndexSanityCheckHelper::indexSanityCheck('LastName', $contact);
        $newContact['is_individual'] = IndexSanityCheckHelper::indexSanityCheck('IsIndividual', $contact);
        $newContact['sync_token'] = IndexSanityCheckHelper::indexSanityCheck('RowVersion', $contact);
        $newContact['raw_addresses'] = IndexSanityCheckHelper::indexSanityCheck('Addresses', $contact);

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

        if (array_key_exists('SellingDetails', $contact)) {
            if ($contact['SellingDetails']) {
                if (array_key_exists('TaxCode', $contact['SellingDetails'])) {
                    $newContact['tax_type_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $contact['SellingDetails']['TaxCode']);
                }
                if (array_key_exists('FreightTaxCode', $contact['SellingDetails'])) {
                    $newContact['freight_tax_type_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $contact['SellingDetails']['FreightTaxCode']);
                }
            }
        }

        return $newContact;
    }

    /**
     * Return all Contacts with Generic Schema Variable Assignment
     * @return array
     */
    public function getContacts(){
        $contacts = [];
        if ($this->data && !is_string($this->data)) {
            if (!array_key_exists('Items', $this->data)) {
                $newContact = $this->parseData($this->data);
                $contacts[] = $newContact;
            } else {
                foreach ($this->data['Items'] as $contact) {
                    $newContact = $this->parseData($contact);
                    $contacts[] = $newContact;
                }
            }
        }

        return $contacts;
    }
}
