<?php

namespace Sisow\API\Method;

use Sisow\API\Method;
use Sisow\API\Result\CheckMerchantRequestResult;

/**
 * Class CheckMerchantRequest
 * @package Sisow\API\Method
 */
class CheckMerchantRequest extends Method
{
    /**
     * @return string
     */
    public function getHash()
    {
        return sha1("{$this->getClient()->getMerchantId()}{$this->getClient()->getMerchantKey()}");
    }

    /**
     * @param array $parameters
     * @return CheckMerchantRequestResult
     */
    public function execute(array $parameters = array())
    {
        $parameters += array(
            'merchantid' => $this->getClient()->getMerchantId(),
            'sha1' => $this->getHash()
        );
        return new CheckMerchantRequestResult($this->getClient(), parent::execute($parameters));
    }
}
