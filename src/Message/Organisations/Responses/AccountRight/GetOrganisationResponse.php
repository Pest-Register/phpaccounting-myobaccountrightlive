<?php
namespace PHPAccounting\MyobAccountRightLive\Message\Organisations\Responses\AccountRight;

use Omnipay\Common\Message\AbstractResponse;
use PHPAccounting\MyobAccountRightLive\Helpers\AccountRight\IndexSanityCheckHelper;
use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\ErrorResponseHelper;

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

    public function getNewEssentialsErrorMessage($data)
    {
        if ($data) {
            if (array_key_exists('Errors', $data)) {
                $additionalDetails = '';
                $message = '';
                $errorCode = '';
                $status ='';
                if (array_key_exists('AdditionalDetails', $data['Errors'][0])) {
                    $additionalDetails = $data['Errors'][0]['AdditionalDetails'];
                }
                if (array_key_exists('ErrorCode', $data['Errors'][0])) {
                    $errorCode = $data['Errors'][0]['ErrorCode'];
                }
                if (array_key_exists('Severity', $data['Errors'][0])) {
                    $status = $data['Errors'][0]['Severity'];
                }
                if (array_key_exists('Message', $data['Errors'][0])) {
                    $message = $data['Errors'][0]['Message'];
                }
                $response = $message.' '.$additionalDetails;
                return ErrorResponseHelper::parseErrorResponse(
                    $response,
                    $status,
                    $errorCode,
                    null,
                    $additionalDetails,
                    'Account'
                );
            } else {
                if (array_key_exists('Items', $data)) {
                    if (count($data['Items']) == 0) {
                        return [
                            'message' => 'NULL Returned from API or End of Pagination',
                            'exception' =>'NULL Returned from API or End of Pagination',
                            'error_code' => null,
                            'status_code' => null,
                            'detail' => null
                        ];
                    }
                }
            }
        }

        return null;
    }

    /**
     * Fetch Error Message from Response
     * @return array
     */
    public function getErrorMessage()
    {
        if ($this->data) {
            if (array_key_exists('Errors', $this->data)) {
                return $this->getNewEssentialsErrorMessage($this->data);
            }
            elseif(array_key_exists('errors', $this->data)) {
                return \PHPAccounting\MyobAccountRightLive\Helpers\Essentials\ErrorResponseHelper::parseErrorResponse($this->data['errors'][0]['message']);
            } else {
                if (array_key_exists('Items', $this->data)) {
                    if (count($this->data['Items']) == 0) {
                        return ['message' => 'NULL Returned from API or End of Pagination'];
                    }
                } else {
                    return ['message' => 'NULL Returned from API or End of Pagination'];
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