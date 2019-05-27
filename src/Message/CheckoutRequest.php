<?php

namespace Omnipay\CoinGate\Message;

class CheckoutRequest extends AbstractRequest
{
    public function getData()
    {
        $data = array();
        $data['pay_currency'] = $this->getPayCurrency();

        return $data;
    }

    public function getEndpoint()
    {
        $id = $this->getId();
        return parent::getEndpoint().'/orders/'.$id.'/checkout';
    }
}
