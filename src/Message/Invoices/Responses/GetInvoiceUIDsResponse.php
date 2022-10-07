<?php


namespace PHPAccounting\MyobAccountRightLive\Message\Invoices\Responses;

use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\IndexSanityCheckHelper;
use PHPAccounting\MyobAccountRightLive\Message\AbstractMYOBResponse;

/**
 * Get Invoice UIDs
 * @package PHPAccounting\MyobAccountRightLive\Message\Invoices\Requests\NewEssentials
 */
class GetInvoiceUIDsResponse extends AbstractMYOBResponse
{

    /**
     * Return all Invoices with Generic Schema Variable Assignment
     * @return array
     */
    public function getInvoiceUIDs(){
        $invoices = [];
        if ($this->data && !is_string($this->data)) {
            foreach ($this->data['Items'] as $invoice) {
                $newInvoice = [];
                $newInvoice['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $invoice);
                $newInvoice['URI'] = IndexSanityCheckHelper::indexSanityCheck('URI', $invoice);
                if (array_key_exists('URI', $invoice)) {
                    $splitURI = explode('/', $invoice['URI']);
                    array_pop($splitURI);
                    $newInvoice['URI'] = implode('/', $splitURI);
                    $newInvoice['URI'] = strstr($newInvoice['URI'], '/Sale');
                }


                $invoices[] = $newInvoice;
            }
        }

        return $invoices;
    }
    
}