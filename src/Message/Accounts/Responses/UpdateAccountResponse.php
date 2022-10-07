<?php


namespace PHPAccounting\MyobAccountRightLive\Message\Accounts\Responses;

use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\IndexSanityCheckHelper;
use PHPAccounting\MyobAccountRightLive\Message\AbstractMYOBResponse;

class UpdateAccountResponse extends AbstractMYOBResponse
{
    private function parseData($account) {
        $newAccount = [];
        $newAccount['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $account);
        $newAccount['code'] = IndexSanityCheckHelper::indexSanityCheck('DisplayID', $account);
        $newAccount['name'] = IndexSanityCheckHelper::indexSanityCheck('Name', $account);
        $newAccount['description'] = IndexSanityCheckHelper::indexSanityCheck('Description', $account);
        $newAccount['type'] = IndexSanityCheckHelper::indexSanityCheck('Type', $account);
        $newAccount['is_header'] = IndexSanityCheckHelper::indexSanityCheck('IsHeader', $account);
        $newAccount['sync_token'] = IndexSanityCheckHelper::indexSanityCheck('RowVersion', $account);

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

        if (array_key_exists('ParentAccount', $account)) {
            if ($account['ParentAccount']) {
                $newAccount['accounting_parent_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $account['ParentAccount']);
            }
        }

        return $newAccount;
    }


    /**
     * Return all Accounts with Generic Schema Variable Assignment
     * @return array
     */
    public function getAccounts(){
        $accounts = [];
        if ($this->data && !is_string($this->data)) {
            if (!array_key_exists('Items', $this->data)) {
                $newAccount = $this->parseData($this->data);
                $accounts[] = $newAccount;
            } else {
                foreach ($this->data['Items'] as $account) {
                    $newAccount = $this->parseData($account);
                    $accounts[] = $newAccount;
                }
            }
        }

        return $accounts;
    }
}