<?php

namespace PHPAccounting\MyobAccountRightLive\Message\Invoices\Responses\Essentials;

use Omnipay\Common\Message\AbstractResponse;
use PHPAccounting\MyobAccountRightLive\Helpers\Essentials\ErrorResponseHelper;
use PHPAccounting\MyobAccountRightLive\Helpers\Essentials\IndexSanityCheckHelper;

/**
 * Delete Invoice(s) Response
 * @package PHPAccounting\MyobEssentials\Message\Invoices\Responses\Essentials
 */
class DeleteInvoiceResponse extends AbstractResponse
{
    /**
     * Check Response for Error or Success
     * @return boolean
     */
    public function isSuccessful()
    {
        if ($this->data) {
            if(array_key_exists('errors', $this->data)){
                return false;
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
            if (array_key_exists('errors', $this->data)) {
                return ErrorResponseHelper::parseErrorResponse($this->data['errors'][0]['message'], 'Invoice');
            }
        } else {
            return 'NULL returned from API';
        }

        return null;
    }

    /**
     * Return all Invoices with Generic Schema Variable Assignment
     * @return array
     */
    public function getInvoices(){
        $invoices = [];

        return $invoices;
    }
}