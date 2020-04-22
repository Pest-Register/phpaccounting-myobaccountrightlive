<?php

namespace PHPAccounting\MyobAccountRightLive\Message\Accounts\Responses\Essentials;

use Omnipay\Common\Message\AbstractResponse;
use PHPAccounting\MyobAccountRightLive\Helpers\Essentials\IndexSanityCheckHelper;
use PHPAccounting\MyobAccountRightLive\Helpers\Essentials\ErrorResponseHelper;
/**
 * Create Account(s) Response
 * @package PHPAccounting\MyobEssentials\Message\Accounts\Responses\Essentials
 */
class CreateAccountResponse extends AbstractResponse
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
                return ErrorResponseHelper::parseErrorResponse($this->data['errors'][0]['message'], 'Account');
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
    public function getAccounts(){
        $accounts = [];
        $account = $this->data;
        $newAccount = [];
        $newAccount['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('uid', $account);
        array_push($accounts, $newAccount);
        return $accounts;
    }
}