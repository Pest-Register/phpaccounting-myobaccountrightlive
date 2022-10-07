<?php


namespace PHPAccounting\MyobAccountRightLive\Message\Quotations\Responses;

use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\IndexSanityCheckHelper;
use PHPAccounting\MyobAccountRightLive\Message\AbstractMYOBResponse;

class GetQuotationUIDsResponse extends AbstractMYOBResponse
{

    /**
     * Return all Invoices with Generic Schema Variable Assignment
     * @return array
     */
    public function getQuotationUIDs(){
        $quotes = [];
        if ($this->data && !is_string($this->data)) {
            foreach ($this->data['Items'] as $quote) {
                $newQuote = [];
                $newQuote['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $quote);
                $newQuote['URI'] = IndexSanityCheckHelper::indexSanityCheck('URI', $quote);
                if (array_key_exists('URI', $quote)) {
                    $splitURI = explode('/', $quote['URI']);
                    array_pop($splitURI);
                    $newQuote['URI'] = implode('/', $splitURI);
                    $newQuote['URI'] = strstr($newQuote['URI'], '/Sale');
                }

                $quotes[] = $newQuote;
            }
        }

        return $quotes;
    }
}