<?php

namespace PHPAccounting\MyobAccountRightLive\Message\TaxRates\Responses\Essentials;

use Omnipay\Common\Message\AbstractResponse;
use PHPAccounting\MyobAccountRightLive\Helpers\Essentials\ErrorResponseHelper;
use PHPAccounting\MyobAccountRightLive\Helpers\Essentials\IndexSanityCheckHelper;

/**
 * Get TaxRate(s) Response
 * @package PHPAccounting\MyobEssentials\Message\TaxRates\Responses\Essentials
 */
class GetTaxRateResponse extends AbstractResponse
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
    public function getTaxRates(){
        $taxRates = [];
        if (array_key_exists('items', $this->data)) {
            foreach ($this->data['items'] as $taxRate) {
                $newTaxRate = [];
                $newTaxRate['accounting_id'] =  IndexSanityCheckHelper::indexSanityCheck('uid', $taxRate);
                $newTaxRate['name'] = IndexSanityCheckHelper::indexSanityCheck('name', $taxRate);
                $newTaxRate['tax_type'] = IndexSanityCheckHelper::indexSanityCheck('code', $taxRate);
                $newTaxRate['rate'] = IndexSanityCheckHelper::indexSanityCheck('rate', $taxRate);
                $newTaxRate['is_asset'] = true;
                $newTaxRate['is_equity'] = true;
                $newTaxRate['is_expense'] = true;
                $newTaxRate['is_liability'] = true;
                $newTaxRate['is_revenue'] = true;
                array_push($taxRates, $newTaxRate);
            }
        } else {
            $taxRate = $this->data;
            $newTaxRate = [];
            $newTaxRate['accounting_id'] =  IndexSanityCheckHelper::indexSanityCheck('uid', $taxRate);
            $newTaxRate['name'] = IndexSanityCheckHelper::indexSanityCheck('name', $taxRate);
            $newTaxRate['tax_type'] = IndexSanityCheckHelper::indexSanityCheck('code', $taxRate);
            $newTaxRate['rate'] = IndexSanityCheckHelper::indexSanityCheck('rate', $taxRate);
            $newTaxRate['is_asset'] = true;
            $newTaxRate['is_equity'] = true;
            $newTaxRate['is_expense'] = true;
            $newTaxRate['is_liability'] = true;
            $newTaxRate['is_revenue'] = true;
            array_push($taxRates, $newTaxRate);
        }


        return $taxRates;
    }
}