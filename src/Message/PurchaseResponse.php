<?php

namespace Omnipay\CoinGate\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    public function isSuccessful()
    {
        return false;
    }

    public function isRedirect()
    {
        return !isset($this->data['reason']);
    }

    public function getRedirectUrl()
    {
        if (isset($this->data['payment_url'])) {
            return $this->data['payment_url'];
        }
    }

    public function getRedirectMethod()
    {
        return 'GET';
    }

    public function getRedirectData()
    {
        return;
    }

    public function getMessage()
    {
        if (isset($this->data['reason'])) {
            return $this->data['reason'].': '.$this->data['message'];
        }
    }

    public function getTransactionReference()
    {
        if (isset($this->data['id'])) {
            return $this->data['id'];
        }
    }
}
