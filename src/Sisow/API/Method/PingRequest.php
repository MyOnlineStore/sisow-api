<?php

namespace Sisow\API\Method;

use Sisow\API\Exception;
use Sisow\API\Method;
use Sisow\API\Result\PingRequestResult;

class PingRequest extends Method
{
    /**
     * @return PingRequestResult
     * @throws Exception
     */
    public function execute()
    {
        return new PingRequestResult($this->getClient(), parent::execute());
    }
} 
