<?php

namespace PHPAccounting\MyobAccountRightLive\Message\Payments\Requests\Traits;

trait PaymentRequestTrait
{
    /**
     * Get Amount Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/customerpayment/
     * @return mixed
     */
    public function getAmount(){
        return $this->getParameter('amount');
    }

    /**
     * Set Amount Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/customerpayment/
     * @param string $value Payment Amount
     */
    public function setAmount($value){
        return $this->setParameter('amount', $value);
    }

    /**
     * Get Currency Rate Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/customerpayment/
     * @return mixed
     */
    public function getCurrencyRate(){
        return $this->getParameter('currency_rate');
    }

    /**
     * Set Amount Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/customerpayment/
     * @param string $value Payment Currency Rate
     */
    public function setCurrencyRate($value){
        return $this->setParameter('currency_rate', $value);
    }

    /**
     * Get Currency Rate Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/customerpayment/
     * @return mixed
     */
    public function getReferenceID(){
        return $this->getParameter('reference_id');
    }

    /**
     * Set Amount Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/customerpayment/
     * @param string $value Payment Reference ID
     */
    public function setReferenceID($value){
        return $this->setParameter('reference_id', $value);
    }

    /**
     * Get Is Reconciled Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/customerpayment/
     * @return mixed
     */
    public function getIsReconciled(){
        return $this->getParameter('is_reconciled');
    }

    /**
     * Set Is Reconciled Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/customerpayment/
     * @param string $value Payment Is Reconcile
     */
    public function setIsReconciled($value){
        return $this->setParameter('is_reconciled', $value);
    }

    /**
     * Get Invoice Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/customerpayment/
     * @return mixed
     */
    public function getInvoice(){
        return $this->getParameter('invoice');
    }

    /**
     * Set Invoice Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/customerpayment/
     * @param string $value Invoice
     */
    public function setInvoice($value){
        return $this->setParameter('invoice', $value);
    }
    /**
     * Get Contact Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/customerpayment/
     * @return mixed
     */
    public function getContact(){
        return $this->getParameter('contact');
    }

    /**
     * Set Contact Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/customerpayment/
     * @param string $value Invoice
     */
    public function setContact($value){
        return $this->setParameter('contact', $value);
    }
    /**
     * Get Account Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/customerpayment/
     * @return mixed
     */
    public function getAccount(){
        return $this->getParameter('account');
    }

    /**
     * Set Account Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/customerpayment/
     * @param string $value Invoice
     */
    public function setAccount($value){
        return $this->setParameter('account', $value);
    }

    /**
     * Get Credit Note Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/customerpayment/
     * @return mixed
     */
    public function getCreditNote(){
        return $this->getParameter('credit_note');
    }

    /**
     * Set Credit Note Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/customerpayment/
     * @param string $value CreditNote
     */
    public function setCreditNote($value){
        return $this->setParameter('credit_note', $value);
    }

    /**
     * Get Prepayment Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/customerpayment/
     * @return mixed
     */
    public function getPrepayment(){
        return $this->getParameter('prepayment');
    }

    /**
     * Set Prepayment Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/customerpayment/
     * @param string $value Prepayment
     */
    public function setPrepayment($value){
        return $this->setParameter('prepayment', $value);
    }

    /**
     * Get Overpayment Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/customerpayment/
     * @return mixed
     */
    public function getOverpayment(){
        return $this->getParameter('overpayment');
    }

    /**
     * Set Overpayment Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/customerpayment/
     * @param string $value Overpayment
     */
    public function setOverpayment($value){
        return $this->setParameter('overpayment', $value);
    }

    /**
     * Get Date Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/customerpayment/
     * @return mixed
     */
    public function getDate(){
        return $this->getParameter('date');
    }

    /**
     * Set Date Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/customerpayment/
     * @param string $value Date
     */
    public function setDate($value){
        return $this->setParameter('date', $value);
    }
}