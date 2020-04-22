<?php

namespace PHPAccounting\MyobAccountRightLive\Message\Journals\Requests\AccountRight;

use PHPAccounting\MyobAccountRightLive\Helpers\AccountRight\BuildEndpointHelper;
use PHPAccounting\MyobAccountRightLive\Helpers\AccountRight\IndexSanityCheckHelper;
use PHPAccounting\MyobAccountRightLive\Message\AbstractRequest;
use PHPAccounting\MyobAccountRightLive\Message\Accounts\Responses\AccountRight\GetAccountResponse;
use PHPAccounting\MyobAccountRightLive\Message\Journals\Responses\AccountRight\GetJournalResponse;


/**
 * Get Journal(s)
 * @package PHPAccounting\MyobAccountRightLive\Message\Journals\Requests\AccountRight
 */
class GetJournalRequest extends AbstractRequest
{

    /**
     * Set AccountingID from Parameter Bag (UID generic interface)
     * @param $value
     * @return GetJournalRequest
     */
    public function setAccountingID($value) {
        return $this->setParameter('accounting_id', $value);
    }

    /**
     * Set Page Value for Pagination from Parameter Bag
     * @param $value
     * @return GetJournalRequest
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
     * @return GetJournalRequest
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

        return 1;
    }

    public function getEndpoint()
    {

        $endpoint = 'GeneralLedger/JournalTransaction/';

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
        return $this->response = new GetJournalResponse($this, $data);
    }

}