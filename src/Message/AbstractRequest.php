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
        $body = $data ? json_encode($data) : null;
    
        $headers = [];
        $headers ['Authorization'] = "Token " . $this->getApiKey();

        if ($this->getHttpMethod() == 'POST') {
            $headers['Content-Type'] = 'application/json';
        }

        $httpresponse = $this->httpClient->request($this->getHttpMethod(), $this->getEndpoint(), $headers, $body);

        return $this->response = $this->createResponse(json_decode($httpresponse->getBody()->getContents(), true), $httpresponse->getStatusCode());  
    }

    protected function createResponse($data, $statusCode)
    {
        return $this->response = new PurchaseResponse($this, $data, $statusCode);
    }
}
