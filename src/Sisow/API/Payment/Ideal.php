<?php

namespace Sisow\API\Payment;

use Sisow\API\Client;
use Sisow\API\Method\DirectoryRequest;
use Sisow\API\Payment;
use Sisow\API\Result\DirectoryRequestResult;

class Ideal extends Payment
{
    const PAYMENT_IDENTIFIER = '';

    /** @var int */
    private $issuerId;

    /**
     * @param Client $client
     * @return DirectoryRequestResult
     */
    public function getAvailableIssuers(Client $client)
    {
        $directoryRequest = new DirectoryRequest($client);
        return $directoryRequest->execute();
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

    /**
     * @return array
     */
    public function getParameters()
    {
        return array(
            'issuerid' => $this->getIssuerId()
        );
    }
} 
