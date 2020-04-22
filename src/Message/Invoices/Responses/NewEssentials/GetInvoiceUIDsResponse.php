<?php


namespace PHPAccounting\MyobAccountRightLive\Message\Invoices\Responses\NewEssentials;


use Omnipay\Common\Message\AbstractResponse;
use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\IndexSanityCheckHelper;

/**
 * Get Invoice UIDs
 * @package PHPAccounting\MyobAccountRightLive\Message\Invoices\Requests\NewEssentials
 */
class GetInvoiceUIDsResponse extends AbstractResponse
{
    /**
     * Check Response for Error or Success
     * @return boolean
     */
    public function isSuccessful()
    {
        if(array_key_exists('Errors', $this->data)){
            return !$this->data['Errors'][0]['Severity'] == 'Error';
        }
        if (array_key_exists('Items', $this->data)) {
            if (count($this->data['Items']) === 0) {
                return false;
            }
        }
        return true;
    }

    /**
     * Fetch Error Message from Response
     * @return string
     */
    public function getErrorMessage()
    {
        if (array_key_exists('Errors', $this->data)) {
            if ($this->data['Errors'][0]['Message'] === 'The supplied OAuth token (Bearer) is not valid') {
                return 'The access token has expired';
            }
            else {
                return $this->data['Errors'][0]['Message'];
            }
        }
        if (array_key_exists('Items', $this->data)) {
            if (count($this->data['Items']) === 0) {
                return 'NULL Returned from API or End of Pagination';
            }
        }

        return null;
    }

    /**
     * Return all Invoices with Generic Schema Variable Assignment
     * @return array
     */
    public function getInvoiceUIDs(){
        $invoices = [];
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


            array_push($invoices, $newInvoice);
        }

        return $invoices;
    }
    
}