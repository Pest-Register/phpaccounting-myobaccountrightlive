<?php

namespace PHPAccounting\MyobAccountRightLive\Message\Accounts\Responses\Essentials;

use Omnipay\Common\Message\AbstractResponse;
use PHPAccounting\MyobAccountRightLive\Helpers\Essentials\ErrorResponseHelper;
use PHPAccounting\MyobAccountRightLive\Helpers\Essentials\IndexSanityCheckHelper;

/**
 * Get Account(s) Response
 * @package PHPAccounting\MyobEssentials\Message\Accounts\Responses\Essentials
 */
class GetAccountResponse extends AbstractResponse
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
     * Return all Accounts with Generic Schema Variable Assignment
     * @return array
     */
    public function getAccounts(){
        $accounts = [];
        if (array_key_exists('items', $this->data)) {
            foreach ($this->data['items'] as $account) {
                $newAccount = [];
                $newAccount['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('uid', $account);
                $newAccount['code'] = IndexSanityCheckHelper::indexSanityCheck('displayId', $account);
                $newAccount['name'] = IndexSanityCheckHelper::indexSanityCheck('name', $account);


                if (array_key_exists('type', $account)) {
                    if ($account['type']) {
                        $newAccount['type'] = IndexSanityCheckHelper::indexSanityCheck('name', $account['type']);
                        $newAccount['is_bank_account'] = ($account['type'] === 'Banking');
                    }
                }

                if (array_key_exists('taxType', $account)) {
                    if ($account['taxType']) {
                        $newAccount['tax_type'] = IndexSanityCheckHelper::indexSanityCheck('code', $account['taxType']);
                    }
                }
                array_push($accounts, $newAccount);
            }
        } else {
            $account = $this->data;
            $newAccount = [];
            $newAccount['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('uid', $account);
            $newAccount['code'] = IndexSanityCheckHelper::indexSanityCheck('displayId', $account);
            $newAccount['name'] = IndexSanityCheckHelper::indexSanityCheck('name', $account);


            if (array_key_exists('type', $account)) {
                if ($account['type']) {
                    $newAccount['type'] = IndexSanityCheckHelper::indexSanityCheck('name', $account['type']);
                    $newAccount['type_accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('uid', $account['type']);
                    $newAccount['is_bank_account'] = ($account['type'] === 'Banking');
                }
            }

            if (array_key_exists('taxType', $account)) {
                if ($account['taxType']) {
                    $newAccount['tax_type'] = IndexSanityCheckHelper::indexSanityCheck('code', $account['taxType']);
                }
            }
            array_push($accounts, $newAccount);
        }


        return $accounts;
    }
}