<?php

namespace Sisow\API\Method;

use Sisow\API\Exception;
use Sisow\API\Method;
use Sisow\API\Result\DirectoryRequestResult;

class DirectoryRequest extends Method
{
    /**
     * @param array $parameters
     * @return DirectoryRequestResult
     * @throws Exception
     */
    public function execute(array $parameters = array())
    {
        return new DirectoryRequestResult($this->getClient(), parent::execute());
    }
} 
