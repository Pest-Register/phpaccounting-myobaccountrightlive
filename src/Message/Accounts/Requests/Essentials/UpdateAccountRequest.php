<?php

namespace PHPAccounting\MyobAccountRightLive\Message\Accounts\Requests;

use PHPAccounting\MyobAccountRightLive\Helpers\Essentials\BuildEndpointHelper;
use PHPAccounting\MyobAccountRightLive\Message\AbstractRequest;
use PHPAccounting\MyobAccountRightLive\Message\Accounts\Responses\Essentials\UpdateAccountResponse;

/**
 * Update Account(s)
 * @package PHPAccounting\MyobAccountRightLive\Message\Accounts\Essentials\Requests
 */
class UpdateAccountRequest extends AbstractRequest
{
    /**
     * Set AccountingID from Parameter Bag (UID generic interface)
     * @param $value
     * @return UpdateAccountRequest
     */
    public function setAccountingID($value) {
        return $this->setParameter('accounting_id', $value);
    }

    /**
     * Return Accounting ID (UID)
     * @return mixed comma-delimited-string
     */
    public function getAccountingID() {
        if ($this->getParameter('accounting_id')) {
            return $this->getParameter('accounting_id');
        }
        return null;
    }
    /**
     * Get Code Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/generalledger/accounts
     * @return mixed
     */
    public function getCode(){
        return $this->getParameter('code');
    }

    /**
     * Set Code Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/generalledger/accounts
     * @param string $value Account Code
     * @return UpdateAccountRequest
     */
    public function setCode($value){
        return $this->setParameter('code', $value);
    }

    /**
     * Get Name Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/generalledger/accounts
     * @return mixed
     */
    public function getName(){
        return $this->getParameter('name');
    }

    /**
     * Set Name Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/generalledger/accounts
     * @param string $value Account Name
     * @return UpdateAccountRequest
     */
    public function setName($value){
        return $this->setParameter('name', $value);
    }

    /**
     * Get Type Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/generalledger/accounts
     * @return mixed
     */
    public function getType(){
        return $this->getParameter('type');
    }

    /**
     * Set Type Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/generalledger/accounts
     * @param string $value Account Type
     * @return UpdateAccountRequest
     */
    public function setType($value){
        return $this->setParameter('type', $value);
    }

    /**
     * Get Type Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/generalledger/accounts
     * @return mixed
     */
    public function getTypeID(){
        return $this->getParameter('type_id');
    }

    /**
     * Set Type Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/generalledger/accounts
     * @param string $value Account Type
     * @return UpdateAccountRequest
     */
    public function setTypeID($value){
        return $this->setParameter('type_id', $value);
    }

    /**
     * Get Status Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/generalledger/accounts
     * @return mixed
     */
    public function getStatus(){
        return $this->getParameter('status');
    }

    /**
     * Set Status Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/generalledger/accounts
     * @param string $value Account Status
     * @return UpdateAccountRequest
     */
    public function setStatus($value){
        return $this->setParameter('status', $value);
    }

    /**
     * Get Description Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/generalledger/accounts
     * @return mixed
     */
    public function getDescription(){
        return $this->getParameter('description');
    }

    /**
     * Set Description Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/generalledger/accounts
     * @param string $value Account Description
     * @return UpdateAccountRequest
     */
    public function setDescription($value){
        return $this->setParameter('description', $value);
    }

    /**
     * Get Tax Type Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/generalledger/accounts
     * @return mixed
     */
    public function getTaxType(){
        return $this->getParameter('tax_type');
    }

    /**
     * Set Tax Type Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/generalledger/accounts
     * @param string $value Account Tax Type
     * @return UpdateAccountRequest
     */
    public function setTaxType($value){
        return $this->setParameter('tax_type', $value);
    }

    /**
     * Get Tax Type ID Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/generalledger/accounts
     * @return mixed
     */
    public function getTaxTypeID(){
        return $this->getParameter('tax_type_id');
    }

    /**
     * Set Tax Type Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/generalledger/accounts
     * @param string $value Account Tax Type
     * @return UpdateAccountRequest
     */
    public function setTaxTypeID($value){
        return $this->setParameter('tax_type_id', $value);
    }

    public function getData()
    {
        $this->validate('code', 'name', 'type', 'type_id', 'tax_type', 'tax_type_id');
        $this->issetParam('uid', 'accounting_id');
        $this->issetParam('displayId', 'code');
        $this->issetParam('name', 'name');
        if($this->getStatus() !== null) {
            $this->data['active'] = ($this->getStatus() === 'ACTIVE' ? true : false);
        }

        if ($this->getType() !== null && $this->getTypeID() !== null) {
            $this->data['type'] = [
                'uid' => $this->getTypeID(),
            ];
        }

        if ($this->getTaxType() !== null && $this->getTaxTypeID() !== null) {
            $this->data['taxType'] = [
                'uid' => $this->getTaxTypeID()
            ];
        }

        return $this->data;
    }

    public function getEndpoint()
    {

        $endpoint = 'generalledger/accounts';
        if ($this->getAccountingID()) {
            if ($this->getAccountingID() !== "") {
                $endpoint = BuildEndpointHelper::createForGUID($endpoint, $this->getAccountingID());
            }
        }
        return $endpoint;
    }

    public function getHttpMethod()
    {
        return 'PUT';
    }

    protected function createResponse($data, $headers = [])
    {
        return $this->response = new UpdateAccountResponse($this, $data);
    }
}