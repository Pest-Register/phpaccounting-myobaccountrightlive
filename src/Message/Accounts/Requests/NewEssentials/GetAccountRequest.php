<?php

namespace PHPAccounting\MyobAccountRightLive\Message\Accounts\Requests\NewEssentials;

use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\BuildEndpointHelper;
use PHPAccounting\MyobAccountRightLive\Message\AbstractRequest;
use PHPAccounting\MyobAccountRightLive\Message\Accounts\Responses\NewEssentials\GetAccountResponse;


/**
 * Get Account(s)
 * @package PHPAccounting\MyobAccountRightLive\Message\Accounts\Requests\NewEssentials
 */
class GetAccountRequest extends AbstractRequest
{

    /**
     * Set AccountingID from Parameter Bag (UID generic interface)
     * @param $value
     * @return GetAccountRequest
     */
    public function setAccountingID($value) {
        return $this->setParameter('accounting_id', $value);
    }

    /**
     * Set Page Value for Pagination from Parameter Bag
     * @param $value
     * @return GetAccountRequest
     */
    public function setPage($value) {
        return $this->setParameter('page', $value);
    }

    /**
     * Return Accounting IDs (UID)
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
     * @return GetAccountRequest
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
     * Set SearchTerm from Parameter Bag (interface for query-based searching)
     * @see https://www.odata.org/documentation/odata-version-3-0/odata-version-3-0-core-protocol/
     * @param $value
     * @return GetAccountRequest
     */
    public function setSearchTerm($value) {
        return $this->setParameter('search_term', $value);
    }

    /**
     * Set SearchParam from Parameter Bag (interface for query-based searching)
     * @see https://www.odata.org/documentation/odata-version-3-0/odata-version-3-0-core-protocol/
     * @param $value
     * @return GetAccountRequest
     */
    public function setSearchParam($value) {
        return $this->setParameter('search_param', $value);
    }

    /**
     * Return Search Parameter for query-based searching
     * @return integer
     */
    public function getSearchParam() {
        return $this->getParameter('search_param');
    }

    /**
     * Return Search Term for query-based searching
     * @return integer
     */
    public function getSearchTerm() {
        return $this->getParameter('search_term');
    }

    public function getEndpoint()
    {

        $endpoint = 'GeneralLedger/Account/';

        if ($this->getAccountingID()) {
            if ($this->getAccountingID() !== "") {
                $endpoint = BuildEndpointHelper::loadByGUID($endpoint, $this->getAccountingID());
            }
        } else {
            if($this->getSearchParam() && $this->getSearchTerm())
            {
                $endpoint = BuildEndpointHelper::search($endpoint, $this->getSearchParam(), $this->getSearchTerm(), 'substringof');
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
        return $this->response = new GetAccountResponse($this, $data);
    }

}