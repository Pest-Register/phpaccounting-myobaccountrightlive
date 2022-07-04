<?php


namespace PHPAccounting\MyobAccountRightLive\Message\Quotations\Responses\NewEssentials;


use Omnipay\Common\Message\AbstractResponse;
use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\ErrorResponseHelper;
use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\IndexSanityCheckHelper;

class UpdateQuotationResponse extends AbstractResponse
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
                    'Quotation'
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
     * Return all Quotes with Generic Schema Variable Assignment
     * @return array
     */
    public function getQuotations(){
        $quotes = [];
        if (!array_key_exists('Items', $this->data)) {
            $quote = $this->data;
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

            array_push($quotes, $newQuote);
        } else {
            foreach ($this->data['Items'] as $quote) {
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

                array_push($quotes, $newQuote);
            }
        }

        return $quotes;
    }
}