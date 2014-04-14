<?php

namespace Sisow\API\Result;

use Sisow\API\Client;
use Sisow\API\Exception;
use Sisow\API\Result;
use Sisow\API\Result\DirectoryRequest\IssuerResult;

class DirectoryRequestResult extends Result
{
    /** @var array */
    private $issuers = array();

    /**
     * @param Client $client
     * @param array $directoryRequestData
     * @throws Exception
     */
    public function __construct(Client $client, array $directoryRequestData)
    {
        $this->setClient($client);
        $directoryRequestData = call_user_func_array('array_merge', $directoryRequestData);

        if (!isset($directoryRequestData['issuer'])) {
            throw new Exception('No Issuers could be found');
        }

        if (isset($directoryRequestData['issuer']['issuerid'])) {
            $this->issuers[] = new IssuerResult($directoryRequestData['issuer']['issuerid'], $directoryRequestData['issuer']['issuername']);
        } else {
            foreach ($directoryRequestData['issuer'] as $issuer) {
                $this->issuers[] = new IssuerResult($issuer['issuerid'], $issuer['issuername']);
            }
        }
    }

    /**
     * @return array
     */
    public function getIssuers()
    {
        return $this->issuers;
    }
} 
