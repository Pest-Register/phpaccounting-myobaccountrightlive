<?php


namespace PHPAccounting\MyobAccountRightLive\Message\Quotations\Requests;


use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\BuildEndpointHelper;
use PHPAccounting\MyobAccountRightLive\Message\AbstractMYOBRequest;
use PHPAccounting\MyobAccountRightLive\Message\Quotations\Responses\GetQuotationUIDsResponse;
use PHPAccounting\MyobAccountRightLive\Traits\GetRequestTrait;

/**
 * Get Quote UIDs
 * @package PHPAccounting\MyobAccountRightLive\Message\Quotations\Requests\NewEssentials
 */
class GetQuotationUIDsRequest extends AbstractMYOBRequest
{

    use GetRequestTrait;

    public string $model = 'Quotation';

    public function getEndpoint()
    {

        $endpoint = 'Sale/Quote';

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
        return $this->response = new GetQuotationUIDsResponse($this, $data);
    }
}