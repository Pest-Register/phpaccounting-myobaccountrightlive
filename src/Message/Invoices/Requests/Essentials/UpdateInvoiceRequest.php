<?php

namespace PHPAccounting\MyobAccountRightLive\Message\Invoices\Requests;

use PHPAccounting\MyobAccountRightLive\Helpers\Essentials\BuildEndpointHelper;
use PHPAccounting\MyobAccountRightLive\Helpers\Essentials\IndexSanityCheckHelper;
use PHPAccounting\MyobAccountRightLive\Helpers\Essentials\IndexSanityInsertionHelper;
use PHPAccounting\MyobAccountRightLive\Message\AbstractRequest;
use PHPAccounting\MyobAccountRightLive\Message\InventoryItems\Responses\Essentials\CreateInventoryItemResponse;
use PHPAccounting\MyobAccountRightLive\Message\Invoices\Responses\Essentials\CreateInvoiceResponse;

/**
 * Create Invoice
 * @package PHPAccounting\MyobEssentials\Message\Invoices\Requests\Essentials
 */
class UpdateInvoiceRequest extends AbstractRequest
{
    /**
     * Get GST Registered Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/sale/invoices
     * @return mixed
     */
    public function getGSTRegistered(){
        return $this->getParameter('gst_registered');
    }

    /**
     * Set GST Registered Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/sale/invoices
     * @param string $value Invoice Type
     * @return UpdateInvoiceRequest
     */
    public function setGSTRegistered($value){
        return $this->setParameter('gst_registered', $value);
    }
    /**
     * Get Invoice Reference Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/sale/invoices
     * @return mixed
     */
    public function getInvoiceReference(){
        return $this->getParameter('invoice_reference');
    }

    /**
     * Set Invoice Reference Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/sale/invoices
     * @param string $value Invoice Type
     * @return UpdateInvoiceRequest
     */
    public function setInvoiceReference($value){
        return $this->setParameter('invoice_reference', $value);
    }

    /**
     * Get Type Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/sale/invoices
     * @return mixed
     */
    public function getType(){
        return $this->getParameter('type');
    }

    /**
     * Set Type Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/sale/invoices
     * @param string $value Invoice Type
     * @return UpdateInvoiceRequest
     */
    public function setType($value){
        return $this->setParameter('type', $value);
    }


    /**
     * Get Status Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/sale/invoices
     * @return mixed
     */
    public function getStatus(){
        return $this->getParameter('status');
    }

    /**
     * Set Status Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/sale/invoices
     * @param string $value Invoice Type
     * @return UpdateInvoiceRequest
     */
    public function setStatus($value){
        return $this->setParameter('status', $value);
    }

    /**
     * Get Total Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/sale/invoices
     * @return mixed
     */
    public function getTotal(){
        return $this->getParameter('total');
    }

    /**
     * Set Total Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/sale/invoices
     * @param string $value Invoice Type
     * @return UpdateInvoiceRequest
     */
    public function setTotal($value){
        return $this->setParameter('total', $value);
    }


    /**
     * Get Invoice Data Parameter from Parameter Bag (LineItems generic interface)
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/sale/invoices
     * @return mixed
     */
    public function getInvoiceData(){
        return $this->getParameter('invoice_data');
    }

    /**
     * Set Invoice Data Parameter from Parameter Bag (LineItems)
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/sale/invoices
     * @param array $value Invoice Item Lines
     * @return UpdateInvoiceRequest
     */
    public function setInvoiceData($value){
        return $this->setParameter('invoice_data', $value);
    }

    /**
     * Get Date Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/sale/invoices
     * @return mixed
     */
    public function getDate(){
        return $this->getParameter('date');
    }

    /**
     * Set Date Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/sale/invoices
     * @param string $value Invoice date
     * @return UpdateInvoiceRequest
     */
    public function setDate($value){
        return $this->setParameter('date', $value);
    }

