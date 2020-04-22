<?php
namespace PHPAccounting\MyobAccountRightLive\Message\Organisations\Responses\AccountRight;

use Omnipay\Common\Message\AbstractResponse;
use PHPAccounting\MyobAccountRightLive\Helpers\AccountRight\IndexSanityCheckHelper;

/**
 * Get Organisation(s) Response
 * @package PHPAccounting\MyobAccountRightLive\Message\Contacts\Responses\AccountRight
 */
class GetOrganisationResponse extends AbstractResponse
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
     * Return all Contacts with Generic Schema Variable Assignment
     * @return array
     */
    public function getOrganisations(){
        $organisations = [];
        foreach ($this->data as $organisation) {
            $newOrganisation = [];
            $newOrganisation['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('Id', $organisation);
            $newOrganisation['name'] = IndexSanityCheckHelper::indexSanityCheck('Name', $organisation);
            $newOrganisation['uri'] = IndexSanityCheckHelper::indexSanityCheck('Uri', $organisation);
            $newOrganisation['country_code'] = IndexSanityCheckHelper::indexSanityCheck('Country', $organisation);
            $newOrganisation['access_flag'] = IndexSanityCheckHelper::indexSanityCheck('UIAccessFlags', $organisation);
            array_push($organisations, $newOrganisation);
        }

        return $organisations;
    }
}