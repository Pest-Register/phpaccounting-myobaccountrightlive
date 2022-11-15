<?php

namespace PHPAccounting\MyobAccountRightLive\Message\Invoices\Requests;
use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\BuildEndpointHelper;
use PHPAccounting\MyobAccountRightLive\Message\AbstractMYOBRequest;
use PHPAccounting\MyobAccountRightLive\Message\Invoices\Responses\GetInvoiceResponse;
use PHPAccounting\MyobAccountRightLive\Traits\GetRequestTrait;

/**
 * Get Invoice(s)
 * @package PHPAccounting\MyobAccountRightLive\Message\Invoices\Requests\NewEssentials
 */
class GetInvoiceRequest extends AbstractMYOBRequest
{
    use GetRequestTrait;

    public string $model = 'Invoice';

    /**
     * Set Invoice Type from Parameter Bag
     * @param $value
     * @return GetInvoiceRequest
     */
    public function setInvoiceType($value) {
        return $this->setParameter('invoice_type', $value);
    }

    /**
     * Get Invoice Type from Parameter Bag
     */
    public function getInvoiceType() {
        return $this->getParameter('invoice_type');
    }


    public function getEndpoint()
    {

        $endpoint = 'Sale/Invoice/'.$this->getInvoiceType().'/';

        if ($this->getAccountingID()) {
            if ($this->getAccountingID() !== "") {
                $endpoint = BuildEndpointHelper::loadByGUID($endpoint, $this->getAccountingID());
            }
        } else {
            if($this->getSearchParams() || $this->getSearchFilters())
            {
                $endpoint = BuildEndpointHelper::search(
                    $endpoint,
                    $this->getSearchParams(),
                    $this->getExactSearchValue(),
                    $this->getSearchFilters(),
                    $this->getMatchAllFilters(),
                    'substringof',
                    $this->getPage(),
                    $this->getSkip()
                );
            }
            else if ($this->getPage()) {
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
        return $this->response = new GetInvoiceResponse($this, $data);
    }
}