    /**
     * Get Due Date Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/sale/invoices
     * @return mixed
     */
    public function getDueDate(){
        return $this->getParameter('due_date');
    }

    /**
     * Set Due Date Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/sale/invoices
     * @param string $value Invoice Due Date
     * @return UpdateInvoiceRequest
     */
    public function setDueDate($value){
        return $this->setParameter('due_date', $value);
    }

    /**
     * Get Contact Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/sale/invoices
     * @return mixed
     */
    public function getContact(){
        return $this->getParameter('contact');
    }

    /**
     * Set Contact Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/sale/invoices
     * @return UpdateInvoiceRequest
     */
    public function setContact($value){
        return $this->setParameter('contact', $value);
    }

    /**
     * Get GST Inclusive Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/sale/invoices
     * @return mixed
     */
    public function getGSTInclusive(){
        return $this->getParameter('gst_inclusive');
    }

    /**
     * Set GST Inclusive Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/sale/invoices
     * @return UpdateInvoiceRequest
     */
    public function setGSTInclusive($value){
        return $this->setParameter('gst_inclusive', $value);
    }

    /**
     * Get Accounting ID Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/sale/invoices
     * @return mixed
     */
    public function getAccountingID(){
        return $this->getParameter('accounting_id');
    }

    /**
     * Set Accounting ID Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/sale/invoices
     * @return UpdateInvoiceRequest
     */
    public function setAccountingID($value){
        return $this->setParameter('accounting_id', $value);
    }

    private function parseLines($lines, $gst, $data) {
        $data['lines'] = [];
        if ($lines) {
            foreach($lines as $line) {
                $newLine = [];
                $newLine['account'] = [];
                $newLine['item'] = [];
                $newLine['taxType'] = [];
                if ($gst) {
                    $newLine['taxType']['uid'] = IndexSanityCheckHelper::indexSanityCheck('tax_id', $line);
                }
                else {
                    $newLine['taxType']['uid'] = '';
                }

                $newLine['unitOfMeasure'] = IndexSanityCheckHelper::indexSanityCheck('unit', $line);
                $newLine['description'] = IndexSanityCheckHelper::indexSanityCheck('description', $line);
                $newLine['quantity'] = IndexSanityCheckHelper::indexSanityCheck('quantity', $line);
                $newLine['unitPrice'] = IndexSanityCheckHelper::indexSanityCheck('unit_amount', $line);
                $newLine['account']['uid'] = IndexSanityCheckHelper::indexSanityCheck('account_id', $line);
                $newLine['item']['uid'] = IndexSanityCheckHelper::indexSanityCheck('item_id', $line);
                array_push($data['lines'], $newLine);
            }
        }
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
        $this->validate('contact', 'invoice_data', 'gst_registered', 'gst_inclusive');
        $this->issetParam('uid', 'accounting_id');
        $this->issetParam('issueDate', 'date');
        $this->issetParam('dueDate', 'due_date');
        $this->issetParam('invoiceNumber', 'invoice_reference');
        $this->issetParam('status', 'status');
        $this->issetParam('total', 'total');
        if ($this->getInvoiceData() !== null && $this->getGSTRegistered() !== null) {
            $gst = $this->getGSTRegistered();
            $this->data = $this->parseLines($this->getInvoiceData(),$gst, $this->data);
        }
        if ($this->getContact() !== null) {
            $this->data['contact'] = [];
            $this->data['contact']['uid'] = $this->getContact();
        }

        if ($this->getGSTInclusive()) {
            if ($this->getGSTInclusive() === 'INCLUSIVE') {
                $this->data['gstInclusive'] = true;
            } else if ($this->getGSTInclusive() === 'EXCLUSIVE') {
                $this->data['gstInclusive'] = false;
            } else {
                $this->data['gstInclusive'] = true;
            }
        }

        return $this->data;
    }

    public function getEndpoint()
    {

        $endpoint = 'sale/invoices';
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
        return $this->response = new CreateInvoiceResponse($this, $data);
    }
}