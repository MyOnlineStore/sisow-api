<?php

namespace Sisow\API\Method;

use Sisow\API\Exception;
use Sisow\API\Method;
use Sisow\API\Result\DirectoryRequestResult;

class DirectoryRequest extends Method
{
    /**
     * @return DirectoryRequestResult
     * @throws Exception
     */
    public function execute()
    {
        return new DirectoryRequestResult($this->getClient(), parent::execute());
    }
} 
