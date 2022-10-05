<?php

namespace PHPAccounting\MyobAccountRightLive\Message\Accounts\Requests;

use PHPAccounting\MyobAccountRightLive\Message\AbstractRequest;
use PHPAccounting\MyobAccountRightLive\Message\Accounts\Responses\CreateAccountResponse;

/**
 * Create Account(s)
 * @package PHPAccounting\MyobAccountRightLive\Message\Accounts\NewEssentials\Requests
 */
class CreateAccountRequest extends AbstractRequest
{
    /**
     * Get Code Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/generalledger/account/
     * @return mixed
     */
    public function getCode(){
        return $this->getParameter('code');
    }

    /**
     * Set Code Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/generalledger/account/
     * @param string $value Account Code
     * @return CreateAccountRequest
     */
    public function setCode($value){
        return $this->setParameter('code', $value);
    }

    /**
     * Get Name Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/generalledger/account/
     * @return mixed
     */
    public function getName(){
        return $this->getParameter('name');
    }

    /**
     * Set Name Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/generalledger/account/
     * @param string $value Account Name
     * @return CreateAccountRequest
     */
    public function setName($value){
        return $this->setParameter('name', $value);
    }

    /**
     * Get Type Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/generalledger/account/
     * @return mixed
     */
    public function getType(){
        return $this->getParameter('type');
    }

    /**
     * Set Type Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/generalledger/account/
     * @param string $value Account Type
     * @return CreateAccountRequest
     */
    public function setType($value){
        return $this->setParameter('type', $value);
    }

    /**
     * Get Type Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/generalledger/account/
     * @return mixed
     */
    public function getTypeID(){
        return $this->getParameter('type_id');
    }

    /**
     * Set Type Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/generalledger/account/
     * @param string $value Account Type
     * @return CreateAccountRequest
     */
    public function setTypeID($value){
        return $this->setParameter('type_id', $value);
    }

    /**
     * Get Status Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/generalledger/account/
     * @return mixed
     */
    public function getStatus(){
        return $this->getParameter('status');
    }

    /**
     * Set Status Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/generalledger/account/
     * @param string $value Account Status
     * @return CreateAccountRequest
     */
    public function setStatus($value){
        return $this->setParameter('status', $value);
    }

    /**
     * Get Description Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/generalledger/account/
     * @return mixed
     */
    public function getDescription(){
        return $this->getParameter('description');
    }

    /**
     * Set Description Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/generalledger/account/
     * @param string $value Account Description
     * @return CreateAccountRequest
     */
    public function setDescription($value){
        return $this->setParameter('description', $value);
    }

    /**
     * Get Tax Type Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/generalledger/account/
     * @return mixed
     */
    public function getTaxType(){
        return $this->getParameter('tax_type');
    }

    /**
     * Set Tax Type Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/generalledger/account/
     * @param string $value Account Tax Type
     * @return CreateAccountRequest
     */
    public function setTaxType($value){
        return $this->setParameter('tax_type', $value);
    }

    /**
     * Get Tax Type ID Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/generalledger/account/
     * @return mixed
     */
    public function getTaxTypeID(){
        return $this->getParameter('tax_type_id');
    }

    /**
     * Set Accounting Parent ID Parameter from Parameter Bag
     * @return mixed
     */
    public function setAccountingParentID($value) {
        return $this->setParameter('accounting_parent_id', $value);
    }

    /**
     * Get Accounting Parent ID Parameter from Parameter Bag
     * @return mixed
     */
    public function getAccountingParentID(){
        return $this->getParameter('accounting_parent_id');
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
     * Set Header Parameter from Parameter Bag
     * @return mixed
     */
    public function setIsHeader($value) {
        return $this->setParameter('is_header', $value);
    }

    /**
     * Get IsHeader Parameter from Parameter Bag
     * @return mixed
     */
    public function getIsHeader(){
        return $this->getParameter('is_header');
    }


    /**
     * Set Tax Type Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/generalledger/account/
     * @param string $value Account Tax Type
     * @return CreateAccountRequest
     */
    public function setTaxTypeID($value){
        return $this->setParameter('tax_type_id', $value);
    }

    public function getData()
    {
        $this->validate('code', 'name', 'type', 'tax_type', 'accounting_parent_id');

        $this->issetParam('DisplayID', 'code');
        $this->issetParam('Name', 'name');
        $this->issetParam('Type', 'type');
        $this->issetParam('Description','description');
        $this->issetParam('IsHeader', 'is_header');
        $this->issetParam('RowVersion', 'sync_token');

        if($this->getAccountingParentID()) {
            $this->data['ParentAccount'] = [
                'UID' => $this->getAccountingParentID()
            ];
        }

        if($this->getStatus() !== null) {
            $this->data['IsActive'] = ($this->getStatus() === 'ACTIVE' ? true : false);
        }

        if ($this->getTaxType() !== null && $this->getTaxTypeID() !== null) {
            $this->data['TaxCode'] = [
              'UID' => $this->getTaxTypeID()
            ];
        }

        return $this->data;
    }

    public function getEndpoint()
    {

        $endpoint = 'GeneralLedger/Account?returnBody=true';
        return $endpoint;
    }

    public function getHttpMethod()
    {
        return 'POST';
    }

    protected function createResponse($data, $headers = [])
    {
        return $this->response = new CreateAccountResponse($this, $data);
    }
}