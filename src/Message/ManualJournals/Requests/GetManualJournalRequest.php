<?php

namespace PHPAccounting\MyobAccountRightLive\Message\ManualJournals\Requests;

use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\BuildEndpointHelper;
use PHPAccounting\MyobAccountRightLive\Message\AbstractMYOBRequest;
use PHPAccounting\MyobAccountRightLive\Message\ManualJournals\Responses\GetManualJournalResponse;


/**
 * Get Manual Journal(s)
 * @package PHPAccounting\MyobAccountRightLive\Message\Journals\Requests\NewEssentials
 */
class GetManualJournalRequest extends AbstractMYOBRequest
{
    public string $model = 'ManualJournal';

    /**
     * Set AccountingID from Parameter Bag (UID generic interface)
     * @param $value
     * @return GetManualJournalRequest
     */
    public function setAccountingID($value) {
        return $this->setParameter('accounting_id', $value);
    }

    /**
     * Set Page Value for Pagination from Parameter Bag
     * @param $value
     * @return GetManualJournalRequest
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
     * @return GetManualJournalRequest
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

        $endpoint = 'GeneralLedger/GeneralJournal/';

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
        return $this->response = new GetManualJournalResponse($this, $data);
    }

}