<?php

use Sisow\API\Client;
use Sisow\API\Method\DirectoryRequest;
use Sisow\API\Method\StatusRequest;
use Sisow\API\Method\TransactionRequest;
use Sisow\API\Payment\Ebill;
use Sisow\API\Payment\Ideal;
use Sisow\API\Payment\Maestro;
use Sisow\API\Payment\Mastercard;
use Sisow\API\Payment\MisterCash;
use Sisow\API\Payment\PaypalExpressCheckout;
use Sisow\API\Payment\SofortBanking;
use Sisow\API\Payment\Visa;
use Sisow\API\Payment\WebshopGiftcard;
use Sisow\API\Payment\WireTransfer;
use Sisow\API\Result\DirectoryRequest\IssuerResult;

class PaymentRequestTest extends \PHPUnit_Framework_TestCase
{
    const MERCHANT_ID = 2537762231;
    const MERCHANT_KEY = '2c826600554c4cd9fe946b7424cf4cfe71522366';

    /** @var Client */
    private $client;

    public function setUp()
    {
        $this->client = new Client(self::MERCHANT_ID, self::MERCHANT_KEY);
        $this->client->setEnviroment(Client::ENVIRONMENT_TESTING);
    }

    public function testEbillPayment()
    {
        $payment = new Ebill();
        $payment->setPurchaseId(uniqid());
        $payment->setEntranceCode(uniqid());
        $payment->setAmount(100);
        $payment->setDescription(uniqid('phpunit-', true));

        // Ebill specific settings
        $payment->setMail('user@domain.tld');
        $this->assertEquals('user@domain.tld', $payment->getMail());
        $payment->setIncluding(false);
        $this->assertEquals(false, $payment->getIncluding());
        $payment->setDays(14);
        $this->assertEquals(14, $payment->getDays());

        $transactionRequest = new TransactionRequest($this->client, $payment);
        $requestResult = $transactionRequest->execute();
        $this->assertNotEmpty($requestResult->getTransactionId());
        $this->assertNotEmpty($requestResult->getIssuerUrl());
        $this->assertNotEmpty($requestResult->getDocumentId());
        $this->assertNotEmpty($requestResult->getDocumentUrl());

        $statusRequest = new StatusRequest($this->client, $requestResult->getTransactionId());
        $statusResult = $statusRequest->execute();
        $this->assertEquals('Pending', $statusResult->getStatus());
    }

    public function testIdealPayment()
    {
        $payment = new Ideal();
        $payment->setPurchaseId(uniqid());
        $payment->setEntranceCode(uniqid());
        $payment->setAmount(100);
        $payment->setDescription(uniqid('phpunit-', true));

        // Ideal specific methods
        $directoryResult = $payment->getAvailableIssuers($this->client);
        $issuers = $directoryResult->getIssuers();
        $this->assertEquals(1, count($issuers));

        $directoryRequest = new DirectoryRequest($this->client);
        $this->assertEquals($directoryRequest->execute(), $directoryResult);

        /** @var IssuerResult $issuer */
        $issuer = reset($issuers);
        $this->assertEquals(99, $issuer->getIssuerId());
        $this->assertEquals('Sisow Bank (test)', $issuer->getIssuerName());

        // Ideal specific settings
        $payment->setIssuerId($issuer->getIssuerId());

        $transactionRequest = new TransactionRequest($this->client, $payment);
        $requestResult = $transactionRequest->execute();
        $this->assertNotEmpty($requestResult->getTransactionId());
        $this->assertNotEmpty($requestResult->getIssuerUrl());

        $statusRequest = new StatusRequest($this->client, $requestResult->getTransactionId());
        $statusResult = $statusRequest->execute();
        $this->assertEquals('Open', $statusResult->getStatus());
    }

    public function testKlarnaAccount()
    {

    }

    public function testKlarnaInvoice()
    {

    }

    public function testMaestro()
    {
        $payment = new Maestro();
        $payment->setPurchaseId(uniqid());
        $payment->setEntranceCode(uniqid());
        $payment->setAmount(100);
        $payment->setDescription(uniqid('phpunit-', true));

        $transactionRequest = new TransactionRequest($this->client, $payment);
        $requestResult = $transactionRequest->execute();
        $this->assertNotEmpty($requestResult->getTransactionId());
        $this->assertNotEmpty($requestResult->getIssuerUrl());

        $statusRequest = new StatusRequest($this->client, $requestResult->getTransactionId());
        $statusResult = $statusRequest->execute();
        $this->assertEquals('Open', $statusResult->getStatus());
    }

    public function testMastercard()
    {
        $payment = new Mastercard();
        $payment->setPurchaseId(uniqid());
        $payment->setEntranceCode(uniqid());
        $payment->setAmount(100);
        $payment->setDescription(uniqid('phpunit-', true));

        $transactionRequest = new TransactionRequest($this->client, $payment);
        $requestResult = $transactionRequest->execute();
        $this->assertNotEmpty($requestResult->getTransactionId());
        $this->assertNotEmpty($requestResult->getIssuerUrl());

        $statusRequest = new StatusRequest($this->client, $requestResult->getTransactionId());
        $statusResult = $statusRequest->execute();
        $this->assertEquals('Open', $statusResult->getStatus());
    }

