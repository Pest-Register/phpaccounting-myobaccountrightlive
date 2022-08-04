<?php

namespace PHPAccounting\MyobAccountRightLive\Message\Invoices\Responses\NewEssentials;

use Cassandra\Index;
use Omnipay\Common\Message\AbstractResponse;
use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\ErrorResponseHelper;
use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\IndexSanityCheckHelper;

/**
 * Get Invoice(s) Response
 * @package PHPAccounting\MyobAccountRightLive\Message\Invoices\Responses\NewEssentials
 */
class GetInvoiceResponse extends AbstractResponse
{
    /**
     * Check Response for Error or Success
     * @return boolean
     */
    public function isSuccessful()
    {
        if ($this->data) {
            if(array_key_exists('Errors', $this->data)){
                return !$this->data['Errors'][0]['Severity'] == 'Error';
            }
            if (array_key_exists('Items', $this->data)) {
                if (count($this->data['Items']) === 0) {
                    return false;
                }
            }
        } else {
            return false;
        }

        return true;
    }

    /**
     * Fetch Error Message from Response
     * @return array
     */
    public function getErrorMessage()
    {
        if ($this->data) {
            if (array_key_exists('Errors', $this->data)) {
                $additionalDetails = '';
                $message = '';
                $errorCode = '';
                $status ='';
                if (array_key_exists('AdditionalDetails', $this->data['Errors'][0])) {
                    $additionalDetails = $this->data['Errors'][0]['AdditionalDetails'];
                }
                if (array_key_exists('ErrorCode', $this->data['Errors'][0])) {
                    $errorCode = $this->data['Errors'][0]['ErrorCode'];
                }
                if (array_key_exists('Severity', $this->data['Errors'][0])) {
                    $status = $this->data['Errors'][0]['Severity'];
                }
                if (array_key_exists('Message', $this->data['Errors'][0])) {
                    $message = $this->data['Errors'][0]['Message'];
                }
                $response = $message.' '.$additionalDetails;
                return ErrorResponseHelper::parseErrorResponse(
                    $response,
                    $status,
                    $errorCode,
                    null,
                    $additionalDetails,
                    'Invoice'
                );
            } else {
                if (array_key_exists('Items', $this->data)) {
                    if (count($this->data['Items']) == 0) {
                        return [
                            'message' => 'NULL Returned from API or End of Pagination',
                            'exception' =>'NULL Returned from API or End of Pagination',
                            'error_code' => null,
                            'status_code' => null,
                            'detail' => null
                        ];
                    }
                }
            }
        }

        return null;
    }

    /**
     * @param $data
     * @return string
     */
    private function parseTaxCalculation($data)  {
        if ($data === null) {
            return 'NONE';
        }
        if ($data) {
            return 'INCLUSIVE';
        } else {
            return 'EXCLUSIVE';
        }
    }

    /**
     * Parse status
     * @param $data
     * @return string|null
     */
    private function parseStatus($data) {
        if ($data) {
            switch($data) {
                case 'Open':
                    return 'OPEN';
                case 'Closed':
                case 'Credit':
                    return 'PAID';
            }
        }
        return null;
    }

