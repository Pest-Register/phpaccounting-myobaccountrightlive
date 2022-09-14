<?php
namespace PHPAccounting\MyobAccountRightLive\Message\Contacts\Responses\Essentials;

use Omnipay\Common\Message\AbstractResponse;
use PHPAccounting\MyobAccountRightLive\Helpers\Essentials\ErrorResponseHelper;
use PHPAccounting\MyobAccountRightLive\Helpers\Essentials\IndexSanityCheckHelper;

/**
 * Get Contact(s) Response
 * @package PHPAccounting\MyobAccountRightLive\Message\Contacts\Responses\Essentials
 */
class GetContactResponse extends AbstractResponse
{

    /**
     * Check Response for Error or Success
     * @return boolean
     */
    public function isSuccessful()
    {
        if ($this->data) {
            if(array_key_exists('Errors', $this->data)){
                return !$this->data['Errors'][0]['Severity'] == 'Error';
            }
            if (array_key_exists('Items', $this->data)) {
                if (count($this->data['Items']) === 0) {
                    return false;
                }
            }
        } else {
            return false;
        }

        return true;
    }

    /**
     * Fetch Error Message from Response
     * @return array
     */
    public function getErrorMessage()
    {
        if ($this->data) {
            if (array_key_exists('Errors', $this->data)) {
                return ErrorResponseHelper::parseErrorResponse($this->data['Errors'][0]['Message'], 'Contact');
            } else {
                if (array_key_exists('Items', $this->data)) {
                    if (count($this->data['Items']) == 0) {
                        return ['message' => 'NULL Returned from API or End of Pagination'];
                    }
                }
            }
        }

        return null;
    }

    public function addPhone($contact, $data, $type) {
        if($data) {
            $newPhone = [];
            $newPhone['type'] = $type;
            $newPhone['phone_number'] = $data;
            array_push($contact['phones'], $newPhone);
        }
        return $contact;
    }


    public function addAddress($contact, $data, $type) {
        if ($data) {
            $newAddress = [];
            $newAddress['address_type'] = $type;
            $newAddress['address_line_1'] = IndexSanityCheckHelper::indexSanityCheck('addressLine1', $data);
            $newAddress['address_line_2'] = IndexSanityCheckHelper::indexSanityCheck('addressLine2', $data);
            $newAddress['city'] = IndexSanityCheckHelper::indexSanityCheck('city', $data);
            $newAddress['postal_code'] = IndexSanityCheckHelper::indexSanityCheck('postCode', $data);
            $newAddress['country'] = IndexSanityCheckHelper::indexSanityCheck('country', $data);
            $newAddress['state'] = IndexSanityCheckHelper::indexSanityCheck('state', $data);

            array_push($contact['addresses'], $newAddress);
        }

        return $contact;
    }
    /**
     * Return all Contacts with Generic Schema Variable Assignment
     * @return array
     */
    public function getContacts(){
        $contacts = [];
        if (array_key_exists('items', $this->data)) {
            foreach ($this->data['items'] as $contact) {
                $newContact = [];
                $newContact['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('uid', $contact);
                $newContact['first_name'] = IndexSanityCheckHelper::indexSanityCheck('firstName', $contact);
                $newContact['last_name'] = IndexSanityCheckHelper::indexSanityCheck('lastName', $contact);
                $newContact['email_address'] = IndexSanityCheckHelper::indexSanityCheck('email', $contact);
                $newContact['website'] = IndexSanityCheckHelper::indexSanityCheck('website', $contact);
                $newContact['display_name'] = IndexSanityCheckHelper::indexSanityCheck('name', $contact);
                $newContact['is_individual'] = IndexSanityCheckHelper::indexSanityCheck('individual', $contact);
                $newContact['type'] = IndexSanityCheckHelper::indexSanityCheck('types', $contact);

                $newContact['addresses'] = [];
                $newContact['phones'] = [];
                if (array_key_exists('shippingAddress', $contact)) {
                    if ($contact['shippingAddress']) {
                        $newContact = $this->addAddress($newContact, $contact['shippingAddress'], 'PRIMARY');
                    }
                }

                if (array_key_exists('billingAddress', $contact)) {
                    if ($contact['billingAddress']) {
                        $newContact = $this->addAddress($newContact, $contact['billingAddress'], 'BILLING');
                    }
                }

                if (array_key_exists('phone', $contact)) {
                    if ($contact['phone']) {
                        $newContact = $this->addPhone($newContact, $contact['phone'], 'DEFAULT');
                    }
                }

                if (array_key_exists('mobile', $contact)) {
                    if ($contact['mobile']) {
                        $newContact = $this->addPhone($newContact, $contact['mobile'], 'MOBILE');
                    }
                }

                if (array_key_exists('fax', $contact)) {
                    if ($contact['fax']) {
                        $newContact = $this->addPhone($newContact, $contact['fax'], 'FAX');
                    }
                }

                array_push($contacts, $newContact);
            }
        } else {
            $contact = $this->data;
            $newContact = [];
            $newContact['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('uid', $contact);
            $newContact['first_name'] = IndexSanityCheckHelper::indexSanityCheck('firstName', $contact);
            $newContact['last_name'] = IndexSanityCheckHelper::indexSanityCheck('lastName', $contact);
            $newContact['email_address'] = IndexSanityCheckHelper::indexSanityCheck('email', $contact);
            $newContact['website'] = IndexSanityCheckHelper::indexSanityCheck('website', $contact);
            $newContact['display_name'] = IndexSanityCheckHelper::indexSanityCheck('name', $contact);
            $newContact['is_individual'] = IndexSanityCheckHelper::indexSanityCheck('individual', $contact);
            $newContact['type'] = IndexSanityCheckHelper::indexSanityCheck('types', $contact);

            $newContact['addresses'] = [];
            $newContact['phones'] = [];
            if (array_key_exists('shippingAddress', $contact)) {
                if ($contact['shippingAddress']) {
                    $newContact = $this->addAddress($newContact, $contact['shippingAddress'], 'PRIMARY');
                }
            }

            if (array_key_exists('billingAddress', $contact)) {
                if ($contact['billingAddress']) {
                    $newContact = $this->addAddress($newContact, $contact['billingAddress'], 'BILLING');
                }
            }

            if (array_key_exists('phone', $contact)) {
                if ($contact['phone']) {
                    $newContact = $this->addPhone($newContact, $contact['phone'], 'DEFAULT');
                }
            }

            if (array_key_exists('mobile', $contact)) {
                if ($contact['mobile']) {
                    $newContact = $this->addPhone($newContact, $contact['mobile'], 'MOBILE');
                }
            }

            if (array_key_exists('fax', $contact)) {
                if ($contact['fax']) {
                    $newContact = $this->addPhone($newContact, $contact['fax'], 'FAX');
                }
            }

            array_push($contacts, $newContact);
        }


        return $contacts;
    }
}
