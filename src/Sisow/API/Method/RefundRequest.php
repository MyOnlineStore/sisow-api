<?php

namespace Sisow\API\Method;

use Sisow\API\Client;
use Sisow\API\Method;

class RefundRequest extends Method
{
    /** @var string */
    private $transactionId;

    /**
     * @param Client $client
     * @param string $transactionId
     */
    public function __construct(Client $client, $transactionId)
    {
        $this->setClient($client);
        $this->setTransactionId($transactionId);
    }

    /**
     * @return string
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * @param string $transactionId
     */
    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;
    }
} 
