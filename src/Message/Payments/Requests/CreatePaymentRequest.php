<?php


namespace PHPAccounting\MyobAccountRightLive\Message\Payments\Requests;


use PHPAccounting\MyobAccountRightLive\Message\AbstractMYOBRequest;
use PHPAccounting\MyobAccountRightLive\Message\Payments\Requests\Traits\PaymentRequestTrait;
use PHPAccounting\MyobAccountRightLive\Message\Payments\Responses\CreatePaymentResponse;

class CreatePaymentRequest extends AbstractMYOBRequest
{
    use PaymentRequestTrait;

    public string $model = 'Payment';

    public function getData()
    {
        $this->validate('account', 'contact', 'amount', 'date');

        $this->issetParam('Date', 'date');
        $this->issetParam('Memo', 'reference_id');
        $this->data['DepositTo'] = 'Account';
        if ($this->getInvoice() !== null && $this->getAmount()!== null &&
            isset($this->getInvoice()['accounting_id'])) {
            $this->data['Invoices'] = [[
                "UID" => $this->getInvoice()['accounting_id'],
                "AmountApplied" => $this->getAmount(),
                "Type" => 'Invoice'
            ]];
        }

        if ($this->getAccount() !== null && isset($this->getAccount()['accounting_id'])) {
            $this->data['Account'] = [
                'UID' => $this->getAccount()['accounting_id']
            ];
        }

        if ($this->getContact() !== null && isset($this->getContact()['accounting_id'])) {
            $this->data['Customer'] = [
                'UID' => $this->getContact()['accounting_id']
            ];
        }

        return $this->data;
    }

    public function getEndpoint()
    {

        $endpoint = 'Sale/CustomerPayment?returnBody=true';
        return $endpoint;
    }

    public function getHttpMethod()
    {
        return 'POST';
    }

    protected function createResponse($data, $headers = [])
    {
        return $this->response = new CreatePaymentResponse($this, $data);
    }
}