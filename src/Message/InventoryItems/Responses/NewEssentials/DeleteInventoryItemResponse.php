<?php


namespace PHPAccounting\MyobAccountRightLive\Message\InventoryItems\Responses\NewEssentials;


use Omnipay\Common\Message\AbstractResponse;
use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\ErrorResponseHelper;
use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\IndexSanityCheckHelper;

class DeleteInventoryItemResponse extends AbstractResponse
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
                return ErrorResponseHelper::parseErrorResponse($this->data['Errors'][0]['Message'], 'InventoryItem');
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

    public function parsePurchaseDetails($data, $item) {
        if ($data) {
            if (array_key_exists('ExpenseAccount', $data)) {
                if ($data['ExpenseAccount']) {
                    $item['buying_account_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $data['ExpenseAccount']);
                    $item['buying_account_code'] = IndexSanityCheckHelper::indexSanityCheck('DisplayID', $data['ExpenseAccount']);
                }
            } else if (array_key_exists('CostOfSalesAccount', $data)) {
                if ($data['CostOfSalesAccount']) {
                    $item['buying_account_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $data['CostOfSalesAccount']);
                    $item['buying_account_code'] = IndexSanityCheckHelper::indexSanityCheck('DisplayID', $data['CostOfSalesAccount']);
                }
            }
            if (array_key_exists('BuyingDetails', $data)) {
                if ($data['BuyingDetails']) {
                    if (array_key_exists('TaxCode', $data['BuyingDetails'])) {
                        if ($data['BuyingDetails']['TaxCode']) {
                            $item['buying_tax_type_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $data['BuyingDetails']['TaxCode']);
                            $item['buying_tax_type_code'] = IndexSanityCheckHelper::indexSanityCheck('Code', $data['BuyingDetails']['TaxCode']);
                        }
                    }
                    $item['buying_unit_price'] = IndexSanityCheckHelper::indexSanityCheck('StandardCost', $data['BuyingDetails']);
                }
            }
        }

        return $item;
    }

    public function parseSellingDetails($data, $item) {
        if ($data) {
            if (array_key_exists('IncomeAccount', $data)) {
                if ($data['IncomeAccount']) {
                    $item['selling_account_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $data['IncomeAccount']);
                    $item['selling_account_code'] = IndexSanityCheckHelper::indexSanityCheck('DisplayID', $data['IncomeAccount']);
                }
            }
            if (array_key_exists('SellingDetails', $data)) {
                if ($data['SellingDetails']) {
                    if (array_key_exists('TaxCode', $data['SellingDetails'])) {
                        if ($data['SellingDetails']['TaxCode']) {
                            $item['selling_tax_type_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $data['SellingDetails']['TaxCode']);
                            $item['selling_tax_type_code'] = IndexSanityCheckHelper::indexSanityCheck('Code', $data['SellingDetails']['TaxCode']);
                        }
                    }
                    $item['selling_unit_price'] = IndexSanityCheckHelper::indexSanityCheck('BaseSellingPrice', $data['SellingDetails']);
                }
            }
        }

        return $item;
    }

    private function parseAssetDetails($data, $item) {
        if ($data) {
            if (array_key_exists('AssetAccount', $data)) {
                if ($data['AssetAccount']) {
                    $item['asset_account_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $data['AssetAccount']);
                    $item['asset_account_code'] = IndexSanityCheckHelper::indexSanityCheck('DisplayID', $data['AssetAccount']);
                }
            }
        }

        return $item;
    }

    /**
     * Return all Contacts with Generic Schema Variable Assignment
     * @return array
     */
    public function getInventoryItems(){
        $items = [];
        foreach ($this->data['Items'] as $item) {
            $newItem = [];
            $newItem['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $item);
            $newItem['code'] = IndexSanityCheckHelper::indexSanityCheck('Number', $item);
            $newItem['name'] = IndexSanityCheckHelper::indexSanityCheck('Name', $item);
            $newItem['description'] = IndexSanityCheckHelper::indexSanityCheck('Description', $item);
            $newItem['type'] = 'UNSPECIFIED';
            $newItem['is_buying'] = IndexSanityCheckHelper::indexSanityCheck('IsBought', $item);
            $newItem['is_selling'] = IndexSanityCheckHelper::indexSanityCheck('IsSold', $item);
            $newItem['buying_description'] = IndexSanityCheckHelper::indexSanityCheck('Description', $item);
            $newItem['selling_description'] = IndexSanityCheckHelper::indexSanityCheck('Description', $item);
            $newItem['quantity'] = IndexSanityCheckHelper::indexSanityCheck('QuantityAvailable', $item);
            $newItem['cost_pool'] = IndexSanityCheckHelper::indexSanityCheck('AverageCost', $item);
            $newItem['sync_token'] = IndexSanityCheckHelper::indexSanityCheck('RowVersion', $item);
            $newItem = $this->parsePurchaseDetails($item, $newItem);
            $newItem = $this->parseSellingDetails($item, $newItem);
            $newItem = $this->parseAssetDetails($item, $newItem);
            array_push($items, $newItem);
        }

        return $items;
    }
}