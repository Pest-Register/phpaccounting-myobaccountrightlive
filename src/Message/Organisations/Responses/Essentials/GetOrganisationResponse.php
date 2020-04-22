<?php
namespace PHPAccounting\MyobAccountRightLive\Message\Organisations\Responses\Essentials;

use Omnipay\Common\Message\AbstractResponse;
use PHPAccounting\MyobAccountRightLive\Helpers\Essentials\ErrorResponseHelper;
use PHPAccounting\MyobAccountRightLive\Helpers\Essentials\IndexSanityCheckHelper;

/**
 * Get Organisation(s) Response
 * @package PHPAccounting\MyobEssentials\Message\Organisations\Responses\Essentials
 */
class GetOrganisationResponse extends AbstractResponse
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
                return ErrorResponseHelper::parseErrorResponse($this->data['errors'][0]['message']);
            }
        } else {
            return 'NULL returned from API';
        }

        return null;
    }

    /**
     * Return all Contacts with Generic Schema Variable Assignment
     * @return array
     */
    public function getOrganisations(){
        $organisations = [];
        foreach ($this->data['items'] as $organisation) {
            $newOrganisation = [];
            $newOrganisation['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('uid', $organisation);
            $newOrganisation['name'] = IndexSanityCheckHelper::indexSanityCheck('name', $organisation);
            $newOrganisation['uri'] = IndexSanityCheckHelper::indexSanityCheck('uri', $organisation);
            $newOrganisation['country_code'] = IndexSanityCheckHelper::indexSanityCheck('country', $organisation);
            $newOrganisation['gst_registered'] = IndexSanityCheckHelper::indexSanityCheck('gstRegistered', $organisation);
            $newOrganisation['access_flag'] = IndexSanityCheckHelper::indexSanityCheck('UIAccessFlags', $organisation);
            array_push($organisations, $newOrganisation);
        }

        return $organisations;
    }
}