<?php

namespace Sisow\API\Result;

use Sisow\API\Client;
use Sisow\API\Exception;
use Sisow\API\Result;

/**
 * Class CheckMerchantRequestResult
 * @package Sisow\API\Result
 */
class CheckMerchantRequestResult extends Result
{
    /**
     * @var array
     */
    private $merchantPayments = array();

    /**
     * @param Client $client
     * @param array $checkMerchantRequestData
     * @throws Exception
     */
    function __construct(Client $client, array $checkMerchantRequestData)
    {
        $this->setClient($client);

        if (!isset($checkMerchantRequestData['signature']['sha1'])) {
            throw new Exception('Signature is missing');
        }
        $this->setSignature($checkMerchantRequestData['signature']['sha1']);

        if (isset($checkMerchantRequestData['merchant']['payments']['payment'])) {
            foreach ((array)$checkMerchantRequestData['merchant']['payments']['payment'] as $payment) {
                $this->merchantPayments[] = $payment;
            }
        }
    }

    /**
     * @return array
     */
    public function getMerchantPayments()
    {
        return $this->merchantPayments;
    }
}