    public function testMisterCash()
    {
        $payment = new MisterCash();
        $payment->setPurchaseId(uniqid());
        $payment->setEntranceCode(uniqid());
        $payment->setAmount(100);
        $payment->setDescription(uniqid('phpunit-', true));

        $transactionRequest = new TransactionRequest($this->client, $payment);
        $requestResult = $transactionRequest->execute();
        $this->assertNotEmpty($requestResult->getTransactionId());
        $this->assertNotEmpty($requestResult->getIssuerUrl());

        $statusRequest = new StatusRequest($this->client, $requestResult->getTransactionId());
        $statusResult = $statusRequest->execute();
        $this->assertEquals('Open', $statusResult->getStatus());
    }

    public function testPaypalExpressCheckout()
    {
        $payment = new PaypalExpressCheckout();
        $payment->setPurchaseId(uniqid());
        $payment->setEntranceCode(uniqid());
        $payment->setAmount(100);
        $payment->setDescription(uniqid('phpunit-', true));

        $transactionRequest = new TransactionRequest($this->client, $payment);
        $requestResult = $transactionRequest->execute();
        $this->assertNotEmpty($requestResult->getTransactionId());
        $this->assertNotEmpty($requestResult->getIssuerUrl());

        $statusRequest = new StatusRequest($this->client, $requestResult->getTransactionId());
        $statusResult = $statusRequest->execute();
        $this->assertEquals('Open', $statusResult->getStatus());
    }

    public function testSofortBanking()
    {
        $payment = new SofortBanking();
        $payment->setPurchaseId(uniqid());
        $payment->setEntranceCode(uniqid());
        $payment->setAmount(100);
        $payment->setDescription(uniqid('phpunit-', true));

        $transactionRequest = new TransactionRequest($this->client, $payment);
        $requestResult = $transactionRequest->execute();
        $this->assertNotEmpty($requestResult->getTransactionId());
        $this->assertNotEmpty($requestResult->getIssuerUrl());

        $statusRequest = new StatusRequest($this->client, $requestResult->getTransactionId());
        $statusResult = $statusRequest->execute();
        $this->assertEquals('Open', $statusResult->getStatus());
    }

    public function testVisa()
    {
        $payment = new Visa();
        $payment->setPurchaseId(uniqid());
        $payment->setEntranceCode(uniqid());
        $payment->setAmount(100);
        $payment->setDescription(uniqid('phpunit-', true));

        $transactionRequest = new TransactionRequest($this->client, $payment);
        $requestResult = $transactionRequest->execute();
        $this->assertNotEmpty($requestResult->getTransactionId());
        $this->assertNotEmpty($requestResult->getIssuerUrl());

        $statusRequest = new StatusRequest($this->client, $requestResult->getTransactionId());
        $statusResult = $statusRequest->execute();
        $this->assertEquals('Open', $statusResult->getStatus());
    }

    public function testWebshopGiftcard()
    {
        $payment = new WebshopGiftcard();
        $payment->setPurchaseId(uniqid());
        $payment->setEntranceCode(uniqid());
        $payment->setAmount(100);
        $payment->setDescription(uniqid('phpunit-', true));

        $transactionRequest = new TransactionRequest($this->client, $payment);
        $requestResult = $transactionRequest->execute();
        $this->assertNotEmpty($requestResult->getTransactionId());
        $this->assertNotEmpty($requestResult->getIssuerUrl());

        $statusRequest = new StatusRequest($this->client, $requestResult->getTransactionId());
        $statusResult = $statusRequest->execute();
        $this->assertEquals('Open', $statusResult->getStatus());
    }

    public function testWireTransfer()
    {
        $payment = new WireTransfer();
        $payment->setPurchaseId(uniqid());
        $payment->setEntranceCode(uniqid());
        $payment->setAmount(100);
        $payment->setDescription(uniqid('phpunit-', true));

        // WireTransfer specific settings
        $payment->setMail('user@domain.tld');
        $this->assertEquals('user@domain.tld', $payment->getMail());
        $payment->setIncluding(false);
        $this->assertEquals(false, $payment->getIncluding());
        $payment->setDays(14);
        $this->assertEquals(14, $payment->getDays());

        $transactionRequest = new TransactionRequest($this->client, $payment);
        $requestResult = $transactionRequest->execute();
        $this->assertNotEmpty($requestResult->getTransactionId());
        $this->assertNotEmpty($requestResult->getIssuerUrl());

        $statusRequest = new StatusRequest($this->client, $requestResult->getTransactionId());
        $statusResult = $statusRequest->execute();
        $this->assertEquals('Pending', $statusResult->getStatus());
    }
}
