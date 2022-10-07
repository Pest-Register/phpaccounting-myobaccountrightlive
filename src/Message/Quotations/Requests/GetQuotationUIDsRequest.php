<?php


namespace PHPAccounting\MyobAccountRightLive\Message\Quotations\Requests;


use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\BuildEndpointHelper;
use PHPAccounting\MyobAccountRightLive\Message\AbstractMYOBRequest;
use PHPAccounting\MyobAccountRightLive\Message\Quotations\Responses\GetQuotationUIDsResponse;

/**
 * Get Quote UIDs
 * @package PHPAccounting\MyobAccountRightLive\Message\Quotations\Requests\NewEssentials
 */
class GetQuotationUIDsRequest extends AbstractMYOBRequest
{

    public string $model = 'Quotation';

    /**
     * Set AccountingID from Parameter Bag (UID generic interface)
     * @param $value
     * @return GetQuotationUIDsRequest
     */
    public function setAccountingID($value) {
        return $this->setParameter('accounting_id', $value);
    }

    /**
     * Set Page Value for Pagination from Parameter Bag
     * @param $value
     * @return GetQuotationUIDsRequest
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
     * @return GetQuotationUIDsRequest
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