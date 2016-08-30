<?php

namespace Omnipay\CoinGate\Message;

use Omnipay\Tests\TestCase;

class PurchaseRequestTest extends TestCase
{
  public function setUp()
  {
    $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
    $this->request->initialize(
      array(
        'amount' => '10.00',
        'currency' => 'USD',
        'title' => 'Coffee Shop',
        'description' => '3xCoffee',
        'notifyUrl' => 'https://www.example.com/notify',
        'returnUrl' => 'https://www.example.com/return',
        'cancelUrl' => 'https://www.example.com/cancel',
      )
    );
  }

  public function testGetData()
  {
    $data = $this->request->getData();

    $this->assertSame('10.00', $data['price']);
    $this->assertSame('USD', $data['currency']);
    $this->assertSame('Coffee Shop', $data['title']);
    $this->assertSame('3xCoffee', $data['description']);
    $this->assertSame('https://www.example.com/notify', $data['callback_url']);
    $this->assertSame('https://www.example.com/return', $data['success_url']);
    $this->assertSame('https://www.example.com/cancel', $data['cancel_url']);
  }

  public function testSend()
  {
    $this->setMockHttpResponse('PurchaseSuccess.txt');

    $response = $this->request->send();

    $this->assertFalse($response->isSuccessful());
    $this->assertTrue($response->isRedirect());
  }

  public function testGetEndpoint()
  {
    $this->request->setTestMode(false);
    $this->assertSame('https://coingate.com/api/v1/orders', $this->request->getEndpoint());

    $this->request->setTestMode(true);
    $this->assertSame('https://sandbox.coingate.com/api/v1/orders', $this->request->getEndpoint());
  }
}
