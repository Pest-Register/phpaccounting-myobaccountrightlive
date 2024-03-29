<?php

namespace PHPAccounting\MyobAccountRightLive\Message\Invoices\Requests\Traits;

use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\IndexSanityCheckHelper;

trait InvoiceRequestTrait
{
    /**
     * Get Sync Token Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/invoice/invoice_item/
     * @return mixed
     */
    public function getSyncToken(){
        return $this->getParameter('sync_token');
    }

    /**
     * Set Sync Token Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/invoice/invoice_item/
     * @param string $value Deposit Amount
     * @return \PHPAccounting\MyobAccountRightLive\Message\Invoices\Requests\CreateInvoiceRequest
     */
    public function setSyncToken($value){
        return $this->setParameter('sync_token', $value);
    }

    /**
     * Get Deposit Amount Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/invoice/invoice_item/
     * @return mixed
     */
    public function getDepositAmount(){
        return $this->getParameter('deposit_amount');
    }

    /**
     * Set Deposit Amount Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/invoice/invoice_item/
     * @param string $value Deposit Amount
     */
    public function setDepositAmount($value){
        return $this->setParameter('deposit_amount', $value);
    }

    /**
     * Get Deposit Account Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/invoice/invoice_item/
     * @return mixed
     */
    public function getDepositAccount(){
        return $this->getParameter('deposit_account');
    }

    /**
     * Set Deposit Account Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/invoice/invoice_item/
     * @param string $value Deposit Account
     */
    public function setDepositAccount($value){
        return $this->setParameter('deposit_account', $value);
    }

    /**
     * Get Discount Amount Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/invoice/invoice_item/
     * @return mixed
     */
    public function getDiscountAmount(){
        return $this->getParameter('discount_amount');
    }

    /**
     * Set Discount Amount Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/invoice/invoice_item/
     * @param string $value Discount Amount
     */
    public function setDiscountAmount($value){
        return $this->setParameter('discount_amount', $value);
    }

    /**
     * Get Discount Rate Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/invoice/invoice_item/
     * @return mixed
     */
    public function getDiscountRate(){
        return $this->getParameter('discount_rate');
    }

    /**
     * Set Discount Rate Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/invoice/invoice_item/
     * @param string $value Discount Rate
     */
    public function setDiscountRate($value){
        return $this->setParameter('discount_rate', $value);
    }

    /**
     * Get GST Inclusive Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/invoice/invoice_item/
     * @return mixed
     */
    public function getGSTInclusive(){
        return $this->getParameter('gst_inclusive');
    }

    /**
     * Set GST Inclusive Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/invoice/invoice_item/
     * @param string $value GST Inclusive
     */
    public function setGSTInclusive($value){
        return $this->setParameter('gst_inclusive', $value);
    }

    /**
     * Get Total Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/invoice/invoice_item/
     * @return mixed
     */
    public function getTotal(){
        return $this->getParameter('total');
    }

    /**
     * Set Total Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/invoice/invoice_item/
     * @param string $value Total
     */
    public function setTotal($value){
        return $this->setParameter('total', $value);
    }

    /**
     * Get Type Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/invoice/invoice_item/
     * @return mixed
     */
    public function getType(){
        return $this->getParameter('type');
    }

    /**
     * Set Type Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/invoice/invoice_item/
     * @param string $value Invoice Type
     */
    public function setType($value){
        return $this->setParameter('type', $value);
    }

    /**
     * Get Invoice Data Parameter from Parameter Bag (LineItems generic interface)
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/invoice/invoice_item/
     * @return mixed
     */
    public function getInvoiceData(){
        return $this->getParameter('invoice_data');
    }

    /**
     * Set Invoice Data Parameter from Parameter Bag (LineItems)
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/invoice/invoice_item/
     * @param array $value Invoice Item Lines
     */
    public function setInvoiceData($value){
        return $this->setParameter('invoice_data', $value);
    }

    /**
     * Get Date Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/invoice/invoice_item/
     * @return mixed
     */
    public function getDate(){
        return $this->getParameter('date');
    }

    /**
     * Set Date Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/invoice/invoice_item/
     * @param string $value Invoice date
     */
    public function setDate($value){
        return $this->setParameter('date', $value);
    }

    /**
     * Get Status Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/invoice/invoice_item/
     * @return mixed
     */
    public function getStatus(){
        return $this->getParameter('status');
    }

    /**
     * Set Status Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/invoice/invoice_item/
     * @param string $value Invoice Due Date
     */
    public function setStatus($value){
        return $this->setParameter('status', $value);
    }

    /**
     * Get Tax Inclusive Amount Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/invoice/invoice_item/
     * @return mixed
     */
    public function getTaxInclusiveAmount(){
        return $this->getParameter('tax_inclusive_amount');
    }

    /**
     * Set Tax Inclusive Amount Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/invoice/invoice_item/
     * @param string $value Invoice Due Date
     */
    public function setTaxInclusiveAmount($value){
        return $this->setParameter('tax_inclusive_amount', $value);
    }

