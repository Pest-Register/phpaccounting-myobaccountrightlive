<?php


namespace PHPAccounting\MyobAccountRightLive\Message\ManualJournals\Responses\Essentials;


use Omnipay\Common\Message\AbstractResponse;
use PHPAccounting\MyobAccountRightLive\Helpers\Essentials\ErrorResponseHelper;
use PHPAccounting\MyobAccountRightLive\Helpers\Essentials\IndexSanityCheckHelper;

/**
 * Get Manual Journal(s) Response
 * @package PHPAccounting\MyobAccountRightLive\Message\Journals\Responses\Essentials
 */
class CreateManualJournalResponse extends AbstractResponse
{

    /**
     * Check Response for Error or Success
     * @return boolean
     */
    public function isSuccessful()
    {
        if ($this->data) {
            if(array_key_exists('errors', $this->data)){
                return false;
            }
        } else {
            return false;
        }
        return true;
    }

    /**
     * Fetch Error Message from Response
     * @return string
     */
    public function getErrorMessage()
    {
        if ($this->data) {
            if (array_key_exists('errors', $this->data)) {
                return ErrorResponseHelper::parseErrorResponse($this->data['errors'][0]['message'], 'Manual Journal');
            }
        } else {
            return 'NULL returned from API';
        }

        return null;
    }

    private function parseJournalItems($data, $journal) {
        if ($data) {
            $journalItems = [];
            foreach($data as $journalItem) {
                $newJournalItem = [];
                if (array_key_exists('account', $journalItem)) {
                    $newJournalItem['account_id'] = $journalItem['account']['uid'];
                }

                if (array_key_exists('taxType', $journalItem)) {
                    $newJournalItem['tax_type_id'] = $journalItem['taxType']['uid'];
                }
                $newJournalItem['credit'] = IndexSanityCheckHelper::indexSanityCheck('credit', $journalItem);
                $newJournalItem['description'] = IndexSanityCheckHelper::indexSanityCheck('description', $journalItem);
                $newJournalItem['gross_amount'] = IndexSanityCheckHelper::indexSanityCheck('amount', $journalItem);
                $newJournalItem['tax_amount'] = IndexSanityCheckHelper::indexSanityCheck('taxAmount', $journalItem);
                $newJournalItem['is_credit'] = IndexSanityCheckHelper::indexSanityCheck('credit', $journalItem);

                if (array_key_exists('tax_amount', $journalItem)) {
                    $newJournalItem['net_amount'] = (float) $journalItem['amount'] + (float) $journalItem['taxAmount'];
                } else {
                    $newJournalItem['net_amount'] = (float) $journalItem['amount'];
                }
                array_push($journalItems, $newJournalItem);
            }

            $journal['journal_data'] = $journalItems;
        }
        return $journal;
    }
    /**
     * Return all Invoices with Generic Schema Variable Assignment
     * @return array
     */
    public function getManualJournals(){
        $journals = [];

        foreach($this->data['items'] as $journal) {
            $newJournal = [];
            $newJournal['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('uid', $journal);;
            $newJournal['date'] = IndexSanityCheckHelper::indexSanityCheck('transactionDate', $journal);
            $newJournal['narration'] = IndexSanityCheckHelper::indexSanityCheck('notes', $journal);
            $newJournal['gst'] = IndexSanityCheckHelper::indexSanityCheck('gstInclusive', $journal);
            if (array_key_exists('journalEntries', $journal)) {
                $newJournal = $this->parseJournalItems($journal['journalEntries'], $newJournal);
            }


            array_push($journals, $newJournal);

        }

        return $journals;
    }

}