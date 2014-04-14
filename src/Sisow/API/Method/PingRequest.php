<?php

namespace Sisow\API\Method;

use Sisow\API\Method;
use Sisow\API\Result\PingRequestResult;

class PingRequest extends Method
{
    public function execute()
    {
        return new PingRequestResult($this->getClient(), parent::execute());
    }
} 
