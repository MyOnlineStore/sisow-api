<?php

namespace Sisow\API\Result\DirectoryRequest;

class IssuerResult
{
    /** @var int */
    private $issuerId;

    /** @var string */
    private $issuerName;

    /**
     * @param int $issuerId
     * @param string $issuerName
     */
    public function __construct($issuerId, $issuerName)
    {
        $this->setIssuerId($issuerId);
        $this->setIssuerName($issuerName);
    }

    /**
     * @return int
     */
    public function getIssuerId()
    {
        return $this->issuerId;
    }

    /**
     * @param int $issuerId
     */
    protected function setIssuerId($issuerId)
    {
        $this->issuerId = (int)$issuerId;
    }

    /**
     * @return string
     */
    public function getIssuerName()
    {
        return $this->issuerName;
    }

    /**
     * @param string $issuerName
     */
    protected function setIssuerName($issuerName)
    {
        $this->issuerName = $issuerName;
    }
} 
