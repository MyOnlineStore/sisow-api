<?php

namespace Sisow\API\Method;

use Sisow\API\Exception;
use Sisow\API\Method;

class DirectoryRequest extends Method
{
    /**
     * @return array
     * @throws Exception
     */
    public function getAvailableIssuers()
    {
        $requestResult = $this->request();
        if (!isset($requestResult['issuer'])) {
            throw new Exception('No Issuers could be found');
        }
        if (isset($requestResult['issuer']['issuerid'])) {
            return array($requestResult['issuer']);
        }
        return $requestResult['issuer'];
    }
} 
