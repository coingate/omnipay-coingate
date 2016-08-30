<?php

namespace Omnipay\CoinGate\Message;

class PurchaseStatusRequest extends PurchaseRequest
{
    public function getData()
    {
        $this->validate('transactionReference');
    }

    public function getEndpoint()
    {
        return parent::getEndpoint().'/'.$this->getTransactionReference();
    }

    protected function getHttpMethod()
    {
        return 'GET';
    }

    protected function createResponse($data, $statusCode)
    {
        return $this->response = new PurchaseStatusResponse($this, $data, $statusCode);
    }
}
