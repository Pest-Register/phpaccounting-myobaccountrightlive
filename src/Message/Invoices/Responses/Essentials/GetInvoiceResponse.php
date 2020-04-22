<?php

namespace PHPAccounting\MyobAccountRightLive\Message\Invoices\Responses\Essentials;

use Omnipay\Common\Message\AbstractResponse;
use PHPAccounting\MyobAccountRightLive\Helpers\Essentials\ErrorResponseHelper;
use PHPAccounting\MyobAccountRightLive\Helpers\Essentials\IndexSanityCheckHelper;

/**
 * Get Invoice(s) Response
 * @package PHPAccounting\MyobEssentials\Message\Invoices\Responses\Essentials
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
            if(array_key_exists('errors', $this->data)){
                return false;
            }
        } else {
            return false;
        }

        return true;
    }

    /**
     * Fetch Error Message from Response
     * @return string
     */
    public function getErrorMessage()
    {
        if ($this->data) {
            if (array_key_exists('errors', $this->data)) {
                return ErrorResponseHelper::parseErrorResponse($this->data['errors'][0]['message'], 'Invoice');
            }
        } else {
            return 'NULL returned from API';
        }

        return null;
    }

    /**
     * Add Contact to Invoice
     * @param $data Array of single Customer
     * @param array $invoice MYOB Invoice Object Mapping
     * @return mixed
     */
    private function parseContact($invoice, $data) {
        if ($data) {
            $newContact = [];
            $newContact['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('uid', $data);
            $newContact['name'] = IndexSanityCheckHelper::indexSanityCheck('name', $data);
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
    private function parseLineItems($invoice, $data, $invoiceID) {
        if ($data) {
            $lineItems = [];
            $counter = 0;
            foreach($data as $lineItem) {
                $newLineItem = [];
                $newLineItem['accounting_id'] = $invoiceID.'-'.$counter;
                $newLineItem['description'] = IndexSanityCheckHelper::indexSanityCheck('description', $lineItem);
                $newLineItem['unit_amount'] = IndexSanityCheckHelper::indexSanityCheck('unitPrice', $lineItem);
                $newLineItem['line_amount'] = IndexSanityCheckHelper::indexSanityCheck('total', $lineItem);
                $newLineItem['quantity'] = IndexSanityCheckHelper::indexSanityCheck('quantity', $lineItem);
                $newLineItem['amount'] = IndexSanityCheckHelper::indexSanityCheck('total', $lineItem);

                if (array_key_exists('taxType', $lineItem)) {
                    if ($lineItem['taxType']) {
                        $newLineItem['tax_type'] = IndexSanityCheckHelper::indexSanityCheck('code', $lineItem['taxType']);
                    }
                }

                if (array_key_exists('item', $lineItem)) {
                    if ($lineItem['item']) {
                        $newLineItem['code'] = IndexSanityCheckHelper::indexSanityCheck('number', $lineItem['item']);
                        $newLineItem['item_code'] = IndexSanityCheckHelper::indexSanityCheck('uid', $lineItem['item']);
                    }
                }

                array_push($lineItems, $newLineItem);
                $counter++;
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
        if (array_key_exists('items', $this->data)) {
            foreach ($this->data['items'] as $invoice) {
                $newInvoice = [];
                $newInvoice['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('uid', $invoice);
                $newInvoice['status'] = IndexSanityCheckHelper::indexSanityCheck('status', $invoice);
                $newInvoice['total_tax'] = IndexSanityCheckHelper::indexSanityCheck('gst', $invoice);
                $newInvoice['total'] = IndexSanityCheckHelper::indexSanityCheck('total', $invoice);
                $newInvoice['invoice_number'] = IndexSanityCheckHelper::indexSanityCheck('invoiceNumber', $invoice);
                $newInvoice['amount_due'] = IndexSanityCheckHelper::indexSanityCheck('amountDue', $invoice);
                $newInvoice['amount_paid'] = IndexSanityCheckHelper::indexSanityCheck('amountPaid', $invoice);
                $newInvoice['date'] = IndexSanityCheckHelper::indexSanityCheck('issueDate', $invoice);
                $newInvoice['due_date'] = IndexSanityCheckHelper::indexSanityCheck('dueDate', $invoice);
                $newInvoice['gst_inclusive'] = IndexSanityCheckHelper::indexSanityCheck('gstInclusive', $invoice);

                if (array_key_exists('gstInclusive', $invoice) && array_key_exists('gst', $invoice)) {
                    if ($invoice['gstInclusive'] === true) {
                        $newInvoice['subtotal'] = (float) $newInvoice['total'] - (float) $newInvoice['gst'];
                    } else {
                        $newInvoice['subtotal'] = $newInvoice['total'];
                    }
                }
                if (array_key_exists('contact', $invoice)) {
                    if ($invoice['contact']) {
                        $newInvoice = $this->parseContact($newInvoice, $invoice['contact']);
                    }
                }

                if (array_key_exists('lines', $invoice)) {
                    if ($invoice['lines']) {
                        $newInvoice = $this->parseLineItems($newInvoice, $invoice['lines'], $newInvoice['accounting_id']);
                    }
                }

                array_push($invoices, $newInvoice);
            }
        } else {
            $invoice = $this->data;
            $newInvoice = [];
            $newInvoice['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('uid', $invoice);
            $newInvoice['status'] = IndexSanityCheckHelper::indexSanityCheck('status', $invoice);
            $newInvoice['total_tax'] = IndexSanityCheckHelper::indexSanityCheck('gst', $invoice);
            $newInvoice['total'] = IndexSanityCheckHelper::indexSanityCheck('total', $invoice);
            $newInvoice['invoice_number'] = IndexSanityCheckHelper::indexSanityCheck('invoiceNumber', $invoice);
            $newInvoice['amount_due'] = IndexSanityCheckHelper::indexSanityCheck('amountDue', $invoice);
            $newInvoice['amount_paid'] = IndexSanityCheckHelper::indexSanityCheck('amountPaid', $invoice);
            $newInvoice['date'] = IndexSanityCheckHelper::indexSanityCheck('issueDate', $invoice);
            $newInvoice['due_date'] = IndexSanityCheckHelper::indexSanityCheck('dueDate', $invoice);
            $newInvoice['gst_inclusive'] = IndexSanityCheckHelper::indexSanityCheck('gstInclusive', $invoice);

            if (array_key_exists('gstInclusive', $invoice) && array_key_exists('gst', $invoice)) {
                if ($invoice['gstInclusive'] === true) {
                    $newInvoice['subtotal'] = (float) $invoice['total'] - (float) $invoice['gst'];
                } else {
                    $newInvoice['subtotal'] = $invoice['total'];
                }
            }
            if (array_key_exists('contact', $invoice)) {
                if ($invoice['contact']) {
                    $newInvoice = $this->parseContact($newInvoice, $invoice['contact']);
                }
            }

            if (array_key_exists('lines', $invoice)) {
                if ($invoice['lines']) {
                    $newInvoice = $this->parseLineItems($newInvoice, $invoice['lines'], $newInvoice['accounting_id']);
                }
            }

            array_push($invoices, $newInvoice);
        }


        return $invoices;
    }
}