<?php


namespace PHPAccounting\MyobAccountRightLive\Message\Invoices\Requests\NewEssentials;


use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\BuildEndpointHelper;
use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\IndexSanityCheckHelper;
use PHPAccounting\MyobAccountRightLive\Message\AbstractRequest;
use PHPAccounting\MyobAccountRightLive\Message\Invoices\Responses\NewEssentials\UpdateInvoiceResponse;

class UpdateInvoiceRequest extends AbstractRequest
{
    /**
     * Get Accounting ID Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/invoice/invoice_item/
     * @return mixed
     */
    public function getAccountingID(){
        return $this->getParameter('accounting_id');
    }

    /**
     * Set Accounting ID Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/essentials-new-v2/sale/invoice/invoice_item/
     * @param string $value Deposit Amount
     * @return \PHPAccounting\MyobAccountRightLive\Message\Invoices\Requests\NewEssentials\UpdateInvoiceRequest
     */
    public function setAccountingID($value){
        return $this->setParameter('accounting_id', $value);
    }

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
     * @return UpdateInvoiceRequest
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
     * @return UpdateInvoiceRequest
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
     * @return UpdateInvoiceRequest
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
     * @return UpdateInvoiceRequest
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
     * @return UpdateInvoiceRequest
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
     * @return UpdateInvoiceRequest
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
     * @return UpdateInvoiceRequest
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
     * @return UpdateInvoiceRequest
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
     * @return UpdateInvoiceRequest
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
     * @return UpdateInvoiceRequest
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
     * @return UpdateInvoiceRequest
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
     * @return UpdateInvoiceRequest
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
     * @return UpdateInvoiceRequest
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
     * @return UpdateInvoiceRequest
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
     * @return UpdateInvoiceRequest
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

    private function parseLines($lines, $gst, $data) {
        $data['Lines'] = [];
        if ($lines) {
            foreach($lines as $line) {
                $newLine = [];
                $newLine['Account'] = [];
                if ($gst) {
                    $newLine['TaxCode'] = [];
                    $newLine['TaxCode']['UID'] = IndexSanityCheckHelper::indexSanityCheck('tax_id', $line);
                }
                if (array_key_exists('item_id', $line)) {
                    $newLine['Item'] = [];
                    $newLine['Item']['UID'] = IndexSanityCheckHelper::indexSanityCheck('item_id', $line);
                }

                $newLine['UnitOfMeasure'] = IndexSanityCheckHelper::indexSanityCheck('unit', $line);
                $newLine['Description'] = IndexSanityCheckHelper::indexSanityCheck('description', $line);
                $newLine['UnitCount'] = IndexSanityCheckHelper::indexSanityCheck('quantity', $line);
                $newLine['UnitPrice'] = IndexSanityCheckHelper::indexSanityCheck('unit_amount', $line);
                $newLine['Account']['UID'] = IndexSanityCheckHelper::indexSanityCheck('account_id', $line);

                array_push($data['Lines'], $newLine);
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
        $this->validate('contact', 'invoice_data', 'gst_registered', 'gst_inclusive', 'accounting_id', 'sync_token');
        $this->issetParam('UID', 'accounting_id');
        $this->issetParam('Date', 'date');
        $this->issetParam('Number', 'invoice_reference');
        $this->issetParam('Status', 'status');
        $this->issetParam('Subtotal', 'subtotal');
        $this->issetParam('TotalAmount', 'total');
        $this->issetParam('TotalTax', 'total_tax');
        $this->issetParam('RowVersion', 'sync_token');


        if ($this->getDueDate()) {
            $this->data['Terms']['DueDate'] = $this->getDueDate();
        }

        if ($this->getInvoiceData() !== null && $this->getGSTRegistered() !== null) {
            $gst = $this->getGSTRegistered();
            $this->data = $this->parseLines($this->getInvoiceData(),$gst, $this->data);
        }
        if ($this->getContact() !== null) {
            $this->data['Customer'] = [];
            $this->data['Customer']['UID'] = $this->getContact();
        }

        if ($this->getGSTInclusive()) {
            if ($this->getGSTInclusive() === 'INCLUSIVE') {
                $this->data['IsTaxInclusive'] = true;
            } else if ($this->getGSTInclusive() === 'EXCLUSIVE') {
                $this->data['IsTaxInclusive'] = false;
            } else {
                $this->data['IsTaxInclusive'] = true;
            }
        }

        return $this->data;
    }

    public function getEndpoint()
    {

        $endpoint = 'Sale/Invoice/Item?returnBody=true';
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
        return $this->response = new UpdateInvoiceResponse($this, $data);
    }
}