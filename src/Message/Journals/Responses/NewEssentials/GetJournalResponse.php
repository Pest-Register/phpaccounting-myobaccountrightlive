<?php

namespace PHPAccounting\MyobAccountRightLive\Message\Journals\Responses\NewEssentials;

use Omnipay\Common\Message\AbstractResponse;
use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\ErrorResponseHelper;
use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\IndexSanityCheckHelper;

/**
 * Get Journal(s) Response
 * @package PHPAccounting\MyobAccountRightLive\Message\Journals\Responses\NewEssentials
 */
class GetJournalResponse extends AbstractResponse
{

    /**
     * Check Response for Error or Success
     * @return boolean
     */
    public function isSuccessful()
    {
        if ($this->data) {
            if(array_key_exists('Errors', $this->data)){
                return !$this->data['Errors'][0]['Severity'] == 'Error';
            }
            if (array_key_exists('Items', $this->data)) {
                if (count($this->data['Items']) === 0) {
                    return false;
                }
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
            if (array_key_exists('Errors', $this->data)) {
                $additionalDetails = '';
                $message = '';
                if (array_key_exists('AdditionalDetails', $this->data['Errors'][0])) {
                    $additionalDetails = $this->data['Errors'][0]['AdditionalDetails'];
                }
                if (array_key_exists('Message', $this->data['Errors'][0])) {
                    $message = $this->data['Errors'][0]['Message'];
                }
                return ErrorResponseHelper::parseErrorResponse($message.' '.$additionalDetails, 'Journal');
            } else {
                if (array_key_exists('Items', $this->data)) {
                    if (count($this->data['Items']) == 0) {
                        return 'NULL Returned from API or End of Pagination';
                    }
                }
            }
        }

        return null;
    }

    private function parseJournalItems($data, $journal) {
        if ($data) {
            $journalItems = [];
            foreach($data as $journalItem) {
                $newJournalItem = [];
                $newJournalItem['tax_amount'] = 0;
                $newJournalItem['gross_amount'] = 0;
                $newJournalItem['net_amount'] = 0;
                $newJournalItem['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('RowID', $journalItem);
                $newJournalItem['is_credit'] = IndexSanityCheckHelper::indexSanityCheck('IsCredit', $journalItem);
                if (array_key_exists('Account', $journalItem)) {
                    $newJournalItem['account_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $journalItem['Account']);
                    $newJournalItem['account_code'] = IndexSanityCheckHelper::indexSanityCheck('DisplayID', $journalItem['Account']);
                    $newJournalItem['account_name'] = IndexSanityCheckHelper::indexSanityCheck('Name', $journalItem['Account']);
                }

                if (array_key_exists('TaxCode', $journalItem)) {
                    $newJournalItem['tax_type'] = IndexSanityCheckHelper::indexSanityCheck('Code', $journalItem['TaxCode']);
                }
                $newJournalItem['tax_amount'] = IndexSanityCheckHelper::indexSanityCheck('TaxAmount', $journalItem);
                $newJournalItem['gross_amount'] = IndexSanityCheckHelper::indexSanityCheck('Amount', $journalItem);
                if (array_key_exists('tax_amount', $journalItem)) {
                    $newJournalItem['net_amount'] = (float) $newJournalItem['tax_amount'] + (float) $newJournalItem['gross_amount'];
                } else {
                    $newJournalItem['net_amount'] = (float) $newJournalItem['gross_amount'];
                }

                array_push($journalItems, $newJournalItem);
            }

            $journal['journal_data'] = $journalItems;
        }
        return $journal;
    }

    /**
     * Return all Accounts with Generic Schema Variable Assignment
     * @return array
     */
    public function getJournals(){
        $journals = [];
        if (!array_key_exists('Items', $this->data)) {
            $journal = $this->data;
            $newJournal = [];
            $newJournal['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $journal);
            $newJournal['date'] = IndexSanityCheckHelper::indexSanityCheck('DateOccurred', $journal);
            $newJournal['reference_id'] = IndexSanityCheckHelper::indexSanityCheck('DisplayID', $journal);
            $newJournal['sync_token'] = IndexSanityCheckHelper::indexSanityCheck('RowVersion', $journal);

            if (array_key_exists('SourceTransaction', $journal)) {
                if ($journal['SourceTransaction']) {
                    $newJournal['source_type'] = IndexSanityCheckHelper::indexSanityCheck('TransactionType', $journal['SourceTransaction']);
                    $newJournal['source_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $journal['SourceTransaction']);
                }

            }

            if (array_key_exists('Lines', $journal)) {
                if ($journal['Lines']) {
                    $newJournal = $this->parseJournalItems($journal['Lines'],$newJournal);
                }
            }
            array_push($journals, $newJournal);
        } else {
            foreach ($this->data['Items'] as $journal) {
                $newJournal = [];
                $newJournal['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $journal);
                $newJournal['date'] = IndexSanityCheckHelper::indexSanityCheck('DateOccurred', $journal);
                $newJournal['reference_id'] = IndexSanityCheckHelper::indexSanityCheck('DisplayID', $journal);
                $newJournal['sync_token'] = IndexSanityCheckHelper::indexSanityCheck('RowVersion', $journal);

                if (array_key_exists('SourceTransaction', $journal)) {
                    if ($journal['SourceTransaction']) {
                        $newJournal['source_type'] = IndexSanityCheckHelper::indexSanityCheck('TransactionType', $journal['SourceTransaction']);
                        $newJournal['source_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $journal['SourceTransaction']);
                    }

                }

                if (array_key_exists('Lines', $journal)) {
                    if ($journal['Lines']) {
                        $newJournal = $this->parseJournalItems($journal['Lines'],$newJournal);
                    }
                }
                array_push($journals, $newJournal);
            }
        }


        return $journals;
    }
}