    /**
     * Get Due Date Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/invoice/invoice_item/
     * @return mixed
     */
    public function getDueDate(){
        return $this->getParameter('due_date');
    }

    /**
     * Set Due Date Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/invoice/invoice_item/
     * @param string $value Invoice Due Date
     */
    public function setDueDate($value){
        return $this->setParameter('due_date', $value);
    }

    /**
     * Get Total Tax from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/invoice/invoice_item/
     * @return mixed
     */
    public function getTotalTax(){
        return $this->getParameter('total_tax');
    }

    /**
     * Get Total Tax from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/invoice/invoice_item/
     * @return mixed
     */
    public function setTotalTax($value){
        return $this->setParameter('total_tax', $value);
    }

    /**
     * Get Contact Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/invoice/invoice_item/
     * @return mixed
     */
    public function getContact(){
        return $this->getParameter('contact');
    }

    /**
     * Set Contact Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/invoice/invoice_item/
     * @param Contact $value Contact
     */
    public function setContact($value){
        return $this->setParameter('contact', $value);
    }

    /**
     * @return mixed
     */
    public function getAddress() {
        return $this->getParameter('address');
    }

    /**
     * @param $value
     */
    public function setAddress($value) {
        return $this->setParameter('address', $value);
    }

    /**
     * Get Invoice Number from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/invoice/invoice_item/
     * @return mixed
     */
    public function getInvoiceNumber(){
        return $this->getParameter('invoice_number');
    }

    /**
     * Get Invoice Number from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/invoice/invoice_item/
     * @return mixed
     */
    public function setInvoiceNumber($value){
        return $this->setParameter('invoice_number', $value);
    }

    /**
     * Get Invoice Reference from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/invoice/invoice_item/
     * @return mixed
     */
    public function getInvoiceReference(){
        return $this->getParameter('invoice_reference');
    }

    /**
     * Set Invoice Reference from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/invoice/invoice_item/
     * @return mixed
     */
    public function setInvoiceReference($value){
        return $this->setParameter('invoice_reference', $value);
    }

    /**
     * Get GST Registered from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/invoice/invoice_item/
     * @return mixed
     */
    public function getGSTRegistered() {
        return $this->getParameter('gst_registered');
    }

    /**
     * Set GST Registered from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/invoice/invoice_item/
     * @return mixed
     */
    public function setGSTRegistered($value) {
        return $this->setParameter('gst_registered', $value);
    }

    /**
     * Get Tax Lines from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/invoice/invoice_item/
     * @return mixed
     */
    public function getTaxLines() {
        return $this->getParameter('tax_lines');
    }

    /**
     * Set Tax Lines from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/invoice/invoice_item/
     * @return mixed
     */
    public function setTaxLines($value) {
        return $this->setParameter('tax_lines', $value);
    }

    /**
     * Parse status
     * @param $data
     * @return string|null
     */
    private function parseStatus($data) {
        if ($data) {
            switch($data) {
                case 'DRAFT':
                case 'SENT':
                case 'OPEN':
                case 'PARTIAL':
                    return 'Open';
                case 'PAID':
                case 'DELETED':
                    return 'Closed';
            }
        }
        return null;
    }

    private function parseLines($lines, $gst, $data) {
        $data['Lines'] = [];
        if ($lines) {
            foreach($lines as $line) {
                $newLine = [];
                $newLine['Account'] = [];

                $newLine['TaxCode'] = [];
                $newLine['TaxCode']['UID'] = IndexSanityCheckHelper::indexSanityCheck('tax_id', $line);

                if (array_key_exists('item_id', $line)) {
                    $newLine['Item'] = [];
                    $newLine['Item']['UID'] = IndexSanityCheckHelper::indexSanityCheck('item_id', $line);
                }

                $newLine['UnitOfMeasure'] = IndexSanityCheckHelper::indexSanityCheck('unit', $line);
                $newLine['Description'] = IndexSanityCheckHelper::indexSanityCheck('description', $line);
                $newLine['UnitCount'] = IndexSanityCheckHelper::indexSanityCheck('quantity', $line);
                $newLine['ShipQuantity'] = IndexSanityCheckHelper::indexSanityCheck('quantity', $line);

                $newLine['UnitPrice'] = IndexSanityCheckHelper::indexSanityCheck('unit_amount', $line);
                $newLine['Total'] = IndexSanityCheckHelper::indexSanityCheck('amount', $line);
                if (IndexSanityCheckHelper::indexSanityCheck('account_id', $line)) {
                    $newLine['Account']['UID'] = $line['account_id'];
                }

                $newLine['DiscountPercent'] = IndexSanityCheckHelper::indexSanityCheck('discount_rate', $line);
                array_push($data['Lines'], $newLine);
            }
        }
        return $data;
    }
}