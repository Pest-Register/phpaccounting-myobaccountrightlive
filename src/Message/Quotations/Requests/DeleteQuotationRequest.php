<?php


namespace PHPAccounting\MyobAccountRightLive\Message\Quotations\Requests;


use PHPAccounting\MyobAccountRightLive\Helpers\Current\BuildEndpointHelper;
use PHPAccounting\MyobAccountRightLive\Message\AbstractMYOBRequest;
use PHPAccounting\MyobAccountRightLive\Message\Quotations\Responses\DeleteQuotationResponse;
use PHPAccounting\MyobAccountRightLive\Traits\AccountingIDRequestTrait;

class DeleteQuotationRequest extends AbstractMYOBRequest
{
    use AccountingIDRequestTrait;

    public string $model = 'Quotation';

    public function getData()
    {
        return $this->data;
    }

    public function getEndpoint()
    {
        $endpoint = 'Sale/Quote/Service?returnBody=true';

        if ($this->getAccountingID()) {
            if ($this->getAccountingID() !== "") {
                $endpoint = BuildEndpointHelper::deleteForGUID('Sale/Quote/Service', $this->getAccountingID());
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
        return $this->response = new DeleteQuotationResponse($this, $data, $headers, $statusCode);
    }
}