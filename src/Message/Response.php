<?php

namespace PHPAccounting\MyobAccountRightLive\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

/**
 * Created by IntelliJ IDEA.
 * User: Dylan
 * Date: 13/05/2019
 * Time: 3:33 PM
 */

class Response extends AbstractResponse
{

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
        $this->data = json_decode($data, true);
        $this->headers = $headers;
        parent::__construct($request, $data);
    }
    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        return $this->data != null;
    }

    public function getHeaders(){
        return $this->headers;
    }
}