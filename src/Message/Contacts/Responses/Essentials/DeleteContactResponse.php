<?php

namespace PHPAccounting\MyobAccountRightLive\Message\Contacts\Responses\Essentials;

use Omnipay\Common\Message\AbstractResponse;
use PHPAccounting\MyobAccountRightLive\Helpers\Essentials\ErrorResponseHelper;

/**
 * Delete Contact(s) Response
 * @package PHPAccounting\MyobAccountRightLive\Message\Contacts\Responses\Essentials
 */
class DeleteContactResponse extends AbstractResponse
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
     * @return string
     */
    public function getErrorMessage()
    {
        if ($this->data) {
            if (array_key_exists('Errors', $this->data)) {
                return ErrorResponseHelper::parseErrorResponse($this->data['Errors'][0]['Message'], 'Contact');
            } else {
                if (array_key_exists('Items', $this->data)) {
                    if (count($this->data['Items']) == 0) {
                        return 'NULL Returned from API or End of Pagination';
                    }
                }
            }
        }

        return null;
    }

    /**
     * Return all Contacts with Generic Schema Variable Assignment
     * @return array
     */
    public function getContacts(){
        $contacts = [];
        return $contacts;
    }
}