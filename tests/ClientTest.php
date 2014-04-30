<?php

use Sisow\API\Client;
use Sisow\API\Exception;

class ClientTest extends PHPUnit_Framework_TestCase
{
    /** @var Client */
    private $client;

    public function setUp()
    {
        $this->client = new Client(1337, '0beec7b5ea3f0fdbc95d0dd47f3c5bc275da8a33');
    }

    public function testEnvironment()
    {
        $this->client->setEnviroment(Client::ENVIRONMENT_TESTING);
        $this->assertEquals(Client::ENVIRONMENT_TESTING, $this->client->getEnviroment());

        $this->client->setEnviroment(Client::ENVIRONMENT_PRODUCTION);
        $this->assertEquals(Client::ENVIRONMENT_PRODUCTION, $this->client->getEnviroment());

        try {
            $this->client->setEnviroment('foo');
            $this->fail('Invalid environment could be set');
        } catch (Exception $exception) { }
    }

    public function testIpAddress()
    {
        $this->client->setIpAddress('8.8.8.8');
        $this->assertEquals('8.8.8.8', $this->client->getIpAddress());

        $this->client->setIpAddress('2001:4860:4860::8888');
        $this->assertEquals('2001:4860:4860::8888', $this->client->getIpAddress());

        try {
            $this->client->setIpAddress('2001');
            $this->fail('Invalid IP could be set');
        } catch (Exception $exception) { }

        try {
            $this->client->setIpAddress('0.0.0.0');
            $this->fail('Invalid IP could be set');
        } catch (Exception $exception) { }

        try {
            $this->client->setIpAddress('127.0.0.1');
            $this->fail('Local reserved IP could be set');
        } catch (Exception $exception) { }
    }

    public function testMerchantId()
    {
        $this->client->setMerchantId(1337);
        $this->assertEquals(1337, $this->client->getMerchantId());

        $this->client->setMerchantId(31337);
        $this->assertEquals(31337, $this->client->getMerchantId());

        try {
            $this->client->setMerchantId('foobar');
            $this->fail('Invalid merchantId could be set');
        } catch (Exception $exception) { }
    }

    public function testMerchantKey()
    {
        $this->client->setMerchantKey('0beec7b5ea3f0fdbc95d0dd47f3c5bc275da8a33');
        $this->assertEquals('0beec7b5ea3f0fdbc95d0dd47f3c5bc275da8a33', $this->client->getMerchantKey());

        $this->client->setMerchantKey('62cdb7020ff920e5aa642c3d4066950dd1f01f4d');
        $this->assertEquals('62cdb7020ff920e5aa642c3d4066950dd1f01f4d', $this->client->getMerchantKey());

        try {
            $this->client->setMerchantKey('foobar');
            $this->fail('Invalid merchantKey could be set');
        } catch (Exception $exception) { }
    }
}
