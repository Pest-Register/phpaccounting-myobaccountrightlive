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
            if (is_string($this->data)) {
                return true;
            } else {
                if (array_key_exists('Errors', $this->data)) {
                    return !$this->data['Errors'][0]['Severity'] == 'Error';
                }
                if (array_key_exists('Items', $this->data)) {
                    if (count($this->data['Items']) === 0) {
                        return false;
                    }
                }
            }
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
            if (is_string($this->data)) {
                $additionalDetails = '';
                $errorCode = '';
                $status ='';
                $response = $this->data;
                return ErrorResponseHelper::parseErrorResponse(
                    $response,
                    $status,
                    $errorCode,
                    null,
                    $additionalDetails,
                    'InventoryItem'
                );
            } else {
                if (array_key_exists('Errors', $this->data)) {
                    $additionalDetails = '';
                    $message = '';
                    $errorCode = '';
                    $status ='';
                    if (array_key_exists('AdditionalDetails', $this->data['Errors'][0])) {
                        $additionalDetails = $this->data['Errors'][0]['AdditionalDetails'];
                    }
                    if (array_key_exists('ErrorCode', $this->data['Errors'][0])) {
                        $errorCode = $this->data['Errors'][0]['ErrorCode'];
                    }
                    if (array_key_exists('Severity', $this->data['Errors'][0])) {
                        $status = $this->data['Errors'][0]['Severity'];
                    }
                    if (array_key_exists('Message', $this->data['Errors'][0])) {
                        $message = $this->data['Errors'][0]['Message'];
                    }
                    $response = $message.' '.$additionalDetails;
                    return ErrorResponseHelper::parseErrorResponse(
                        $response,
                        $status,
                        $errorCode,
                        null,
                        $additionalDetails,
                        'InventoryItem'
                    );
                } else {
                    if (array_key_exists('Items', $this->data)) {
                        if (count($this->data['Items']) == 0) {
                            return [
                                'message' => 'NULL Returned from API or End of Pagination',
                                'exception' =>'NULL Returned from API or End of Pagination',
                                'error_code' => null,
                                'status_code' => null,
                                'detail' => null
                            ];
                        }
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
                    $item['buying_tax_inclusive'] = IndexSanityCheckHelper::indexSanityCheck('StandardCostTaxInclusive', $data['BuyingDetails']);
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
                    $item['selling_tax_inclusive'] = IndexSanityCheckHelper::indexSanityCheck('IsTaxInclusive', $data['SellingDetails']);
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
     * @param $data
     * @return string
     */
    private function parseType() {
        return 'PRODUCT';
    }

    /**
     * Return all Contacts with Generic Schema Variable Assignment
     * @return array
     */
    public function getInventoryItems(){
        $items = [];
        if (!is_string($this->data)) {
            if (!array_key_exists('Items', $this->data)) {
                $item = $this->data;
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
                array_push($items, $newItem);
            } else {
                foreach ($this->data['Items'] as $item) {
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
                    array_push($items, $newItem);
                }
            }
        }

        return $items;
    }
}