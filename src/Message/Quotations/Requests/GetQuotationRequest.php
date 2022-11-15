<?php


namespace PHPAccounting\MyobAccountRightLive\Message\Quotations\Requests;


use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\BuildEndpointHelper;
use PHPAccounting\MyobAccountRightLive\Message\AbstractMYOBRequest;
use PHPAccounting\MyobAccountRightLive\Message\Quotations\Responses\GetQuotationResponse;
use PHPAccounting\MyobAccountRightLive\Traits\GetRequestTrait;

class GetQuotationRequest extends AbstractMYOBRequest
{
    use GetRequestTrait;
    public string $model = 'Quotation';

    /**
     * Set Invoice Type from Parameter Bag
     * @param $value
     * @return GetQuotationRequest
     */
    public function setQuotationType($value) {
        return $this->setParameter('quotation_type', $value);
    }

    /**
     * Get Invoice Type from Parameter Bag
     */
    public function getQuotationType() {
        return $this->getParameter('quotation_type');
    }

    public function getEndpoint()
    {

        $endpoint = 'Sale/Quote/'.$this->getQuotationType().'/';

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
        return $this->response = new GetQuotationResponse($this, $data);
    }

}