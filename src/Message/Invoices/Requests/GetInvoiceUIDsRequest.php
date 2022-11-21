<?php


namespace PHPAccounting\MyobAccountRightLive\Message\Invoices\Requests;


use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\BuildEndpointHelper;
use PHPAccounting\MyobAccountRightLive\Message\AbstractMYOBRequest;
use PHPAccounting\MyobAccountRightLive\Message\Invoices\Responses\GetInvoiceUIDsResponse;
use PHPAccounting\MyobAccountRightLive\Traits\GetRequestTrait;

/**
 * Get Invoice UIDs
 * @package PHPAccounting\MyobAccountRightLive\Message\Invoices\Requests\NewEssentials
 */
class GetInvoiceUIDsRequest extends AbstractMYOBRequest
{
    use GetRequestTrait;

    public string $model = 'Invoice';


    public function getEndpoint()
    {

        $endpoint = 'Sale/Invoice';

        if ($this->getAccountingID()) {
            if ($this->getAccountingID() !== "") {
                $endpoint = BuildEndpointHelper::loadByGUID($endpoint, $this->getAccountingID());
            }
        } else {
            if ($this->getPage()) {
                if ($this->getPage() !== "") {
                    $endpoint = BuildEndpointHelper::paginate($endpoint, $this->getPage(), $this->getSkip());
                }
            }
        }
        return $endpoint;
    }

    public function getHttpMethod()
    {
        return 'GET';
    }

    protected function createResponse($data, $headers = [])
    {
        return $this->response = new GetInvoiceUIDsResponse($this, $data);
    }
}