<?php


namespace PHPAccounting\MyobAccountRightLive\Message\Quotations\Requests;


use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\IndexSanityCheckHelper;
use PHPAccounting\MyobAccountRightLive\Message\AbstractMYOBRequest;
use PHPAccounting\MyobAccountRightLive\Message\Quotations\Responses\CreateQuotationResponse;

class CreateQuotationRequest extends AbstractMYOBRequest
{
    public string $model = 'Quotation';

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
     * @return \PHPAccounting\MyobAccountRightLive\Message\Quotations\Requests\CreateQuotationRequest
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
     * @return CreateQuotationRequest
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
     * @return CreateQuotationRequest
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
     * @return CreateQuotationRequest
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
     * @return CreateQuotationRequest
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
     * @return CreateQuotationRequest
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
     * @return CreateQuotationRequest
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
     * @return CreateQuotationRequest
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
     * @return CreateQuotationRequest
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
     * @return CreateQuotationRequest
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
     * @return CreateQuotationRequest
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
     * @return CreateQuotationRequest
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
     * @return CreateQuotationRequest
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
     * @return CreateQuotationRequest
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
                $newLine['Account']['UID'] = IndexSanityCheckHelper::indexSanityCheck('account_id', $line);
                $newLine['DiscountPercent'] = IndexSanityCheckHelper::indexSanityCheck('discount_rate', $line);
                array_push($data['Lines'], $newLine);
            }
        }
        return $data;
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

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('contact', 'quotation_data', 'gst_registered', 'gst_inclusive');

        $this->issetParam('Date', 'date');
        $this->issetParam('Number', 'quotation_number');
        $this->issetParam('Subtotal', 'subtotal');
        $this->issetParam('TotalAmount', 'total');
        $this->issetParam('TotalTax', 'total_tax');

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
        return $endpoint;
    }

    public function getHttpMethod()
    {
        return 'POST';
    }

    protected function createResponse($data, $headers = [])
    {
        return $this->response = new CreateQuotationResponse($this, $data);
    }
}