    /**
     * Add Contact to Invoice
     * @param $data Array of single Customer
     * @param array $invoice MYOB Invoice Object Mapping
     * @return mixed
     */
    private function parseCustomer($invoice, $data) {
        if ($data) {
            $newContact = [];
            $newContact['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $data);
            $newContact['name'] = IndexSanityCheckHelper::indexSanityCheck('Name', $data);
            $invoice['contact'] = $newContact;
        }

        return $invoice;
    }

    /**
     * Add LineItems to Invoice
     * @param $data Array of LineItems
     * @param array $invoice MYOB Invoice Object Mapping
     * @return mixed
     */
    private function parseLineItems($invoice, $data) {
        if ($data) {
            $lineItems = [];
            foreach($data as $lineItem) {
                $newLineItem = [];
                $newLineItem['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('RowID', $lineItem);
                $newLineItem['type'] = IndexSanityCheckHelper::indexSanityCheck('Type', $lineItem);
                $newLineItem['description'] = IndexSanityCheckHelper::indexSanityCheck('Description', $lineItem);
                $newLineItem['unit_amount'] = IndexSanityCheckHelper::indexSanityCheck('UnitPrice', $lineItem);
                $newLineItem['line_amount'] = IndexSanityCheckHelper::indexSanityCheck('Total', $lineItem);
                $newLineItem['discount_rate'] = IndexSanityCheckHelper::indexSanityCheck('DiscountPercent', $lineItem);;
                $newLineItem['amount'] = IndexSanityCheckHelper::indexSanityCheck('Total', $lineItem);
                $newLineItem['sync_token'] = IndexSanityCheckHelper::indexSanityCheck('RowVersion', $lineItem);

                if (array_key_exists('Account', $lineItem)) {
                    if ($lineItem['Account']) {
                        $newLineItem['account_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $lineItem['Account']);
                        $newLineItem['code'] = IndexSanityCheckHelper::indexSanityCheck('Number', $lineItem['Account']);
                    }
                }
                if (array_key_exists('TaxCode', $lineItem)) {
                    if ($lineItem['TaxCode']) {
                        $newLineItem['tax_type'] = IndexSanityCheckHelper::indexSanityCheck('Code', $lineItem['TaxCode']);
                        $newLineItem['tax_type_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $lineItem['TaxCode']);
                    }
                }
                if (array_key_exists('Item', $lineItem)) {
                    if ($lineItem['Item']) {
                        $newLineItem['item_code'] = IndexSanityCheckHelper::indexSanityCheck('Number', $lineItem['Item']);
                        $newLineItem['item_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $lineItem['Item']);
                        $newLineItem['quantity'] = IndexSanityCheckHelper::indexSanityCheck('ShipQuantity', $lineItem);
                    } else {
                        $newLineItem['quantity'] = IndexSanityCheckHelper::indexSanityCheck('UnitCount', $lineItem);
                    }
                }

                array_push($lineItems, $newLineItem);
            }

            $invoice['invoice_data'] = $lineItems;
        }

        return $invoice;
    }



    /**
     * Return all Invoices with Generic Schema Variable Assignment
     * @return array
     */
    public function getInvoices(){
        $invoices = [];
        if (!array_key_exists('Items', $this->data)) {
            $invoice = $this->data;
            $newInvoice = [];
            $newInvoice['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $invoice);
            $newInvoice['status'] = $this->parseStatus(IndexSanityCheckHelper::indexSanityCheck('Status', $invoice));
            $newInvoice['sub_total'] = IndexSanityCheckHelper::indexSanityCheck('Subtotal', $invoice);
            $newInvoice['total_tax'] = IndexSanityCheckHelper::indexSanityCheck('TotalTax', $invoice);
            $newInvoice['total'] = IndexSanityCheckHelper::indexSanityCheck('TotalAmount', $invoice);
            $newInvoice['type'] = IndexSanityCheckHelper::indexSanityCheck('InvoiceType', $invoice);
            $newInvoice['invoice_number'] = IndexSanityCheckHelper::indexSanityCheck('Number', $invoice);
            $newInvoice['amount_due'] = IndexSanityCheckHelper::indexSanityCheck('BalanceDueAmount', $invoice);
            $newInvoice['date'] = IndexSanityCheckHelper::indexSanityCheck('Date', $invoice);
            $newInvoice['gst_inclusive'] = $this->parseTaxCalculation(IndexSanityCheckHelper::indexSanityCheck('IsTaxInclusive', $invoice));
            $newInvoice['sync_token'] = IndexSanityCheckHelper::indexSanityCheck('RowVersion', $invoice);
            $newInvoice['updated_at'] = IndexSanityCheckHelper::indexSanityCheck('LastModified', $invoice);
            $newInvoice['fetch_payments_separately'] = true;
            $newInvoice['payments'] = [];
            if (array_key_exists('Customer', $invoice)) {
                if ($invoice['Customer']) {
                    $newInvoice = $this->parseCustomer($newInvoice, $invoice['Customer']);
                }
            }

            if (array_key_exists('Lines', $invoice)) {
                if ($invoice['Lines']) {
                    $newInvoice = $this->parseLineItems($newInvoice, $invoice['Lines']);
                }
            }

            if (array_key_exists('TotalAmount', $invoice) && array_key_exists('BalanceDueAmount', $invoice)) {
                if ($invoice['TotalAmount'] && $invoice['BalanceDueAmount']) {
                    $amountPaid = floatval($invoice['TotalAmount']) - floatval($invoice['BalanceDueAmount']);
                    if ($amountPaid) {
                        $newInvoice['amount_paid'] = $amountPaid;
                    } else {
                        $newInvoice['amount_paid'] = 0.00;
                    }

                }
            }

            if (array_key_exists('Terms', $invoice)) {
                if ($invoice['Terms']) {
                    $newInvoice['due_date'] = IndexSanityCheckHelper::indexSanityCheck('DueDate', $invoice['Terms']);
                }
            }

            if ($newInvoice['amount_due'] == 0) {
                $newInvoice['status'] = 'PAID';
            } else if ($newInvoice['amount_due'] > 0 && $newInvoice['amount_due'] != $newInvoice['total']) {
                $newInvoice['status'] = 'PARTIAL';
            }

            array_push($invoices, $newInvoice);
        } else {
            foreach ($this->data['Items'] as $invoice) {
                $newInvoice = [];
                $newInvoice['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $invoice);
                $newInvoice['status'] = $this->parseStatus(IndexSanityCheckHelper::indexSanityCheck('Status', $invoice));
                $newInvoice['sub_total'] = IndexSanityCheckHelper::indexSanityCheck('Subtotal', $invoice);
                $newInvoice['total_tax'] = IndexSanityCheckHelper::indexSanityCheck('TotalTax', $invoice);
                $newInvoice['total'] = IndexSanityCheckHelper::indexSanityCheck('TotalAmount', $invoice);
                $newInvoice['type'] = IndexSanityCheckHelper::indexSanityCheck('InvoiceType', $invoice);
                $newInvoice['invoice_number'] = IndexSanityCheckHelper::indexSanityCheck('Number', $invoice);
                $newInvoice['amount_due'] = IndexSanityCheckHelper::indexSanityCheck('BalanceDueAmount', $invoice);
                $newInvoice['date'] = IndexSanityCheckHelper::indexSanityCheck('Date', $invoice);
                $newInvoice['gst_inclusive'] = $this->parseTaxCalculation(IndexSanityCheckHelper::indexSanityCheck('IsTaxInclusive', $invoice));
                $newInvoice['sync_token'] = IndexSanityCheckHelper::indexSanityCheck('RowVersion', $invoice);
                $newInvoice['updated_at'] = IndexSanityCheckHelper::indexSanityCheck('LastModified', $invoice);
                $newInvoice['fetch_payments_separately'] = true;
                $newInvoice['payments'] = [];
                if (array_key_exists('Customer', $invoice)) {
                    if ($invoice['Customer']) {
                        $newInvoice = $this->parseCustomer($newInvoice, $invoice['Customer']);
                    }
                }

                if (array_key_exists('Lines', $invoice)) {
                    if ($invoice['Lines']) {
                        $newInvoice = $this->parseLineItems($newInvoice, $invoice['Lines']);
                    }
                }

                if (array_key_exists('TotalAmount', $invoice) && array_key_exists('BalanceDueAmount', $invoice)) {
                    if ($invoice['TotalAmount'] && $invoice['BalanceDueAmount']) {
                        $amountPaid = floatval($invoice['TotalAmount']) - floatval($invoice['BalanceDueAmount']);
                        if ($amountPaid) {
                            $newInvoice['amount_paid'] = $amountPaid;
                        } else {
                            $newInvoice['amount_paid'] = 0.00;
                        }

                    }
                }

                if (array_key_exists('Terms', $invoice)) {
                    if ($invoice['Terms']) {
                        $newInvoice['due_date'] = IndexSanityCheckHelper::indexSanityCheck('DueDate', $invoice['Terms']);
                    }
                }
                if ($newInvoice['amount_due'] == 0) {
                    $newInvoice['status'] = 'PAID';
                } else if ($newInvoice['amount_due'] > 0 && $newInvoice['amount_due'] != $newInvoice['total']) {
                    $newInvoice['status'] = 'PARTIAL';
                }
                array_push($invoices, $newInvoice);
            }
        }


        return $invoices;
    }
}