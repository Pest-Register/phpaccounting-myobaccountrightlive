<?php

namespace PHPAccounting\MyobAccountRightLive\Message\Accounts\Responses\AccountRight;

use Omnipay\Common\Message\AbstractResponse;
use PHPAccounting\MyobAccountRightLive\Helpers\AccountRight\IndexSanityCheckHelper;

/**
 * Get Account(s) Response
 * @package PHPAccounting\MyobAccountRightLive\Message\Accounts\Responses\AccountRight
 */
class GetAccountResponse extends AbstractResponse
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
     * @return string
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
                return 'NULL Returned from API or End of Pagination';
            }
        }

        return null;
    }
    /**
     * Return all Accounts with Generic Schema Variable Assignment
     * @return array
     */
    public function getAccounts(){
        $accounts = [];
        foreach ($this->data['Items'] as $account) {
            $newAccount = [];
            $newAccount['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $account);
            $newAccount['code'] = IndexSanityCheckHelper::indexSanityCheck('DisplayID', $account);
            $newAccount['name'] = IndexSanityCheckHelper::indexSanityCheck('Name', $account);
            $newAccount['description'] = IndexSanityCheckHelper::indexSanityCheck('Description', $account);
            $newAccount['type'] = IndexSanityCheckHelper::indexSanityCheck('Type', $account);

            if (array_key_exists('Type', $account)) {
                if ($account['Type']) {
                    $newAccount['is_bank_account'] = ($account['Type'] === 'Bank');
                }
            }

            if (array_key_exists('BankingDetails', $account)) {
                if ($account['BankingDetails']) {
                    $newAccount['bank_account_number'] = IndexSanityCheckHelper::indexSanityCheck('BankAccountNumber', $account['BankingDetails']);
                }
            }

            if (array_key_exists('TaxCode', $account)) {
                if ($account['TaxCode']) {
                    $newAccount['tax_type'] = IndexSanityCheckHelper::indexSanityCheck('Code', $account['TaxCode']);
                }
            }
            array_push($accounts, $newAccount);
        }

        return $accounts;
    }
}