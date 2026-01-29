<?php

namespace PHPAccounting\MyobAccountRightLive\Foundation;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use PHPAccounting\MyobAccountRightLive\Foundation\Contracts\RequestInterface;
use PHPAccounting\MyobAccountRightLive\Foundation\Traits\ParametersTrait;

abstract class AbstractGateway
{
    use ParametersTrait;

    protected ?ClientInterface $httpClient = null;

    public function __construct(?ClientInterface $httpClient = null)
    {
        $this->httpClient = $httpClient;
        $this->initialize();
    }

    abstract public function getName(): string;

    public function getHttpClient(): ClientInterface
    {
        if ($this->httpClient === null) {
            $this->httpClient = new Client([
                'timeout' => 60,
                'http_errors' => false,
            ]);
        }
        return $this->httpClient;
    }

    public function setHttpClient(ClientInterface $httpClient): static
    {
        $this->httpClient = $httpClient;
        return $this;
    }

    protected function createRequest(string $class, array $parameters = []): RequestInterface
    {
        $request = new $class($this->getHttpClient());

        // Merge gateway parameters with request-specific parameters
        $allParameters = array_merge($this->getParameters(), $parameters);
        $request->initialize($allParameters);

        return $request;
    }
}
