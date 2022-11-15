<?php

namespace PHPAccounting\MyobAccountRightLive\Message\Payments\Requests;

use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\BuildEndpointHelper;
use PHPAccounting\MyobAccountRightLive\Message\AbstractMYOBRequest;
use PHPAccounting\MyobAccountRightLive\Message\Payments\Responses\GetPaymentResponse;
use PHPAccounting\MyobAccountRightLive\Traits\GetRequestTrait;

/**
 * Get Payment(s)
 * @package PHPAccounting\MyobAccountRightLive\Message\Invoices\Requests\NewEssentials
 */
class GetPaymentRequest extends AbstractMYOBRequest
{
    use GetRequestTrait;

    public string $model = 'Payment';

    /**
     * Set Invoice Accounting ID Value from Parameter Bag
     * @param $value
     * @return GetPaymentRequest
     */
    public function setInvoiceID($value) {
        return $this->setParameter('invoice_id', $value);
    }

    /***
     * Return Invoice Accounting ID (UID)
     * @return mixed|null
     */
    public function getInvoiceID() {
        if ($this->getParameter('invoice_id')) {
            return $this->getParameter('invoice_id');
        }
        return null;
    }

    private function loadByInvoiceID($endpoint, $invoiceGUID) {
        $prefix = '?$';
        $endpoint = $endpoint . $prefix."filter=Invoices/any(x: x/UID eq guid'".$invoiceGUID."')";
        return $endpoint;
    }

    public function getEndpoint()
    {
        $endpoint = 'Sale/CustomerPayment/';
        if ($this->getInvoiceID()) {
            if ($this->getInvoiceID() !== "") {
                $endpoint = $this->loadByInvoiceID($endpoint, $this->getInvoiceID());
            }
        }
        else {
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
        }
        return $endpoint;
    }

    public function getHttpMethod()
    {
        return 'GET';
    }

    protected function createResponse($data, $headers = [])
    {
        return $this->response = new GetPaymentResponse($this, $data);
    }
}