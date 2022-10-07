<?php

namespace PHPAccounting\MyobAccountRightLive\Message\TaxRates\Responses;

use Omnipay\Common\Message\AbstractResponse;
use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\ErrorResponseHelper;
use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\IndexSanityCheckHelper;
use PHPAccounting\MyobAccountRightLive\Message\AbstractMYOBResponse;

/**
 * Get Tax Rate(s) Response
 * @package PHPAccounting\MyobAccountRightLive\Message\TaxRates\Responses\NewEssentials
 */
class GetTaxRateResponse extends AbstractMYOBResponse
{

    private function parseData($taxRate) {
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
        $newTaxRate['updated_at'] = IndexSanityCheckHelper::indexSanityCheck('LastModified', $taxRate);

        return $newTaxRate;
    }
    /**
     * Return all Accounts with Generic Schema Variable Assignment
     * @return array
     */
    public function getTaxRates(){
        $taxRates = [];
        if ($this->data && !is_string($this->data)) {
            if (!array_key_exists('Items', $this->data)) {
                $newTaxRate = $this->parseData($this->data);
                $taxRates[] = $newTaxRate;
            } else {
                foreach ($this->data['Items'] as $taxRate) {
                    $newTaxRate = $this->parseData($taxRate);
                    $taxRates[] = $newTaxRate;
                }
            }
        }

        return $taxRates;
    }
}