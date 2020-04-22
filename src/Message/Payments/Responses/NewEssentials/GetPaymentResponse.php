<?php

namespace PHPAccounting\MyobAccountRightLive\Message\Payments\Responses\NewEssentials;

use Omnipay\Common\Message\AbstractResponse;
use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\IndexSanityCheckHelper;

/**
 * Get Payment(s) Response
 * @package PHPAccounting\MyobAccountRightLive\Message\Invoices\Responses\NewEssentials
 */
class GetPaymentResponse extends AbstractResponse
{
    /**
     * Check Response for Error or Success
     * @return boolean
     */
    public function isSuccessful()
    {
        if(array_key_exists('Errors', $this->data)){
            return !$this->data['Errors'][0]['Severity'] == 'Error';
        }
        if (array_key_exists('Items', $this->data)) {
            if (count($this->data['Items']) === 0) {
                return false;
            }
        }
        return true;
    }

    /**
     * Fetch Error Message from Response
     * @return string
     */
    public function getErrorMessage()
    {
        if (array_key_exists('Errors', $this->data)) {
            if ($this->data['Errors'][0]['Message'] === 'The supplied OAuth token (Bearer) is not valid') {
                return 'The access token has expired';
            }
            else {
                return $this->data['Errors'][0]['Message'];
            }
        }
        if (array_key_exists('Items', $this->data)) {
            if (count($this->data['Items']) === 0) {
                return 'NULL Returned from API or End of Pagination';
            }
        }

        return null;
    }

    /**
     * Add Invoice to Payment
     * @param $data Array of single Contact
     * @param array $payment Xero Invoice Object Mapping
     * @return mixed
     */
    private function parseInvoices($payment, $data) {
        if ($data) {
            $newInvoice = [];
            $newInvoice['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $data[0]);
            $newInvoice['type'] = IndexSanityCheckHelper::indexSanityCheck('Type', $data[0]);
            $newInvoice['invoice_number'] = IndexSanityCheckHelper::indexSanityCheck('Number', $data[0]);
            $payment['invoice'] = $newInvoice;
        }

        return $payment;
    }

    /**
     * Add Account to Payment
     * @param $data Array of single Contact
     * @param array $payment Xero Invoice Object Mapping
     * @return mixed
     */
    private function parseAccount($payment, $data) {
        if ($data) {
            $newAccount = [];
            $newAccount['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $data);
            $newAccount['code'] = IndexSanityCheckHelper::indexSanityCheck('DisplayID', $data);
            $payment['account'] = $newAccount;
        }

        return $payment;
    }

    /**
     * Return all Invoices with Generic Schema Variable Assignment
     * @return array
     */
    public function getPayments(){
        $payments = [];
        foreach ($this->data['Items'] as $payment) {
            $newPayment = [];
            $newPayment['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $payment);
            $newPayment['date'] = IndexSanityCheckHelper::indexSanityCheck('Date', $payment);
            $newPayment['amount'] = IndexSanityCheckHelper::indexSanityCheck('AmountReceived', $payment);
            $newPayment['reference_id'] = IndexSanityCheckHelper::indexSanityCheck('Memo', $payment);
            $newPayment['type'] = IndexSanityCheckHelper::indexSanityCheck('PaymentMethod', $payment);

            if (array_key_exists('Account', $payment)) {
                if ($payment['Account']) {
                    $newPayment = $this->parseAccount($newPayment, $payment['Account']);
                }
            }

            if (array_key_exists('Invoices', $payment)) {
                if ($payment['Invoices']) {
                    $newPayment = $this->parseInvoices($newPayment, $payment['Invoices']);
                }
            }


            if (array_key_exists('ReceiptNumber', $payment)) {
                if ($payment['ReceiptNumber']) {
                    $newPayment['is_reconciled'] = true;
                }
            }
            array_push($payments, $newPayment);
        }

        return $payments;
    }
}