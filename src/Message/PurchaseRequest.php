<?php

namespace Omnipay\CoinGate\Message;

class PurchaseRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('amount', 'currency');

        $data = array();
        $data['order_id'] = $this->getTransactionId();
        $data['price_amount'] = $this->getAmount();
        $data['price_currency'] = $this->getCurrency();
        $data['receive_currency'] = $this->getReceiveCurrency();
        $data['callback_url'] = $this->getNotifyUrl();
        $data['success_url'] = $this->getReturnUrl();
        $data['cancel_url'] = $this->getCancelUrl();
        $data['title'] = $this->getTitle();
        $data['description'] = $this->getDescription();

        return $data;
    }

    public function getEndpoint()
    {
        return parent::getEndpoint().'/orders';
    }
}
