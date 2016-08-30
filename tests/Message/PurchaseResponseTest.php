<?php

namespace Omnipay\CoinGate\Message;

use Omnipay\Tests\TestCase;

class PurchaseResponseTest extends TestCase
{
    public function testPurchaseSuccess()
    {
        $httpResponse = $this->getMockHttpResponse('PurchaseSuccess.txt');
        $response = new PurchaseResponse($this->getMockRequest(), $httpResponse->json());

        $this->assertFalse($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
        $this->assertNull($response->getMessage());
        $this->assertSame('855', $response->getTransactionReference());
        $this->assertSame('https://sandbox.coingate.com/invoice/9ec86b7c-842f-4abe-87cc-7d62d308d0ba', $response->getRedirectUrl());
        $this->assertSame('GET', $response->getRedirectMethod());
        $this->assertNull($response->getRedirectData());
    }

    public function testPurchaseFailure()
    {
        $httpResponse = $this->getMockHttpResponse('PurchaseFailure.txt');
        $response = new PurchaseResponse($this->getMockRequest(), $httpResponse->json());

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('OrderIsNotValid: Order is not valid', $response->getMessage());
        $this->assertNull($response->getTransactionReference());
        $this->assertNull($response->getRedirectUrl());
        $this->assertNull($response->getRedirectData());
    }
}
