<?php


namespace PHPAccounting\MyobAccountRightLive\Message\ManualJournals\Requests\Essentials;


use Carbon\Carbon;
use PHPAccounting\MyobAccountRightLive\Helpers\Essentials\BuildEndpointHelper;
use PHPAccounting\MyobAccountRightLive\Helpers\Essentials\IndexSanityCheckHelper;
use PHPAccounting\MyobAccountRightLive\Message\AbstractRequest;
use PHPAccounting\MyobAccountRightLive\Message\Accounts\Requests\Essentials\GetAccountRequest;
use PHPAccounting\MyobAccountRightLive\Message\Journals\Responses\Essentials\GetJournalResponse;
use PHPAccounting\MyobAccountRightLive\Message\ManualJournals\Responses\Essentials\CreateManualJournalResponse;

/**
 * Get Manual Journal(s)
 * @package PHPAccounting\MyobAccountRightLive\Message\Journals\Requests\Essentials
 */
class CreateManualJournalRequest extends AbstractRequest
{
    /**
     * Get Reference ID Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/generalledger/journal-entries/
     * @return mixed
     */
    public function getReferenceID(){
        return $this->getParameter('reference_id');
    }

    /**
     * Set Reference ID Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/generalledger/journal-entries/
     * @param string $value Status
     * @return CreateManualJournalRequest
     */
    public function setReferenceID($value){
        return $this->setParameter('reference_id', $value);
    }

    /**
     * Get GST Inclusive Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/generalledger/journal-entries/
     * @return mixed
     */
    public function getGSTInclusive(){
        return $this->getParameter('gst_inclusive');
    }

    /**
     * Set GST Inclusive Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/generalledger/journal-entries/
     * @param string $value Status
     * @return CreateManualJournalRequest
     */
    public function setGSTInclusive($value){
        return $this->setParameter('gst_inclusive', $value);
    }

    /**
     * Get Narration Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/generalledger/journal-entries/
     * @return mixed
     */
    public function getNarration(){
        return $this->getParameter('narration');
    }

    /**
     * Set Narration Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/generalledger/journal-entries/
     * @param string $value Status
     * @return CreateManualJournalRequest
     */
    public function setNarration($value){
        return $this->setParameter('narration', $value);
    }

    /**
     * Get Journal Data Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/generalledger/journal-entries/
     * @return mixed
     */
    public function getJournalData(){
        return $this->getParameter('journal_data');
    }

    /**
     * Set Journal Data Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/generalledger/journal-entries/
     * @param string $value Status
     * @return CreateManualJournalRequest
     */
    public function setJournalData($value){
        return $this->setParameter('journal_data', $value);
    }

    /**
     * Get Status Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/generalledger/journal-entries/
     * @return mixed
     */
    public function getStatus(){
        return $this->getParameter('status');
    }

    /**
     * Set Status Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/generalledger/journal-entries/
     * @param string $value Status
     * @return CreateManualJournalRequest
     */
    public function setStatus($value){
        return $this->setParameter('status', $value);
    }

    /**
     * Get Date Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/generalledger/journal-entries/
     * @return mixed
     */
    public function getDate(){
        return $this->getParameter('date');
    }

    /**
     * Set Date Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/generalledger/journal-entries/
     * @param string $value Date
     * @return CreateManualJournalRequest
     */
    public function setDate($value){
        return $this->setParameter('date', $value);
    }

    private function parseJournalLines($data, $journal) {
        $journal['journalEntries'] = [];
        foreach($data as $journalLine) {
            $newJournalLine = [];
            $newJournalLine['account'] = [];
            $newJournalLine['taxType'] = [];
            $newJournalLine['account']['uid'] = IndexSanityCheckHelper::indexSanityCheck('account_id', $journalLine);
            $newJournalLine['taxType']['uid'] = IndexSanityCheckHelper::indexSanityCheck('tax_type_id', $journalLine);
            $newJournalLine['description'] = IndexSanityCheckHelper::indexSanityCheck('description', $journalLine);
            $newJournalLine['amount'] = IndexSanityCheckHelper::indexSanityCheck('gross_amount', $journalLine);
            $newJournalLine['taxAmount'] = IndexSanityCheckHelper::indexSanityCheck('tax_amount', $journalLine);
            $newJournalLine['credit'] = IndexSanityCheckHelper::indexSanityCheck('is_credit', $journalLine);
            array_push($journal['journalEntries'], $newJournalLine);
        }

        return $journal;
    }
    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('narration', 'journal_data');

        $this->issetParam('notes', 'narration');
        $this->issetParam('gstInclusive', 'gst_inclusive');
        $this->issetParam('reference', 'reference_id');
        if($this->getDate() !== null) {
            $this->data['transactionDate'] = $this->getDate().'T00:00:00';
        }
        if($this->getJournalData() !== null) {
            $this->data = $this->parseJournalLines($this->getJournalData(), $this->data);
        }

        return $this->data;
    }



    public function getEndpoint()
    {

        $endpoint = 'generalledger/journalentries';

        return $endpoint;
    }

    public function getHttpMethod()
    {
        return 'POST';
    }

    protected function createResponse($data, $headers = [])
    {
        return $this->response = new CreateManualJournalResponse($this, $data);
    }
}