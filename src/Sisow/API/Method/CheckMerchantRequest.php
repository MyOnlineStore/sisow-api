<?php

namespace Sisow\API\Method;

use Sisow\API\Method;
use Sisow\API\Result\CheckMerchantRequestResult;

class CheckMerchantRequest extends Method
{
    /**
     * @param array $parameters
     *
     * @return CheckMerchantRequestResult
     * @throws \Exception
     */
    public function execute(array $parameters = [])
    {
        $client = $this->getClient();

        $parameters = [
            'merchantid' => $client->getMerchantId(),
            'sha1' => $this->getHash(),
        ];

        return new CheckMerchantRequestResult($client, parent::execute($parameters));
    }

    /**
     * @return string
     */
    public function getHash()
    {
        return sha1("{$this->getClient()->getMerchantId()}{$this->getClient()->getMerchantKey()}");
    }
}
