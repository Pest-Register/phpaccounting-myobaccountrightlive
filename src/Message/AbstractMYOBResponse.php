<?php

namespace PHPAccounting\MyobAccountRightLive\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;
use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\ErrorResponseHelper;

/**
 * Created by IntelliJ IDEA.
 * User: Dylan
 * Date: 13/05/2019
 * Time: 3:33 PM
 */

class AbstractMYOBResponse extends AbstractResponse
{

    /**
     * Model type used for abstract parsing of errors and responses
     * @var string
     */
    private string $modelType;

    /**
     * Request id
     *
     * @var string URL
     */
    protected $requestId = null;
    /**
     * @var array
     */
    protected $headers = [];

    public function __construct(RequestInterface $request, $data, $headers = [])
    {
        $this->request = $request;
        if (is_string($data)) {
            $this->data = json_decode($data, true);
        } else {
            $this->data = $data;
        }
        $this->headers = $headers;
        $this->modelType = $request->model;
        parent::__construct($request, $data);
    }

    public function getHeaders(){
        return $this->headers;
    }

    /**
     * Check Response for Error or Success
     * @return boolean
     */
    public function isSuccessful()
    {
        if ($this->data) {
            if (is_string($this->data)) {
                return true;
            } else {
                if (is_object($this->data)) {
                    if (property_exists($this->data, 'Errors')) {
                        return !$this->data->Errors[0]->Severity == 'Error';
                    }
                    if (property_exists($this->data,'Items')) {
                        if (count($this->data->Items) === 0) {
                            return false;
                        }
                    }
                } else {
                    if (array_key_exists('Errors', $this->data)) {
                        return !$this->data['Errors'][0]['Severity'] == 'Error';
                    }
                    if (array_key_exists('Items', $this->data)) {
                        if (count($this->data['Items']) === 0) {
                            return false;
                        }
                    }
                }
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
            if (is_string($this->data)) {
                $additionalDetails = '';
                $errorCode = '';
                $status ='';
                $response = $this->data;
                return ErrorResponseHelper::parseErrorResponse(
                    $response,
                    $status,
                    $errorCode,
                    null,
                    $additionalDetails,
                    $this->modelType
                );
            } else {
                if (is_object($this->data)) {
                    if (property_exists($this->data,'Errors', )) {
                        $additionalDetails = '';
                        $message = '';
                        $errorCode = '';
                        $status ='';
                        if (property_exists($this->data->Errors[0], 'AdditionalDetails',)) {
                            $additionalDetails = $this->data->Errors[0]->AdditionalDetails;
                        }
                        if (property_exists($this->data->Errors[0], 'ErrorCode')) {
                            $errorCode = $this->data->Errors[0]->ErrorCode;
                        }
                        if (property_exists($this->data->Errors[0], 'Severity')) {
                            $status = $this->data->Errors[0]->Severity;
                        }
                        if (property_exists($this->data->Errors[0], 'Message')) {
                            $message = $this->data->Errors[0]->Message;
                        }
                        $response = $message.' '.$additionalDetails;
                        return ErrorResponseHelper::parseErrorResponse(
                            $response,
                            $status,
                            $errorCode,
                            null,
                            $additionalDetails,
                            $this->modelType
                        );
                    } else {
                        if (property_exists($this->data,'Items', )) {
                            if (count($this->data->Items) == 0) {
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
                else if (is_array($this->data)) {
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
                            $this->modelType
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
            }
        }

        return null;
    }
}