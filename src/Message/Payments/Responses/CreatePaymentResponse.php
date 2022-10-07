<?php


namespace PHPAccounting\MyobAccountRightLive\Message\Payments\Responses;

use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\IndexSanityCheckHelper;
use PHPAccounting\MyobAccountRightLive\Message\AbstractMYOBResponse;

class CreatePaymentResponse extends AbstractMYOBResponse
{

    /**
     * Add Customer to Payment
     * @param $data Array of single Contact
     * @param array $payment MYOB Invoice Object Mapping
     * @return mixed
     */
    private function parseContact($payment, $data) {
        if ($data) {
            $newContact = [];
            $newContact['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $data);
            $newContact['name'] = IndexSanityCheckHelper::indexSanityCheck('Name', $data);
            $payment['contact'] = $newContact;
        }

        return $payment;
    }

    /**
     * Add Invoice to Payment
     * @param $data Array of single Contact
     * @param array $payment MYOB Invoice Object Mapping
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
     * @param array $payment MYOB Invoice Object Mapping
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

    private function parseData($payment) {
        $newPayment = [];
        $newPayment['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $payment);
        $newPayment['date'] = IndexSanityCheckHelper::indexSanityCheck('Date', $payment);
        $newPayment['amount'] = IndexSanityCheckHelper::indexSanityCheck('AmountReceived', $payment);
        $newPayment['reference_id'] = IndexSanityCheckHelper::indexSanityCheck('Memo', $payment);
        $newPayment['sync_token'] = IndexSanityCheckHelper::indexSanityCheck('RowVersion', $payment);
        $newPayment['updated_at'] = IndexSanityCheckHelper::indexSanityCheck('LastModified', $payment);
        if (array_key_exists('Account', $payment)) {
            if ($payment['Account']) {
                $newPayment = $this->parseAccount($newPayment, $payment['Account']);
            }
        }

        if (array_key_exists('Customer', $payment)) {
            if ($payment['Customer']) {
                $newPayment = $this->parseContact($newPayment, $payment['Customer']);
            }
        }

        if (array_key_exists('Invoices', $payment)) {
            if ($payment['Invoices']) {
                $newPayment = $this->parseInvoices($newPayment, $payment['Invoices']);
            }
        }

        if (array_key_exists('PaymentMethod', $payment)) {
            if ($payment['PaymentMethod']) {
                $newPayment['type'] = $payment['PaymentMethod'];
            } else {
                $newPayment['type'] = 'ACCRECPAYMENT';
            }
        }


        if (array_key_exists('ReceiptNumber', $payment)) {
            if ($payment['ReceiptNumber']) {
                $newPayment['is_reconciled'] = true;
            }
        }

        return $newPayment;
    }

    /**
     * Return all Invoices with Generic Schema Variable Assignment
     * @return array
     */
    public function getPayments(){
        $payments = [];
        if ($this->data && !is_string($this->data)) {
            if (!array_key_exists('Items', $this->data)) {
                $newPayment = $this->parseData($this->data);
                $payments[] = $newPayment;
            } else {
                foreach ($this->data['Items'] as $payment) {
                    $newPayment = $this->parseData($payment);
                    $payments[] = $newPayment;
                }
            }
        }

        return $payments;
    }
}