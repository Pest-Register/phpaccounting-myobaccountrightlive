<?php


namespace PHPAccounting\MyobAccountRightLive\Message\Payments\Requests\NewEssentials;


use PHPAccounting\MyobAccountRightLive\Message\AbstractRequest;
use PHPAccounting\MyobAccountRightLive\Message\Payments\Responses\NewEssentials\CreatePaymentResponse;

class CreatePaymentRequest extends AbstractRequest
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
     * @return CreatePaymentRequest
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
     * @return CreatePaymentRequest
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
     * @return CreatePaymentRequest
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
     * @return CreatePaymentRequest
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
     * @return CreatePaymentRequest
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
     * @return CreatePaymentRequest
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
     * @return CreatePaymentRequest
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
     * @return CreatePaymentRequest
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
     * @return CreatePaymentRequest
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
     * @return CreatePaymentRequest
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
     * @return CreatePaymentRequest
     */
    public function setDate($value){
        return $this->setParameter('date', $value);
    }

    public function getData()
    {
        $this->validate('account', 'contact', 'amount', 'date');

        $this->issetParam('Date', 'date');
        $this->issetParam('Memo', 'reference_id');
        $this->data['DepositTo'] = 'Account';
        if ($this->getInvoice() !== null && $this->getAmount()!== null) {
            $this->data['Invoices'] = [[
                "UID" => $this->getInvoice()['accounting_id'],
                "AmountApplied" => $this->getAmount(),
                "Type" => 'Invoice'
            ]];
        }

        if ($this->getAccount() !== null) {
            $this->data['Account'] = [
                'UID' => $this->getAccount()['accounting_id']
            ];
        }

        if ($this->getContact() !== null) {
            $this->data['Customer'] = [
                'UID' => $this->getContact()['accounting_id']
            ];
        }

        return $this->data;
    }

    public function getEndpoint()
    {

        $endpoint = 'Sale/CustomerPayment';
        return $endpoint;
    }

    public function getHttpMethod()
    {
        return 'POST';
    }

    protected function createResponse($data, $headers = [])
    {
        return $this->response = new CreatePaymentResponse($this, $data);
    }
}