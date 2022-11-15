<?php


namespace PHPAccounting\MyobAccountRightLive\Message\Quotations\Requests;


use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\IndexSanityCheckHelper;
use PHPAccounting\MyobAccountRightLive\Message\AbstractMYOBRequest;
use PHPAccounting\MyobAccountRightLive\Message\Quotations\Requests\Traits\QuotationRequestTrait;
use PHPAccounting\MyobAccountRightLive\Message\Quotations\Responses\CreateQuotationResponse;

class CreateQuotationRequest extends AbstractMYOBRequest
{
    use QuotationRequestTrait;

    public string $model = 'Quotation';


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