<?php

namespace Sisow\API\Payment;

use Sisow\API\Client;
use Sisow\API\Method\DirectoryRequest;
use Sisow\API\Payment;

class Ideal extends Payment
{
    /** @var int */
    private $issuerId;

    /**
     * @param Client $client
     * @return array
     */
    public function getAvailableIssuers(Client $client)
    {
        $directoryRequest = new DirectoryRequest($client);
        return $directoryRequest->getAvailableIssuers();
    }

    /**
     * @return int
     */
    public function getIssuerId()
    {
        return $this->issuerId;
    }

    /**
     * @param int $issuerId
     */
    public function setIssuerId($issuerId)
    {
        $this->issuerId = $issuerId;
    }
} 
