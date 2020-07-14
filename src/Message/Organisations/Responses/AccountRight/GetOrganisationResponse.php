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
        if ($this->data) {
            if(array_key_exists('Errors', $this->data)){
                return !$this->data['Errors'][0]['Severity'] == 'Error';
            }
            elseif (array_key_exists('errors', $this->data)) {
                return false;
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
     * @return array
     */
    public function getErrorMessage()
    {
        if ($this->data) {
            if (array_key_exists('Errors', $this->data)) {
                return \PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\ErrorResponseHelper::parseErrorResponse($this->data['Errors'][0]['Message'], 'Invoice');
            }
            elseif(array_key_exists('errors', $this->data)) {
                return \PHPAccounting\MyobAccountRightLive\Helpers\Essentials\ErrorResponseHelper::parseErrorResponse($this->data['errors'][0]['message']);
            } else {
                if (array_key_exists('Items', $this->data)) {
                    if (count($this->data['Items']) == 0) {
                        return ['message' => 'NULL Returned from API or End of Pagination'];
                    }
                } else {
                    return 'NULL returned from API';
                }
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
        if (array_key_exists('items', $this->data)) {
            foreach ($this->data['items'] as $organisation) {
                $newOrganisation = [];
                $newOrganisation['accounting_id'] = \PHPAccounting\MyobAccountRightLive\Helpers\Essentials\IndexSanityCheckHelper::indexSanityCheck('uid', $organisation);
                $newOrganisation['name'] = \PHPAccounting\MyobAccountRightLive\Helpers\Essentials\IndexSanityCheckHelper::indexSanityCheck('name', $organisation);
                $newOrganisation['uri'] = \PHPAccounting\MyobAccountRightLive\Helpers\Essentials\IndexSanityCheckHelper::indexSanityCheck('uri', $organisation);
                $newOrganisation['country_code'] = \PHPAccounting\MyobAccountRightLive\Helpers\Essentials\IndexSanityCheckHelper::indexSanityCheck('country', $organisation);
                $newOrganisation['gst_registered'] = \PHPAccounting\MyobAccountRightLive\Helpers\Essentials\IndexSanityCheckHelper::indexSanityCheck('gstRegistered', $organisation);
                $newOrganisation['access_flag'] = 'old_essentials';
                array_push($organisations, $newOrganisation);
            }
        } else {
            foreach ($this->data as $organisation) {
                $newOrganisation = [];
                $newOrganisation['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('Id', $organisation);
                $newOrganisation['name'] = IndexSanityCheckHelper::indexSanityCheck('Name', $organisation);
                $newOrganisation['uri'] = IndexSanityCheckHelper::indexSanityCheck('Uri', $organisation);
                $newOrganisation['country_code'] = IndexSanityCheckHelper::indexSanityCheck('Country', $organisation);
                $newOrganisation['gst_registered'] = true;
                $newOrganisation['access_flag'] = IndexSanityCheckHelper::indexSanityCheck('UIAccessFlags', $organisation);
                array_push($organisations, $newOrganisation);
            }
        }


        return $organisations;
    }
}