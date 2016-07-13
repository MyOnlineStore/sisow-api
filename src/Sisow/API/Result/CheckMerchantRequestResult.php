<?php

namespace Sisow\API\Result;

use Sisow\API\Client;
use Sisow\API\Exception;
use Sisow\API\Result;

class CheckMerchantRequestResult extends Result
{
    /**
     * @var array
     */
    private $paymentMethods = [];

    /**
     * @var bool
     */
    private $active = false;

    /**
     * @param Client $client
     * @param array $statusRequestData
     *
     * @throws Exception
     */
    public function __construct(Client $client, array $statusRequestData)
    {
        $this->setClient($client);

        if (!isset($statusRequestData['signature']['sha1'])) {
            throw new Exception('Signature is missing');
        }
        $this->setSignature($statusRequestData['signature']['sha1']);

        $statusRequestData = call_user_func_array('array_merge', $statusRequestData);

        if (isset($statusRequestData['active'])) {
            $this->active = $statusRequestData['active'] === 'true';
        }
        if (isset($statusRequestData['payments']['payment']) && is_array($statusRequestData['payments']['payment'])) {
            $this->paymentMethods = $statusRequestData['payments']['payment'];
        }
    }

    /**
     * @return array
     */
    public function getPaymentMethods()
    {
        return $this->paymentMethods;
    }

    /**
     * @return boolean
     */
    public function isActive()
    {
        return $this->active;
    }
}
