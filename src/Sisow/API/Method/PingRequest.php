<?php

namespace Sisow\API\Method;

use Sisow\API\Exception;
use Sisow\API\Method;
use Sisow\API\Result\PingRequestResult;

class PingRequest extends Method
{
    /**
     * @param array $parameters
     * @return PingRequestResult
     * @throws Exception
     */
    public function execute(array $parameters = array())
    {
        return new PingRequestResult($this->getClient(), parent::execute());
    }
} 
