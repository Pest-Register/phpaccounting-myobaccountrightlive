<?php

namespace PHPAccounting\MyobAccountRightLive\Message\ManualJournals\Responses;

use Omnipay\Common\Message\AbstractResponse;
use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\ErrorResponseHelper;
use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\IndexSanityCheckHelper;
use PHPAccounting\MyobAccountRightLive\Message\AbstractMYOBResponse;

/**
 * Get Manual Journal(s) Response
 * @package PHPAccounting\MyobAccountRightLive\Message\Journals\Responses\NewEssentials
 */
class GetManualJournalResponse extends AbstractMYOBResponse
{

    private function parseJournalItems($data, $journal) {
        if ($data) {
            $journalItems = [];
            foreach($data as $journalItem) {
                $newJournalItem = [];
                $newJournalItem['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('RowID', $journalItem);
                $newJournalItem['description'] = IndexSanityCheckHelper::indexSanityCheck('Memo', $journalItem);
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
     * @param $journal
     * @return array
     */
    private function parseData($journal) {
        $newJournal = [];
        $newJournal['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $journal);
        $newJournal['date'] = IndexSanityCheckHelper::indexSanityCheck('DateOccurred', $journal);
        $newJournal['reference_id'] = IndexSanityCheckHelper::indexSanityCheck('DisplayID', $journal);
        $newJournal['narration'] = IndexSanityCheckHelper::indexSanityCheck('Memo', $journal);
        $newJournal['sync_token'] = IndexSanityCheckHelper::indexSanityCheck('RowVersion', $journal);

        if (array_key_exists('Lines', $journal)) {
            if ($journal['Lines']) {
                $newJournal = $this->parseJournalItems($journal['Lines'],$newJournal);
            }
        }

        return $newJournal;
    }

    /**
     * Return all Accounts with Generic Schema Variable Assignment
     * @return array
     */
    public function getManualJournals(){
        $journals = [];
        if (!array_key_exists('Items', $this->data)) {
            $newJournal = $this->parseData($this->data);
            $journals[] = $newJournal;
        } else {
            foreach ($this->data['Items'] as $journal) {
                $newJournal = $this->parseData($journal);
                $journals[] = $newJournal;
            }
        }


        return $journals;
    }
}