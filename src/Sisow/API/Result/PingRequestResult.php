<?php

namespace Sisow\API\Result;

use Sisow\API\Client;
use Sisow\API\Exception;
use Sisow\API\Result;

class PingRequestResult extends Result
{
    /** @var \DateTime */
    private $timestamp;

    public function __construct(Client $client, array $pingRequestData)
    {
        $this->setClient($client);
        if (!isset($pingRequestData['timestamp'])) {
            throw new Exception('Couldn\'t retrieve status');
        }
        $this->setTimestamp($pingRequestData['timestamp']);
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }

    protected function setTimestamp($timestamp)
    {
        $this->timestamp = \DateTime::createFromFormat('YmdHisu', $timestamp);
    }
} 
