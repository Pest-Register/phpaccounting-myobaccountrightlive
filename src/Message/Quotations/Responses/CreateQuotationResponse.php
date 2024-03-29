<?php


namespace PHPAccounting\MyobAccountRightLive\Message\Quotations\Responses;

use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\IndexSanityCheckHelper;
use PHPAccounting\MyobAccountRightLive\Message\AbstractMYOBResponse;

class CreateQuotationResponse extends AbstractMYOBResponse
{

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
                    return 'SENT';
                case 'Closed':
                    return 'DELETED';
                case 'Accepted':
                    return 'ACCEPTED';
                case 'Rejected':
                    return 'REJECTED';
            }
        }
        return null;
    }

    /**
     * Add Contact to Quote
     * @param $data Array of single Customer
     * @param array $quote MYOB Quote Object Mapping
     * @return mixed
     */
    private function parseCustomer($quote, $data) {
        if ($data) {
            $newContact = [];
            $newContact['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $data);
            $newContact['name'] = IndexSanityCheckHelper::indexSanityCheck('Name', $data);
            $quote['contact'] = $newContact;
        }

        return $quote;
    }

    /**
     * Add LineItems to Quote
     * @param $data Array of LineItems
     * @param array $quote MYOB Quote Object Mapping
     * @return mixed
     */
    private function parseLineItems($quote, $data) {
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
                        $newLineItem['account_code'] = IndexSanityCheckHelper::indexSanityCheck('Number', $lineItem['Account']);
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

            $quote['quotation_data'] = $lineItems;
        }

        return $quote;
    }

    /**
     * @param $quote
     * @return array|mixed
     */
    private function parseData($quote) {
        $newQuote = [];
        $newQuote['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $quote);
        $newQuote['status'] = $this->parseStatus(IndexSanityCheckHelper::indexSanityCheck('Status', $quote));
        $newQuote['sub_total'] = IndexSanityCheckHelper::indexSanityCheck('Subtotal', $quote);
        $newQuote['total_tax'] = IndexSanityCheckHelper::indexSanityCheck('TotalTax', $quote);
        $newQuote['total'] = IndexSanityCheckHelper::indexSanityCheck('TotalAmount', $quote);
        $newQuote['quotation_number'] = IndexSanityCheckHelper::indexSanityCheck('Number', $quote);
        $newQuote['amount_due'] = IndexSanityCheckHelper::indexSanityCheck('BalanceDueAmount', $quote);
        $newQuote['date'] = IndexSanityCheckHelper::indexSanityCheck('Date', $quote);
        $newQuote['gst_inclusive'] = $this->parseTaxCalculation(IndexSanityCheckHelper::indexSanityCheck('IsTaxInclusive', $quote));
        $newQuote['sync_token'] = IndexSanityCheckHelper::indexSanityCheck('RowVersion', $quote);
        $newQuote['updated_at'] = IndexSanityCheckHelper::indexSanityCheck('LastModified', $quote);

        if (array_key_exists('Customer', $quote)) {
            if ($quote['Customer']) {
                $newQuote = $this->parseCustomer($newQuote, $quote['Customer']);
            }
        }

        if (array_key_exists('Lines', $quote)) {
            if ($quote['Lines']) {
                $newQuote = $this->parseLineItems($newQuote, $quote['Lines']);
            }
        }

        if (array_key_exists('Terms', $quote)) {
            if ($quote['Terms']) {
                $newQuote['expiry_date'] = IndexSanityCheckHelper::indexSanityCheck('DueDate', $quote['Terms']);
            }
        }
        return $newQuote;
    }

    /**
     * Return all Quotes with Generic Schema Variable Assignment
     * @return array
     */
    public function getQuotations(){
        $quotes = [];
        if ($this->data && !is_string($this->data)) {
            if (!array_key_exists('Items', $this->data)) {
                $newQuote = $this->parseData($this->data);
                $quotes[] = $newQuote;
            } else {
                foreach ($this->data['Items'] as $quote) {
                    $newQuote = $this->parseData($quote);
                    $quotes[] = $newQuote;
                }
            }
        }

        return $quotes;
    }
}