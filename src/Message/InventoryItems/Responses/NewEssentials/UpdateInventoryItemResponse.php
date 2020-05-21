<?php


namespace PHPAccounting\MyobAccountRightLive\Message\InventoryItems\Responses\NewEssentials;

use Omnipay\Common\Message\AbstractResponse;
use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\ErrorResponseHelper;
use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\IndexSanityCheckHelper;

class UpdateInventoryItemResponse extends AbstractResponse
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
                return ErrorResponseHelper::parseErrorResponse($message.' '.$additionalDetails, 'InventoryItem');
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
     * Return all Contacts with Generic Schema Variable Assignment
     * @return array
     */
    public function getInventoryItems(){
        $items = [];
        if (!array_key_exists('Items', $this->data)) {
            $item = $this->data;
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
        } else {
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
        }


        return $items;
    }
}