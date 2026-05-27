<?php

namespace PHPAccounting\MyobAccountRightLive\Message\Invoices\Responses;

use PHPAccounting\MyobAccountRightLive\Helpers\IndexSanityCheckHelper;
use PHPAccounting\MyobAccountRightLive\Message\AbstractMYOBResponse;

/**
 * Get Invoice(s) Response
 * @package PHPAccounting\MyobAccountRightLive\Message\Invoices\Responses\NewEssentials
 */
class GetInvoiceResponse extends AbstractMYOBResponse
{
    /**
     * Tolerance for floating-point currency comparisons. The package is
     * standalone, so it can't read accounting.php — keep this in sync with
     * config('accounting.php_float_check') on the Mira side.
     */
    private const FLOAT_TOLERANCE = 0.001;

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
                case 'Voided':
                    return 'DELETED';
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

                $lineItems[] = $newLineItem;
            }

            $invoice['invoice_data'] = $lineItems;
        }

        return $invoice;
    }

    /**
     * @param $invoice
     * @return array|mixed
     */
    private function parseData($invoice) {
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

        // Always compute amount_paid when both totals are present — even when
        // BalanceDueAmount is 0 (fully paid). The old `&& $invoice['BalanceDueAmount']`
        // gate left amount_paid unset for fully paid invoices, which then
        // surfaced as missing data downstream.
        if (array_key_exists('TotalAmount', $invoice) && array_key_exists('BalanceDueAmount', $invoice)) {
            $newInvoice['amount_paid'] = max(0, (float) $invoice['TotalAmount'] - (float) $invoice['BalanceDueAmount']);
        }

        if (array_key_exists('Terms', $invoice)) {
            if ($invoice['Terms']) {
                $newInvoice['due_date'] = IndexSanityCheckHelper::indexSanityCheck('DueDate', $invoice['Terms']);
            }
        }

        // Float-tolerant status inference — direct `==` on currency values has
        // bitten us when a $0.0001 rounding diff makes a fully-paid invoice
        // show as OPEN. Skip when parseStatus already set DELETED (voided).
        if ($newInvoice['status'] !== 'DELETED') {
            $amountDue = (float) $newInvoice['amount_due'];
            $total = (float) $newInvoice['total'];
            if (abs($amountDue) < self::FLOAT_TOLERANCE) {
                $newInvoice['status'] = 'PAID';
            } elseif ($amountDue > self::FLOAT_TOLERANCE && abs($amountDue - $total) > self::FLOAT_TOLERANCE) {
                $newInvoice['status'] = 'PARTIAL';
            }
        }

        return $newInvoice;
    }

    /**
     * Return all Invoices with Generic Schema Variable Assignment
     * @return array
     */
    public function getInvoices(){
        $invoices = [];
        if ($this->data && !is_string($this->data)) {
            if (!array_key_exists('Items', $this->data)) {
                $newInvoice = $this->parseData($this->data);
                $invoices[] = $newInvoice;
            } else {
                foreach ($this->data['Items'] as $invoice) {
                    $newInvoice = $this->parseData($invoice);
                    $invoices[] = $newInvoice;
                }
            }
        }

        return $invoices;
    }
}