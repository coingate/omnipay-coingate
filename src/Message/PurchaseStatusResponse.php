<?php

namespace Omnipay\CoinGate\Message;

class PurchaseStatusResponse extends PurchaseResponse
{
    public function isSuccessful()
    {
        return !$this->getMessage();
    }

    public function isRedirect()
    {
        return false;
    }

    public function getOrderStatus()
    {
        return $this->data['status'];
    }

    public function isPaid()
    {
        return $this->getOrderStatus() == 'paid';
    }
}
