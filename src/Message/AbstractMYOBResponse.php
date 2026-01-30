<?php

namespace PHPAccounting\MyobAccountRightLive\Message;

use PHPAccounting\MyobAccountRightLive\Foundation\AbstractResponse;
use PHPAccounting\MyobAccountRightLive\Foundation\Contracts\RequestInterface;
use PHPAccounting\MyobAccountRightLive\Helpers\Current\ErrorResponseHelper;

class AbstractMYOBResponse extends AbstractResponse
{

    /**
     * Model type used for abstract parsing of errors and responses
     * @var string
     */
    private string $modelType;

    /**
     * HTTP status code from response
     * @var int|null
     */
    protected ?int $httpStatusCode = null;

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

    public function __construct(RequestInterface $request, $data, $headers = [], ?int $statusCode = null)
    {
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
        parent::__construct($request, $data);
        $this->headers = $headers;
        $this->httpStatusCode = $statusCode;
        $this->modelType = $request->model ?? '';
    }

    /**
     * Get the HTTP status code
     */
    public function getHttpStatusCode(): ?int
    {
        return $this->httpStatusCode;
    }

    public function getHeaders(){
        return $this->headers;
    }

    /**
     * Check Response for Error or Success
     * @return boolean
     */
    public function isSuccessful(): bool
    {
        // Check HTTP status code first (if available)
        if ($this->httpStatusCode !== null && ($this->httpStatusCode < 200 || $this->httpStatusCode >= 300)) {
            return false;
        }

        if ($this->data) {
            if (is_string($this->data)) {
                // String data could be an error message - check if it looks like JSON error
                $decoded = json_decode($this->data, true);
                if ($decoded && isset($decoded['Errors'])) {
                    return false;
                }
                return true;
            } else {
                if (is_object($this->data)) {
                    if (property_exists($this->data, 'Errors') && !empty($this->data->Errors)) {
                        $firstError = $this->data->Errors[0] ?? null;
                        if ($firstError && property_exists($firstError, 'Severity')) {
                            return $firstError->Severity !== 'Error';
                        }
                        return false; // Has errors but can't determine severity
                    }
                    if (property_exists($this->data,'Items')) {
                        if (count($this->data->Items) === 0) {
                            return false;
                        }
                    }
                } else {
                    if (array_key_exists('Errors', $this->data) && !empty($this->data['Errors'])) {
                        $firstError = $this->data['Errors'][0] ?? null;
                        if ($firstError && isset($firstError['Severity'])) {
                            return $firstError['Severity'] !== 'Error';
                        }
                        return false; // Has errors but can't determine severity
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
