<?php


namespace PHPAccounting\MyobAccountRightLive\Message\InventoryItems\Responses;

use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\IndexSanityCheckHelper;
use PHPAccounting\MyobAccountRightLive\Message\AbstractMYOBResponse;

class UpdateInventoryItemResponse extends AbstractMYOBResponse
{

    /**
     * @param $data
     * @param $item
     * @return mixed
     */
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
                    $item['buying_tax_inclusive'] = IndexSanityCheckHelper::indexSanityCheck('StandardCostTaxInclusive', $data['BuyingDetails']);
                }
            }
        }

        return $item;
    }

    /**
     * @param $data
     * @param $item
     * @return mixed
     */
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
                    $item['selling_tax_inclusive'] = IndexSanityCheckHelper::indexSanityCheck('IsTaxInclusive', $data['SellingDetails']);
                }
            }
        }

        return $item;
    }

    /**
     * @param $data
     * @param $item
     * @return mixed
     */
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
     * @param $data
     * @return string
     */
    private function parseType() {
        return 'PRODUCT';
    }

    /**
     * @param $item
     * @return mixed
     */
    private function parseData($item) {
        $newItem = [];
        $newItem['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $item);
        $newItem['code'] = IndexSanityCheckHelper::indexSanityCheck('Number', $item);
        $newItem['name'] = IndexSanityCheckHelper::indexSanityCheck('Name', $item);
        $newItem['description'] = IndexSanityCheckHelper::indexSanityCheck('Description', $item);
        $newItem['type'] = $this->parseType();
        $newItem['is_buying'] = IndexSanityCheckHelper::indexSanityCheck('IsBought', $item);
        $newItem['is_selling'] = IndexSanityCheckHelper::indexSanityCheck('IsSold', $item);
        $newItem['is_tracked'] = IndexSanityCheckHelper::indexSanityCheck('IsInventoried', $item);
        $newItem['buying_description'] = IndexSanityCheckHelper::indexSanityCheck('Description', $item);
        $newItem['selling_description'] = IndexSanityCheckHelper::indexSanityCheck('Description', $item);
        $newItem['quantity'] = IndexSanityCheckHelper::indexSanityCheck('QuantityAvailable', $item);
        $newItem['cost_pool'] = IndexSanityCheckHelper::indexSanityCheck('AverageCost', $item);
        $newItem['sync_token'] = IndexSanityCheckHelper::indexSanityCheck('RowVersion', $item);
        $newItem['updated_at'] = IndexSanityCheckHelper::indexSanityCheck('LastModified', $item);
        $newItem = $this->parsePurchaseDetails($item, $newItem);
        $newItem = $this->parseSellingDetails($item, $newItem);
        $newItem = $this->parseAssetDetails($item, $newItem);

        return $newItem;
    }

    /**
     * Return all Contacts with Generic Schema Variable Assignment
     * @return array
     */
    public function getInventoryItems(){
        $items = [];
        if ($this->data && !is_string($this->data)) {
            if (!array_key_exists('Items', $this->data)) {
                $newItem = $this->parseData($this->data);
                $items[] = $newItem;
            } else {
                foreach ($this->data['Items'] as $item) {
                    $newItem = $this->parseData($item);
                    $items[] = $newItem;
                }
            }
        }

        return $items;
    }
}