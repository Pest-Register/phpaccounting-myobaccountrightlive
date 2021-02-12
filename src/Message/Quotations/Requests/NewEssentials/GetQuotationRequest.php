<?php


namespace PHPAccounting\MyobAccountRightLive\Message\Quotations\Requests\NewEssentials;


use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\BuildEndpointHelper;
use PHPAccounting\MyobAccountRightLive\Message\AbstractRequest;
use PHPAccounting\MyobAccountRightLive\Message\Invoices\Responses\NewEssentials\GetInvoiceResponse;
use PHPAccounting\MyobAccountRightLive\Message\Quotations\Responses\NewEssentials\GetQuotationResponse;

class GetQuotationRequest extends AbstractRequest
{
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

    /**
     * Set AccountingID from Parameter Bag (UID generic interface)
     * @param $value
     * @return GetQuotationRequest
     */
    public function setAccountingID($value) {
        return $this->setParameter('accounting_id', $value);
    }

    /**
     * Set Page Value for Pagination from Parameter Bag
     * @param $value
     * @return GetQuotationRequest
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
     * Return Page Value for Pagination
     * @return integer
     */
    public function getPage() {
        if ($this->getParameter('page')) {
            return $this->getParameter('page');
        }

        return 1;
    }

    /**
     * Set Page Value for Pagination from Parameter Bag
     * @param $value
     * @return GetQuotationRequest
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

    public function getEndpoint()
    {

        $endpoint = 'Sale/Quote/'.$this->getQuotationType().'/';

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
        return $this->response = new GetQuotationResponse($this, $data);
    }

}