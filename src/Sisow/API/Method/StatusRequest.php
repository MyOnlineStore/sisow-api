<?php

namespace Sisow\API\Method;

use Sisow\API\Client;
use Sisow\API\Method;

class StatusRequest extends Method
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
    public function getHash()
    {
        return sha1("{$this->getTransactionId()}{$this->getClient()->getMerchantId()}{$this->getClient()->getMerchantKey()}");
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

    /**
     * @return array
     */
    public function execute()
    {
        $client = $this->getClient();

        $parameters = array(
            'merchantid' => $client->getMerchantId(),
            'trxid' => $this->transactionId,
            'sha1' => $this->getHash()
        );
        return parent::execute($parameters);
    }
} 
