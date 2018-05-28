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

        $this->assertSame('10.00', $data['price_amount']);
        $this->assertSame('USD', $data['price_currency']);
        $this->assertSame('Coffee Shop', $data['title']);
        $this->assertSame('3xCoffee', $data['description']);
        $this->assertSame('https://www.example.com/notify', $data['callback_url']);
        $this->assertSame('https://www.example.com/return', $data['success_url']);
        $this->assertSame('https://www.example.com/cancel', $data['cancel_url']);
    }

    public function testSend()
    {
        $this->setMockHttpResponse('PurchaseSuccess.txt');

        $request = $this->request;

        $request->setApiKey('test');

        $response = $request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
    }

    public function testGetEndpoint()
    {
        $this->request->setTestMode(false);
        $this->assertSame('https://api.coingate.com/v2/orders', $this->request->getEndpoint());

        $this->request->setTestMode(true);
        $this->assertSame('https://api-sandbox.coingate.com/v2/orders', $this->request->getEndpoint());
    }
}
