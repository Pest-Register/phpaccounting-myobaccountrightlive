<?php


namespace PHPAccounting\MyobAccountRightLive\Message\Quotations\Requests\NewEssentials;


use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\BuildEndpointHelper;
use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\IndexSanityCheckHelper;
use PHPAccounting\MyobAccountRightLive\Message\AbstractRequest;
use PHPAccounting\MyobAccountRightLive\Message\Quotations\Responses\NewEssentials\UpdateQuotationResponse;

class UpdateQuotationRequest extends AbstractRequest
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
     * @return UpdateQuotationRequest
     */
    public function setAccountingID($value){
        return $this->setParameter('accounting_id', $value);
    }

    /**
     * Get Sync Token Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/v2/sale/quote/
     * @return mixed
     */
    public function getSyncToken(){
        return $this->getParameter('sync_token');
    }

    /**
     * Set Sync Token Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/v2/sale/quote/
     * @param string $value Deposit Amount
     * @return \PHPAccounting\MyobAccountRightLive\Message\Quotations\Requests\NewEssentials\UpdateQuotationRequest
     */
    public function setSyncToken($value){
        return $this->setParameter('sync_token', $value);
    }

    /**
     * Get Deposit Account Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/v2/sale/quote/
     * @return mixed
     */
    public function getDepositAccount(){
        return $this->getParameter('deposit_account');
    }

    /**
     * Set Deposit Account Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/v2/sale/quote/
     * @param string $value Deposit Account
     * @return UpdateQuotationRequest
     */
    public function setDepositAccount($value){
        return $this->setParameter('deposit_account', $value);
    }

    /**
     * Get Discount Amount Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/v2/sale/quote/
     * @return mixed
     */
    public function getDiscountAmount(){
        return $this->getParameter('discount_amount');
    }

    /**
     * Set Discount Amount Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/v2/sale/quote/
     * @param string $value Discount Amount
     * @return UpdateQuotationRequest
     */
    public function setDiscountAmount($value){
        return $this->setParameter('discount_amount', $value);
    }

    /**
     * Get Discount Rate Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/v2/sale/quote/
     * @return mixed
     */
    public function getDiscountRate(){
        return $this->getParameter('discount_rate');
    }

    /**
     * Set Discount Rate Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/v2/sale/quote/
     * @param string $value Discount Rate
     * @return UpdateQuotationRequest
     */
    public function setDiscountRate($value){
        return $this->setParameter('discount_rate', $value);
    }

    /**
     * Get GST Inclusive Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/v2/sale/quote/
     * @return mixed
     */
    public function getGSTInclusive(){
        return $this->getParameter('gst_inclusive');
    }

    /**
     * Set GST Inclusive Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/v2/sale/quote/
     * @param string $value GST Inclusive
     * @return UpdateQuotationRequest
     */
    public function setGSTInclusive($value){
        return $this->setParameter('gst_inclusive', $value);
    }

    /**
     * Get Total Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/v2/sale/quote/
     * @return mixed
     */
    public function getTotal(){
        return $this->getParameter('total');
    }

    /**
     * Set Total Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/v2/sale/quote/
     * @param string $value Total
     * @return UpdateQuotationRequest
     */
    public function setTotal($value){
        return $this->setParameter('total', $value);
    }

    /**
     * Get Type Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/v2/sale/quote/
     * @return mixed
     */
    public function getType(){
        return $this->getParameter('type');
    }

    /**
     * Set Type Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/v2/sale/quote/
     * @param string $value Invoice Type
     * @return UpdateQuotationRequest
     */
    public function setType($value){
        return $this->setParameter('type', $value);
    }

    /**
     * Get Quotation Data Parameter from Parameter Bag (LineItems generic interface)
     * @see https://developer.myob.com/api/accountright/v2/sale/quote/
     * @return mixed
     */
    public function getQuotationData(){
        return $this->getParameter('quotation_data');
    }

    /**
     * Set Quotation Data Parameter from Parameter Bag (LineItems)
     * @see https://developer.myob.com/api/accountright/v2/sale/quote/
     * @param array $value Quotation Item Lines
     * @return UpdateQuotationRequest
     */
    public function setQuotationData($value){
        return $this->setParameter('quotation_data', $value);
    }

    /**
     * Get Date Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/v2/sale/quote/
     * @return mixed
     */
    public function getDate(){
        return $this->getParameter('date');
    }

    /**
     * Set Date Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/v2/sale/quote/
     * @param string $value Invoice date
     * @return UpdateQuotationRequest
     */
    public function setDate($value){
        return $this->setParameter('date', $value);
    }

    /**
     * Get Status Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/v2/sale/quote/
     * @return mixed
     */
    public function getStatus(){
        return $this->getParameter('status');
    }

    /**
     * Set Status Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/v2/sale/quote/
     * @param string $value Invoice Due Date
     * @return UpdateQuotationRequest
     */
    public function setStatus($value){
        return $this->setParameter('status', $value);
    }

    /**
     * Get Tax Inclusive Amount Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/v2/sale/quote/
     * @return mixed
     */
    public function getTaxInclusiveAmount(){
        return $this->getParameter('tax_inclusive_amount');
    }

    /**
     * Set Tax Inclusive Amount Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/v2/sale/quote/
     * @param string $value Invoice Due Date
     * @return UpdateQuotationRequest
     */
    public function setTaxInclusiveAmount($value){
        return $this->setParameter('tax_inclusive_amount', $value);
    }

    /**
     * Get Expiry Date Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/v2/sale/quote/
     * @return mixed
     */
    public function getExpiryDate(){
        return $this->getParameter('expiry_date');
    }

    /**
     * Set Expiry Date Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/v2/sale/quote/
     * @param string $value Quote Expiry Date
     * @return UpdateQuotationRequest
     */
    public function setExpiryDate($value){
        return $this->setParameter('expiry_date', $value);
    }

    /**
     * Get Total Tax from Parameter Bag
     * @see https://developer.myob.com/api/accountright/v2/sale/quote/
     * @return mixed
     */
    public function getTotalTax(){
        return $this->getParameter('total_tax');
    }

    /**
     * Get Total Tax from Parameter Bag
     * @see https://developer.myob.com/api/accountright/v2/sale/quote/
     * @return mixed
     */
    public function setTotalTax($value){
        return $this->setParameter('total_tax', $value);
    }

    /**
     * Get Contact Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/v2/sale/quote/
     * @return mixed
     */
    public function getContact(){
        return $this->getParameter('contact');
    }

    /**
     * Set Contact Parameter from Parameter Bag
     * @see https://developer.myob.com/api/accountright/v2/sale/quote/
     * @param Contact $value Contact
     * @return UpdateQuotationRequest
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
     * @return UpdateQuotationRequest
     */
    public function setAddress($value) {
        return $this->setParameter('address', $value);
    }

    /**
     * Get Quotation Number from Parameter Bag
     * @see https://developer.myob.com/api/accountright/v2/sale/quote/
     * @return mixed
     */
    public function getQuotationNumber(){
        return $this->getParameter('quotation_number');
    }

    /**
     * Get Quotation Number from Parameter Bag
     * @see https://developer.myob.com/api/accountright/v2/sale/quote/
     * @return mixed
     */
    public function setQuotationNumber($value){
        return $this->setParameter('quotation_number', $value);
    }
    /**
     * Get GST Registered from Parameter Bag
     * @see https://developer.myob.com/api/accountright/v2/sale/quote/
     * @return mixed
     */
    public function getGSTRegistered() {
        return $this->getParameter('gst_registered');
    }

    /**
     * Set GST Registered from Parameter Bag
     * @see https://developer.myob.com/api/accountright/v2/sale/quote/
     * @return mixed
     */
    public function setGSTRegistered($value) {
        return $this->setParameter('gst_registered', $value);
    }

    /**
     * Get Tax Lines from Parameter Bag
     * @see https://developer.myob.com/api/accountright/v2/sale/quote/
     * @return mixed
     */
    public function getTaxLines() {
        return $this->getParameter('tax_lines');
    }

    /**
     * Set Tax Lines from Parameter Bag
     * @see https://developer.myob.com/api/accountright/v2/sale/quote/
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
                    return 'Open';
                case 'DELETED':
                    return 'Closed';
                case 'ACCEPTED':
                    return 'Accepted';
                case 'REJECTED':
                    return 'Declined';
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
                $newLine['ShipQuantity'] = IndexSanityCheckHelper::indexSanityCheck('quantity', $line);
                $newLine['UnitPrice'] = IndexSanityCheckHelper::indexSanityCheck('unit_amount', $line);
                $newLine['Total'] = IndexSanityCheckHelper::indexSanityCheck('amount', $line);
                $newLine['Account']['UID'] = IndexSanityCheckHelper::indexSanityCheck('account_id', $line);
                $newLine['DiscountPercent'] = IndexSanityCheckHelper::indexSanityCheck('discount_rate', $line);
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
        $this->validate('contact', 'quotation_data', 'gst_registered', 'gst_inclusive', 'accounting_id', 'sync_token');
        $this->issetParam('UID', 'accounting_id');
        $this->issetParam('Date', 'date');
        $this->issetParam('Number', 'quotation_number');
        $this->issetParam('Subtotal', 'subtotal');
        $this->issetParam('TotalAmount', 'total');
        $this->issetParam('TotalTax', 'total_tax');
        $this->issetParam('RowVersion', 'sync_token');

        if ($this->getStatus()) {
            $this->data['Status'] = $this->parseStatus($this->getStatus());
        }

        if ($this->getExpiryDate()) {
            if ($this->getDate()) {
                $currentDateMonth = $this->getDate()->month;
                $dueDateMonth = $this->getExpiryDate()->month;
                if ($dueDateMonth > $currentDateMonth) {
                    $this->data['Terms']['PaymentIsDue'] = 'DayOfMonthAfterEOM';
                } else {
                    $this->data['Terms']['PaymentIsDue'] = 'OnADayOfTheMonth';
                }
            }

            $this->data['Terms']['DueDate'] = $this->getExpiryDate();
            $this->data['Terms']['BalanceDueDate'] = $this->getExpiryDate()->day;
        }

        if ($this->getQuotationData() !== null && $this->getGSTRegistered() !== null) {
            $gst = $this->getGSTRegistered();
            $this->data = $this->parseLines($this->getQuotationData(),$gst, $this->data);
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
        $endpoint = 'Sale/Quote/Item?returnBody=true';
        if ($this->getAccountingID()) {
            if ($this->getAccountingID() !== "") {
                $endpoint = BuildEndpointHelper::createForGUID('Sale/Quote/Item', $this->getAccountingID());
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
        return $this->response = new UpdateQuotationResponse($this, $data);
    }
}