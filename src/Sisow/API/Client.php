<?php

namespace Sisow\API;

class Client
{
    const ENVIRONMENT_PRODUCTION = 'production';
    const ENVIRONMENT_TESTING = 'testing';

    /** @var int */
    private $merchantId;

    /** @var string */
    private $merchantKey;

    /** @var string */
    private $environment = self::ENVIRONMENT_PRODUCTION;

    public function __construct($merchantId, $merchantKey)
    {
        $this->setMerchantId($merchantId);
        $this->setMerchantKey($merchantKey);
    }

    /**
     * @return string
     */
    public function getEnviroment()
    {
        return $this->environment;
    }

    /**
     * @param string $enviroment
     * @throws Exception
     */
    public function setEnviroment($enviroment)
    {
        if (!in_array($enviroment, array(self::ENVIRONMENT_PRODUCTION, self::ENVIRONMENT_TESTING))) {
            throw new Exception('Environment must be one of the \Sisow\API\Client::ENVIRONMENT_ constants');
        }
        $this->environment = $enviroment;
    }

    /**
     * @return int
     */
    public function getMerchantId()
    {
        return $this->merchantId;
    }

    /**
     * @param int $merchantId
     * @throws Exception
     */
    public function setMerchantId($merchantId)
    {
        if (!is_numeric($merchantId)) {
            throw new Exception('MerchantId must be numeric (integer)');
        }
        $this->merchantId = (int)$merchantId;
    }

    /**
     * @return string
     */
    public function getMerchantKey()
    {
        return $this->merchantKey;
    }

    /**
     * @param string $merchantKey
     * @throws Exception
     */
    public function setMerchantKey($merchantKey)
    {
        if (!preg_match('/^[0-9a-f]{40}$/', $merchantKey)) {
            throw new Exception('MerchantKey must be a 40 character long hash');
        }
        $this->merchantKey = $merchantKey;
    }
}
