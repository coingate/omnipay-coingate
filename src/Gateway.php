<?php

namespace Omnipay\CoinGate;

use Omnipay\Common\AbstractGateway;

/**
 * CoinGate Gateway.
 *
 * @link https://developer.coingate.com/
 */

class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'CoinGate';
    }

    public function getDefaultParameters()
    {
        return array(
            'apiKey' => '',
            'receiveCurrency' => 'EUR',
            'testMode' => false,
        );
    }

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

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\CoinGate\Message\PurchaseRequest', $parameters);
    }

    public function getPurchaseStatus(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\CoinGate\Message\PurchaseStatusRequest', $parameters);
    }
}
