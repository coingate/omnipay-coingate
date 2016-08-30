<?php

namespace Omnipay\CoinGate;

use Omnipay\Common\AbstractGateway;

class Gateway extends AbstractGateway
{
  public function getName()
  {
    return 'CoinGate';
  }

  public function getDefaultParameters()
  {
    return array(
      'appId' => '',
      'apiKey' => '',
      'apiSecret' => '',
      'receiveCurrency' => 'EUR',
      'testMode' => false
    );
  }

  public function getAppId() {
    return $this->getParameter('appId');
  }

  public function setAppId($value)
  {
    return $this->setParameter('appId', $value);
  }

  public function getApiKey() {
    return $this->getParameter('apiKey');
  }

  public function setApiKey($value)
  {
    return $this->setParameter('apiKey', $value);
  }

  public function getApiSecret() {
    return $this->getParameter('apiSecret');
  }

  public function setApiSecret($value)
  {
    return $this->setParameter('apiSecret', $value);
  }

  public function getReceiveCurrency() {
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
