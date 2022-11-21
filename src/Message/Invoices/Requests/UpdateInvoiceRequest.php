<?php


namespace PHPAccounting\MyobAccountRightLive\Message\Invoices\Requests;

use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\BuildEndpointHelper;
use PHPAccounting\MyobAccountRightLive\Message\AbstractMYOBRequest;
use PHPAccounting\MyobAccountRightLive\Message\Invoices\Requests\Traits\InvoiceRequestTrait;
use PHPAccounting\MyobAccountRightLive\Message\Invoices\Responses\UpdateInvoiceResponse;
use PHPAccounting\MyobAccountRightLive\Traits\AccountingIDRequestTrait;

class UpdateInvoiceRequest extends AbstractMYOBRequest
{
    use AccountingIDRequestTrait, InvoiceRequestTrait;

    public string $model = 'Invoice';

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
        $this->issetParam('Number', 'invoice_number');
        $this->issetParam('Subtotal', 'subtotal');
        $this->issetParam('TotalAmount', 'total');
        $this->issetParam('TotalTax', 'total_tax');
        $this->issetParam('RowVersion', 'sync_token');

        if ($this->getStatus()) {
            $this->data['Status'] = $this->parseStatus($this->getStatus());
        }

        if ($this->getDueDate()) {
            if ($this->getDate()) {
                $currentDateMonth = $this->getDate()->month;
                $dueDateMonth = $this->getDueDate()->month;
                if ($dueDateMonth > $currentDateMonth) {
                    $this->data['Terms']['PaymentIsDue'] = 'DayOfMonthAfterEOM';
                } else {
                    $this->data['Terms']['PaymentIsDue'] = 'OnADayOfTheMonth';
                }
            }

            $this->data['Terms']['DueDate'] = $this->getDueDate();
            $this->data['Terms']['BalanceDueDate'] = $this->getDueDate()->day;
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
                $endpoint = BuildEndpointHelper::createForGUID('Sale/Invoice/Item', $this->getAccountingID());
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