<?php

namespace PHPAccounting\MyobAccountRightLive\Foundation;

use PHPAccounting\MyobAccountRightLive\Foundation\Contracts\RequestInterface;
use PHPAccounting\MyobAccountRightLive\Foundation\Contracts\ResponseInterface;

abstract class AbstractResponse implements ResponseInterface
{
    protected RequestInterface $request;
    protected mixed $data;

    public function __construct(RequestInterface $request, $data)
    {
        $this->request = $request;
        $this->data = $data;
    }

    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    public function getData()
    {
        return $this->data;
    }

    abstract public function isSuccessful(): bool;
}
