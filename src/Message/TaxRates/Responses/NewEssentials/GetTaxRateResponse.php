<?php

namespace PHPAccounting\MyobAccountRightLive\Message\TaxRates\Responses\NewEssentials;

use Omnipay\Common\Message\AbstractResponse;
use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\ErrorResponseHelper;
use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\IndexSanityCheckHelper;

/**
 * Get Tax Rate(s) Response
 * @package PHPAccounting\MyobAccountRightLive\Message\TaxRates\Responses\NewEssentials
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
                $additionalDetails = '';
                $message = '';
                if (array_key_exists('AdditionalDetails', $this->data['Errors'][0])) {
                    $additionalDetails = $this->data['Errors'][0]['AdditionalDetails'];
                }
                if (array_key_exists('Message', $this->data['Errors'][0])) {
                    $message = $this->data['Errors'][0]['Message'];
                }
                return ErrorResponseHelper::parseErrorResponse($message.' '.$additionalDetails, 'TaxRate');
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
     * Return all Accounts with Generic Schema Variable Assignment
     * @return array
     */
    public function getTaxRates(){
        $taxRates = [];
        if (!array_key_exists('Items', $this->data)) {
            $taxRate = $this->data;
            $newTaxRate = [];
            $newTaxRate['accounting_id'] =  IndexSanityCheckHelper::indexSanityCheck('UID', $taxRate);
            $newTaxRate['name'] = IndexSanityCheckHelper::indexSanityCheck('Description', $taxRate);
            $newTaxRate['tax_type'] = IndexSanityCheckHelper::indexSanityCheck('Code', $taxRate);
            $newTaxRate['rate'] = IndexSanityCheckHelper::indexSanityCheck('Rate', $taxRate);
            $newTaxRate['sync_token'] = IndexSanityCheckHelper::indexSanityCheck('RowVersion', $taxRate);
            $newTaxRate['is_asset'] = true;
            $newTaxRate['is_equity'] = true;
            $newTaxRate['is_expense'] = true;
            $newTaxRate['is_liability'] = true;
            $newTaxRate['is_revenue'] = true;

            array_push($taxRates, $newTaxRate);
        } else {
            foreach ($this->data['Items'] as $taxRate) {
                $newTaxRate = [];
                $newTaxRate['accounting_id'] =  IndexSanityCheckHelper::indexSanityCheck('UID', $taxRate);
                $newTaxRate['name'] = IndexSanityCheckHelper::indexSanityCheck('Description', $taxRate);
                $newTaxRate['tax_type'] = IndexSanityCheckHelper::indexSanityCheck('Code', $taxRate);
                $newTaxRate['rate'] = IndexSanityCheckHelper::indexSanityCheck('Rate', $taxRate);
                $newTaxRate['sync_token'] = IndexSanityCheckHelper::indexSanityCheck('RowVersion', $taxRate);
                $newTaxRate['is_asset'] = true;
                $newTaxRate['is_equity'] = true;
                $newTaxRate['is_expense'] = true;
                $newTaxRate['is_liability'] = true;
                $newTaxRate['is_revenue'] = true;

                array_push($taxRates, $newTaxRate);
            }
        }


        return $taxRates;
    }
}