<?php

namespace PHPAccounting\MyobAccountRightLive\Message\Payments\Responses\NewEssentials;

use Omnipay\Common\Message\AbstractResponse;
use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\ErrorResponseHelper;
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
        if ($this->data) {
            if (is_string($this->data)) {
                return true;
            } else {
                if (array_key_exists('Errors', $this->data)) {
                    return !$this->data['Errors'][0]['Severity'] == 'Error';
                }
                if (array_key_exists('Items', $this->data)) {
                    if (count($this->data['Items']) === 0) {
                        return false;
                    }
                }
            }
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
            if (is_string($this->data)) {
                $additionalDetails = '';
                $errorCode = '';
                $status ='';
                $response = $this->data;
                return ErrorResponseHelper::parseErrorResponse(
                    $response,
                    $status,
                    $errorCode,
                    null,
                    $additionalDetails,
                    'Payment'
                );
            } else {
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
                        'Payment'
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
        }

        return null;
    }

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

    /**
     * Return all Invoices with Generic Schema Variable Assignment
     * @return array
     */
    public function getPayments(){
        $payments = [];
        if (!is_string($this->data)) {
            if (!array_key_exists('Items', $this->data)) {
                $payment = $this->data;
                $newPayment = [];
                $newPayment['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $payment);
                $newPayment['date'] = IndexSanityCheckHelper::indexSanityCheck('Date', $payment);
                $newPayment['amount'] = IndexSanityCheckHelper::indexSanityCheck('AmountReceived', $payment);
                $newPayment['reference_id'] = IndexSanityCheckHelper::indexSanityCheck('Memo', $payment);
                $newPayment['type'] = IndexSanityCheckHelper::indexSanityCheck('PaymentMethod', $payment);
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


                if (array_key_exists('ReceiptNumber', $payment)) {
                    if ($payment['ReceiptNumber']) {
                        $newPayment['is_reconciled'] = true;
                    }
                }
                array_push($payments, $newPayment);
            } else {
                foreach ($this->data['Items'] as $payment) {
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
                    array_push($payments, $newPayment);
                }
            }
        }

        return $payments;
    }
}