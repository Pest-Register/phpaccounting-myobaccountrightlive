<?php

namespace PHPAccounting\MyobAccountRightLive\Message\Payments\Requests\NewEssentials;

use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\BuildEndpointHelper;
use PHPAccounting\MyobAccountRightLive\Message\AbstractRequest;
use PHPAccounting\MyobAccountRightLive\Message\Payments\Responses\NewEssentials\GetPaymentResponse;

/**
 * Get Payment(s)
 * @package PHPAccounting\MyobAccountRightLive\Message\Invoices\Requests\NewEssentials
 */
class GetPaymentRequest extends AbstractRequest
{

    /**
     * Set AccountingID from Parameter Bag (UID generic interface)
     * @param $value
     * @return GetPaymentRequest
     */
    public function setAccountingID($value) {
        return $this->setParameter('accounting_id', $value);
    }

    /**
     * Set Page Value for Pagination from Parameter Bag
     * @param $value
     * @return GetPaymentRequest
     */
    public function setPage($value) {
        return $this->setParameter('page', $value);
    }

    /**
     * Return Accounting ID (UID)
     * @return mixed comma-delimited-string
     */
    public function getAccountingID() {
        if ($this->getParameter('accounting_id')) {
            return $this->getParameter('accounting_id');
        }
        return null;
    }

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

    /**
     * Return Page Value for Pagination
     * @return integer
     */
    public function getPage() {
        if ($this->getParameter('page')) {
            return $this->getParameter('page');
        }

        return 1000;
    }

    /**
     * Set Page Value for Pagination from Parameter Bag
     * @param $value
     * @return GetPaymentRequest
     */
    public function setSkip($value) {
        return $this->setParameter('skip', $value);
    }

    /**
     * Return Page Value for Pagination
     * @return integer
     */
    public function getSkip() {
        if ($this->getParameter('skip')) {
            return $this->getParameter('skip');
        }

        return 0;
    }


    /**
     * Set SearchParams from Parameter Bag (interface for query-based searching)
     * @see https://www.odata.org/documentation/odata-version-3-0/odata-version-3-0-core-protocol/
     * @param $value
     * @return GetPaymentRequest
     */
    public function setSearchParams($value) {
        return $this->setParameter('search_params', $value);
    }
    /**
     * Return Search Parameters for query-based searching
     * @return integer
     */
    public function getSearchParams() {
        return $this->getParameter('search_params');
    }

    /**
     * Set boolean to determine partial or exact query based searches
     * @param $value
     * @return GetPaymentRequest
     */
    public function setExactSearchValue($value) {
        return $this->setParameter('exact_search_value', $value);
    }

    /**
     * Get boolean to determine partial or exact query based searches
     * @return mixed
     */
    public function getExactSearchValue() {
        return $this->getParameter('exact_search_value');
    }

    /**
     * Set SearchFilters from Parameter Bag (interface for query-based searching)
     * @see https://www.odata.org/documentation/odata-version-3-0/odata-version-3-0-core-protocol/
     * @param $value
     * @return GetPaymentRequest
     */
    public function setSearchFilters($value) {
        return $this->setParameter('search_filters', $value);
    }

    /**
     * Return Search Filters for query-based searching
     * @return array
     */
    public function getSearchFilters() {
        return $this->getParameter('search_filters');
    }

    /**
     * Set boolean to determine whether all filters need to be matched
     * @param $value
     * @return GetPaymentRequest
     */
    public function setMatchAllFilters($value) {
        return $this->setParameter('match_all_filters', $value);
    }

    /**
     * Get boolean to determine whether all filters need to be matched
     * @return mixed
     */
    public function getMatchAllFilters() {
        return $this->getParameter('match_all_filters');
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