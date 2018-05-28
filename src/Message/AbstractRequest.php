<?php

namespace Omnipay\CoinGate\Message;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    protected $liveEndpoint = 'https://api.coingate.com/v2';
    protected $testEndpoint = 'https://api-sandbox.coingate.com/v2';

    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    public function setApiKey($value)
    {
        return $this->setParameter('apiKey', $value);
    }

    public function getReceiveCurrency()
    {
        return $this->getParameter('receiveCurrency');
    }

    public function setReceiveCurrency($value)
    {
        return $this->setParameter('receiveCurrency', $value);
    }

    public function setId($value)
    {
        return $this->setParameter('transactionReference', $value);
    }

    public function getTitle()
    {
        return $this->getParameter('title');
    }

    public function setTitle($value)
    {
        return $this->setParameter('title', $value);
    }

    protected function getHttpMethod()
    {
        return 'POST';
    }

    public function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }

    public function sendData($data)
    {
        $body = $data ? http_build_query($data) : null;

        $httpRequest = $this->httpClient->createRequest($this->getHttpMethod(), $this->getEndpoint(), null, $body);
        $httpRequest->setHeader('Authorization', "Token " . $this->getApiKey());

        if ($this->getHttpMethod() == 'POST') {
            $httpRequest->setHeader('Content-Type', 'application/x-www-form-urlencoded');
        }

        $httpResponse = $httpRequest->send();

        return $this->response = $this->createResponse($httpResponse->json(), $httpResponse->getStatusCode());
    }

    protected function createResponse($data, $statusCode)
    {
        return $this->response = new PurchaseResponse($this, $data, $statusCode);
    }
}
