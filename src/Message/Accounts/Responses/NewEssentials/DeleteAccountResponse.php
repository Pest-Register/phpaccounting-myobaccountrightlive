<?php


namespace PHPAccounting\MyobAccountRightLive\Message\Accounts\Responses\NewEssentials;


use Omnipay\Common\Message\AbstractResponse;
use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\ErrorResponseHelper;
use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\IndexSanityCheckHelper;

class DeleteAccountResponse extends AbstractResponse
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
                $additionalDetails = '';
                $message = '';
                if (array_key_exists('AdditionalDetails', $this->data['Errors'][0])) {
                    $additionalDetails = $this->data['Errors'][0]['AdditionalDetails'];
                }
                if (array_key_exists('Message', $this->data['Errors'][0])) {
                    $message = $this->data['Errors'][0]['Message'];
                }
                return ErrorResponseHelper::parseErrorResponse($message.' '.$additionalDetails, 'Account');
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

    /**
     * Return all Accounts with Generic Schema Variable Assignment
     * @return array
     */
    public function getAccounts(){
        $accounts = [];
        if (!array_key_exists('Items', $this->data)) {
            $account = $this->data;
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
            array_push($accounts, $newAccount);
        } else {
            foreach ($this->data['Items'] as $account) {
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
                array_push($accounts, $newAccount);
            }
        }


        return $accounts;
    }
}