<?php

namespace PHPAccounting\MyobAccountRightLive\Message\AccountTypes\Responses\Essentials;

use Omnipay\Common\Message\AbstractResponse;
use PHPAccounting\MyobAccountRightLive\Helpers\Essentials\ErrorResponseHelper;
use PHPAccounting\MyobAccountRightLive\Helpers\Essentials\IndexSanityCheckHelper;

/**
 * Get AccountType(s) Response
 * @package PHPAccounting\MyobEssentials\Message\AccountTypes\Responses\Essentials
 */
class GetAccountTypeResponse extends AbstractResponse
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
     * @return array
     */
    public function getErrorMessage()
    {
        if ($this->data) {
            if (array_key_exists('errors', $this->data)) {
                return ErrorResponseHelper::parseErrorResponse($this->data['errors'][0]['message']);
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
    public function getAccountTypes(){
        $accountTypes = [];

        foreach($this->data['items'] as $accountType) {
            $newAccountType = [];
            $newAccountType['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('uid', $accountType);
            $newAccountType['name'] = IndexSanityCheckHelper::indexSanityCheck('name', $accountType);

            if (array_key_exists('classification', $accountType)) {
                $newAccountType['classification_name'] = IndexSanityCheckHelper::indexSanityCheck('name', $accountType['classification']);
                $newAccountType['classification_id'] = IndexSanityCheckHelper::indexSanityCheck('uid', $accountType['classification']);
            }
            array_push($accountTypes, $newAccountType);
        }
        return $accountTypes;
    }
}