<?php

namespace PHPAccounting\MyobAccountRightLive\Message\InventoryItems\Requests\Essentials;

use PHPAccounting\MyobAccountRightLive\Helpers\Essentials\IndexSanityCheckHelper;
use PHPAccounting\MyobAccountRightLive\Message\AbstractRequest;
use PHPAccounting\MyobAccountRightLive\Message\InventoryItems\Responses\Essentials\CreateInventoryItemResponse;


/**
 * Create InventoryItem(s)
 * @package PHPAccounting\MyobAccountRightLive\Message\InventoryItems\Requests\Essentials
 */
class CreateInventoryItemRequest extends AbstractRequest
{

    /**
     * Get Code Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/inventory/items
     * @return mixed
     */
    public function getCode(){
        return $this->getParameter('code');
    }

    /**
     * Set Code Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/inventory/items
     * @param string $value Account Code
     * @return CreateInventoryItemRequest
     */
    public function setCode($value){
        return $this->setParameter('code', $value);
    }

    /**
     * Get Inventory Asset AccountCode Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/inventory/items
     * @return mixed
     */
    public function getInventoryAccountCode() {
        return $this->getParameter('inventory_account_code');
    }

    /**
     * Set Inventory Asset AccountCode Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/inventory/items
     * @param $value
     * @return mixed
     */
    public function setInventoryAccountCode($value) {
        return $this->setParameter('inventory_account_code', $value);
    }

    /**
     * Get Name Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/inventory/items
     * @return mixed
     */
    public function getName() {
        return $this->getParameter('name');
    }

    /**
     * Set Name Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/inventory/items
     * @param $value
     * @return mixed
     */
    public function setName($value) {
        return $this->setParameter('name', $value);
    }

    /**
     * Get Is Buying Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/inventory/items
     * @return mixed
     */
    public function getIsBuying() {
        return $this->getParameter('is_buying');
    }

    /**
     * Set Is Buying Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/inventory/items
     * @param $value
     * @return mixed
     */
    public function setIsBuying($value) {
        return $this->setParameter('is_buying', $value);
    }

    /**
     * Get Is Buying Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/inventory/items
     * @return mixed
     */
    public function getIsSelling() {
        return $this->getParameter('is_selling');
    }

    /**
     * Set Is Selling Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/inventory/items
     * @param $value
     * @return mixed
     */
    public function setIsSelling($value) {
        return $this->setParameter('is_selling', $value);
    }

    /**
     * Get Description Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/inventory/items
     * @return mixed
     */
    public function getDescription() {
        return $this->getParameter('description');
    }

    /**
     * Set Description Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/inventory/items
     * @param $value
     * @return mixed
     */
    public function setDescription($value) {
        return $this->setParameter('description', $value);
    }

    /**
     * Get Buying Description Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/inventory/items
     * @return mixed
     */
    public function getBuyingDescription() {
        return $this->getParameter('buying_description');
    }

    /**
     * Set Buying Description Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/inventory/items
     * @param $value
     * @return mixed
     */
    public function setBuyingDescription($value) {
        return $this->setParameter('buying_description', $value);
    }

    /**
     * Get Buying Details Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/inventory/items
     * @return mixed
     */
    public function getBuyingDetails() {
        return $this->getParameter('buying_details');
    }

    /**
     * Set Buying Details Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/inventory/items
     * @param $value
     * @return mixed
     */
    public function setBuyingDetails($value) {
        return $this->setParameter('buying_details', $value);
    }

    /**
     * Get Sales Details Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/inventory/items
     * @return mixed
     */
    public function getSalesDetails() {
        return $this->getParameter('sales_details');
    }

    /**
     * Get Type Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/inventory/items
     * @return mixed
     */
    public function getType() {
        return $this->getParameter('type');
    }

    /**
     * Set Type Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/inventory/items
     * @param $value
     * @return mixed
     */
    public function setType($value) {
        return $this->setParameter('type', $value);
    }

    /**
     * Get Unit Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/inventory/items
     * @return mixed
     */
    public function getUnit() {
        return $this->getParameter('unit');
    }

    /**
     * Set Unit Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/inventory/items
     * @param $value
     * @return mixed
     */
    public function setUnit($value) {
        return $this->setParameter('unit', $value);
    }

    /**
     * Get Status Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/inventory/items
     * @return mixed
     */
    public function getStatus() {
        return $this->getParameter('status');
    }

    /**
     * Set Status Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/inventory/items
     * @param $value
     * @return mixed
     */
    public function setStatus($value) {
        return $this->setParameter('status', $value);
    }


    /**
     * Set Sales Details Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/inventory/items
     * @param $value
     * @return mixed
     */
    public function setSalesDetails($value) {
        return $this->setParameter('sales_details', $value);
    }

    private function parseSalesDetails($details, $data) {
        $data['saleAccount'] = [];
        $data['saleTaxType'] = [];
        $data['saleAccount']['uid'] = IndexSanityCheckHelper::indexSanityCheck('selling_account_id', $details);
        $data['saleTaxType']['uid'] = IndexSanityCheckHelper::indexSanityCheck('selling_tax_type_id', $details);
        $data['salePrice'] = IndexSanityCheckHelper::indexSanityCheck('selling_unit_price', $details);
        return $data;
    }

    private function parseBuyingDetails($details, $data) {
        $data['purchaseAccount'] = [];
        $data['purchaseTaxType'] = [];
        $data['purchaseAccount']['uid'] = IndexSanityCheckHelper::indexSanityCheck('buying_account_id', $details);
        $data['purchaseTaxType']['uid'] = IndexSanityCheckHelper::indexSanityCheck('buying_tax_type_id', $details);
        $data['purchasePrice'] = IndexSanityCheckHelper::indexSanityCheck('buying_unit_price', $details);
        return $data;
    }
    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('code');

        $this->issetParam('number', 'code');
        $this->issetParam('name', 'name');
        $this->issetParam('type', 'type');
        $this->issetParam('description', 'description');
        $this->issetParam('unitOfMeasure', 'unit');
        if($this->getStatus() !== null) {
            $this->data['active'] = ($this->getStatus() === 'ACTIVE' ? true : false);
        }
        if ($this->getSalesDetails() !== null) {
            $this->data = $this->parseSalesDetails($this->getSalesDetails(), $this->data);
        }

        if ($this->getBuyingDetails() !== null) {
            $this->data = $this->parseBuyingDetails($this->getBuyingDetails(), $this->data);
        }

        return $this->data;
    }


    public function getEndpoint()
    {

        $endpoint = 'inventory/items';
        return $endpoint;
    }

    public function getHttpMethod()
    {
        return 'POST';
    }

    protected function createResponse($data, $headers = [])
    {
        return $this->response = new CreateInventoryItemResponse($this, $data);
    }
}