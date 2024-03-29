<?php

namespace PHPAccounting\MyobAccountRightLive\Message\InventoryItems\Requests\Traits;

use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\IndexSanityCheckHelper;

trait InventoryItemRequestTrait
{
    /**
     * Get Code Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/inventory/item/
     * @return mixed
     */
    public function getCode(){
        return $this->getParameter('code');
    }

    /**
     * Set Code Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/inventory/item/
     * @param string $value Account Code
     */
    public function setCode($value){
        return $this->setParameter('code', $value);
    }

    /**
     * Get Inventory Asset AccountCode Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/inventory/item/
     * @return mixed
     */
    public function getInventoryAccountCode() {
        return $this->getParameter('inventory_account_code');
    }

    /**
     * Set Inventory Asset AccountCode Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/inventory/item/
     * @param $value
     * @return mixed
     */
    public function setInventoryAccountCode($value) {
        return $this->setParameter('inventory_account_code', $value);
    }

    /**
     * Set Sync Token Parameter from Parameter Bag
     * @return mixed
     */
    public function setSyncToken($value) {
        return $this->setParameter('sync_token', $value);
    }

    /**
     * Get IsHeader Parameter from Parameter Bag
     * @return mixed
     */
    public function getSyncToken(){
        return $this->getParameter('sync_token');
    }

    /**
     * Get Name Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/inventory/item/
     * @return mixed
     */
    public function getName() {
        return $this->getParameter('name');
    }

    /**
     * Set Name Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/inventory/item/
     * @param $value
     * @return mixed
     */
    public function setName($value) {
        return $this->setParameter('name', $value);
    }

    /**
     * Get Is Buying Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/inventory/item/
     * @return mixed
     */
    public function getIsBuying() {
        return $this->getParameter('is_buying');
    }

    /**
     * Set Is Buying Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/inventory/item/
     * @param $value
     * @return mixed
     */
    public function setIsBuying($value) {
        return $this->setParameter('is_buying', $value);
    }

    /**
     * Get Is Buying Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/inventory/item/
     * @return mixed
     */
    public function getIsSelling() {
        return $this->getParameter('is_selling');
    }

    /**
     * Set Is Selling Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/inventory/item/
     * @param $value
     * @return mixed
     */
    public function setIsSelling($value) {
        return $this->setParameter('is_selling', $value);
    }

    /**
     * Get Description Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/inventory/item/
     * @return mixed
     */
    public function getDescription() {
        return $this->getParameter('description');
    }

    /**
     * Set Description Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/inventory/item/
     * @param $value
     * @return mixed
     */
    public function setDescription($value) {
        return $this->setParameter('description', $value);
    }

    /**
     * Get Buying Description Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/inventory/item/
     * @return mixed
     */
    public function getBuyingDescription() {
        return $this->getParameter('buying_description');
    }

    /**
     * Set Buying Description Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/inventory/item/
     * @param $value
     * @return mixed
     */
    public function setBuyingDescription($value) {
        return $this->setParameter('buying_description', $value);
    }

    /**
     * Get Buying Details Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/inventory/item/
     * @return mixed
     */
    public function getBuyingDetails() {
        return $this->getParameter('buying_details');
    }

    /**
     * Set Buying Details Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/inventory/item/
     * @param $value
     * @return mixed
     */
    public function setBuyingDetails($value) {
        return $this->setParameter('buying_details', $value);
    }

    /**
     * Get Sales Details Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/inventory/item/
     * @return mixed
     */
    public function getSalesDetails() {
        return $this->getParameter('sales_details');
    }

    /**
     * Get Type Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/inventory/item/
     * @return mixed
     */
    public function getType() {
        return $this->getParameter('type');
    }

    /**
     * Set Type Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/inventory/item/
     * @param $value
     * @return mixed
     */
    public function setType($value) {
        return $this->setParameter('type', $value);
    }

    /**
     * Get Unit Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/inventory/item/
     * @return mixed
     */
    public function getUnit() {
        return $this->getParameter('unit');
    }

    /**
     * Set Unit Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/inventory/item/
     * @param $value
     * @return mixed
     */
    public function setUnit($value) {
        return $this->setParameter('unit', $value);
    }
    /**
     * Get Is Tracked Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/inventory/item/
     * @return mixed
     */
    public function getIsTracked() {
        return $this->getParameter('is_tracked');
    }

    /**
     * Set Is Tracked Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/inventory/item/
     * @param $value
     * @return mixed
     */
    public function setIsTracked($value) {
        return $this->setParameter('is_tracked', $value);
    }
    /**
     * Get Status Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/inventory/item/
     * @return mixed
     */
    public function getStatus() {
        return $this->getParameter('status');
    }

    /**
     * Set Status Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/inventory/item/
     * @param $value
     * @return mixed
     */
    public function setStatus($value) {
        return $this->setParameter('status', $value);
    }


    /**
     * Set Sales Details Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/inventory/item/
     * @param $value
     * @return mixed
     */
    public function setSalesDetails($value) {
        return $this->setParameter('sales_details', $value);
    }

    private function parseSalesDetails($details, $data) {
        $data['IncomeAccount'] = [];
        $data['SellingDetails'] = [];
        $data['IsSold'] = true;
        $data['IncomeAccount']['UID'] = IndexSanityCheckHelper::indexSanityCheck('selling_account_id', $details);
        $data['SellingDetails']['TaxCode']['UID'] = IndexSanityCheckHelper::indexSanityCheck('selling_tax_type_id', $details);
        $data['SellingDetails']['BaseSellingPrice'] = IndexSanityCheckHelper::indexSanityCheck('selling_unit_price', $details);
        $data['SellingDetails']['IsTaxInclusive'] = IndexSanityCheckHelper::indexSanityCheck('selling_tax_inclusive', $details);
        return $data;
    }

    private function parseBuyingDetails($details, $data) {
        $data['ExpenseAccount'] = [];
        $data['BuyingDetails'] = [];
        $data['IsBought'] = true;
        $data['ExpenseAccount']['UID'] = IndexSanityCheckHelper::indexSanityCheck('buying_account_id', $details);
        $data['BuyingDetails']['TaxCode']['UID'] = IndexSanityCheckHelper::indexSanityCheck('buying_tax_type_id', $details);
        $data['BuyingDetails']['StandardCost'] = IndexSanityCheckHelper::indexSanityCheck('buying_unit_price', $details);
        $data['BuyingDetails']['StandardCostTaxInclusive'] = IndexSanityCheckHelper::indexSanityCheck('buying_tax_inclusive', $details);
        return $data;
    }
}
