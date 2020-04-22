<?php


namespace PHPAccounting\MyobAccountRightLive\Message\Journals\Requests\Essentials;


use PHPAccounting\MyobAccountRightLive\Helpers\Essentials\BuildEndpointHelper;
use PHPAccounting\MyobAccountRightLive\Message\AbstractRequest;
use PHPAccounting\MyobAccountRightLive\Message\Accounts\Requests\Essentials\GetAccountRequest;
use PHPAccounting\MyobAccountRightLive\Message\Journals\Responses\Essentials\GetJournalResponse;

/**
 * Get Journal(s)
 * @package PHPAccounting\MyobAccountRightLive\Message\Journals\Requests\Essentials
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
     * Set From Date for Pagination from Parameter Bag
     * @param $value
     * @return GetJournalRequest
     */
    public function setFromDate($value) {
        return $this->setParameter('from_date', $value);
    }

    /**
     * Get From Date for Pagination from Parameter Bag
     * @return GetJournalRequest
     */
    public function getFromDate() {
        return $this->getParameter('from_date');
    }

    /**
     * Get To Date for Pagination from Parameter Bag
     * @param $value
     * @return GetJournalRequest
     */
    public function setToDate($value) {
        return $this->setParameter('to_date', $value);
    }

    /**
     * Get To Date for Pagination from Parameter Bag
     * @return GetJournalRequest
     */
    public function getToDate() {
        return $this->getParameter('to_date');
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

    public function getEndpoint()
    {

        $endpoint = 'generalLedger/journalTransactions';

        if ($this->getAccountingID()) {
            if ($this->getAccountingID() !== "") {
                $endpoint = BuildEndpointHelper::loadByGUID($endpoint, $this->getAccountingID());
            }
        } else {
            if ($this->getPage()) {
                if ($this->getPage() !== "") {
                    $endpoint = BuildEndpointHelper::paginateLegacy($endpoint, $this->getPage(), $this->getFromDate(), $this->getToDate());
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