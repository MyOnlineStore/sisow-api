<?php

namespace Sisow\API;

abstract class Result
{
    /** @var Client */
    private $client;

    /** @var string */
    private $signature;

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param Client $client
     */
    protected function setClient(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return string
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * @param string $signature
     */
    protected function setSignature($signature)
    {
        $this->signature = $signature;
    }
} 
