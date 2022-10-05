<?php
namespace PHPAccounting\MyobAccountRightLive\Message\CurrentUser\Responses;

use Omnipay\Common\Message\AbstractResponse;
use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\ErrorResponseHelper;

/**
 * Get Contact(s) Response
 * @package PHPAccounting\MyobAccountRightLive\Message\Contacts\Responses\AccountRight
 */
class GetCurrentUserResponse extends AbstractResponse
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
     * @return array
     */
    public function getErrorMessage()
    {
        if ($this->data) {
            if (array_key_exists('Errors', $this->data)) {
                $additionalDetails = '';
                $message = '';
                $errorCode = '';
                $status ='';
                if (array_key_exists('AdditionalDetails', $this->data['Errors'][0])) {
                    $additionalDetails = $this->data['Errors'][0]['AdditionalDetails'];
                }
                if (array_key_exists('ErrorCode', $this->data['Errors'][0])) {
                    $errorCode = $this->data['Errors'][0]['ErrorCode'];
                }
                if (array_key_exists('Severity', $this->data['Errors'][0])) {
                    $status = $this->data['Errors'][0]['Severity'];
                }
                if (array_key_exists('Message', $this->data['Errors'][0])) {
                    $message = $this->data['Errors'][0]['Message'];
                }
                $response = $message.' '.$additionalDetails;
                return ErrorResponseHelper::parseErrorResponse(
                    $response,
                    $status,
                    $errorCode,
                    null,
                    $additionalDetails,
                    'CurrentUser'
                );
            } else {
                if (array_key_exists('Items', $this->data)) {
                    if (count($this->data['Items']) == 0) {
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
     * Return all Contacts with Generic Schema Variable Assignment
     * @return array
     */
    public function getCurrentUser(){
        return $this->data;
    }
}