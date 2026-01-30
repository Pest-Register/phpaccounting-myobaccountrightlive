<?php


namespace PHPAccounting\MyobAccountRightLive\Message\Invoices\Requests;


use PHPAccounting\MyobAccountRightLive\Helpers\Current\BuildEndpointHelper;
use PHPAccounting\MyobAccountRightLive\Message\AbstractMYOBRequest;
use PHPAccounting\MyobAccountRightLive\Message\Invoices\Responses\DeleteInvoiceResponse;
use PHPAccounting\MyobAccountRightLive\Traits\AccountingIDRequestTrait;

class DeleteInvoiceRequest extends AbstractMYOBRequest
{
    use AccountingIDRequestTrait;

    public string $model = 'Invoice';


    public function getData()
    {
        return $this->data;
    }

    public function getEndpoint()
    {
        $endpoint = 'Sale/Invoice/Item?returnBody=true';

        if ($this->getAccountingID()) {
            if ($this->getAccountingID() !== "") {
                $endpoint = BuildEndpointHelper::deleteForGUID('Sale/Invoice/Item', $this->getAccountingID());
            }
        }
        return $endpoint;
    }

    public function getHttpMethod()
    {
        return 'DELETE';
    }

    protected function createResponse($data, $headers = [], ?int $statusCode = null)
    {
        return $this->response = new DeleteInvoiceResponse($this, $data, $headers, $statusCode);
    }
}