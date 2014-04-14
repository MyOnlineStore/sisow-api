<?php

namespace Sisow\API;

abstract class Payment
{
    const CURRENCY_EUR = 'EUR';
    const CURRENCY_USD = 'USD';

    /** @var int */
    private $amount;

    /** @var string */
    private $callbackUrl;

    /** @var string */
    private $cancelUrl;

    /** @var string */
    private $currency = self::CURRENCY_EUR;

    /** @var string */
    private $description;

    /** @var string */
    private $entranceCode;

    /** @var string */
    private $notifyUrl;

    /** @var string|int */
    private $purchaseId;

    /** @var string */
    private $returnUrl;

    /**
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param int $amount Het bedrag in centen
     * @throws Exception
     */
    public function setAmount($amount)
    {
        if (!is_numeric($amount)) {
            throw new Exception('The amount must be given in cents (integer)');
        }
        $this->amount = (int)$amount;
    }

    /**
     * @return string
     */
    public function getCallbackUrl()
    {
        return $this->callbackUrl;
    }

    /**
     * @param string $callbackUrl
     * @throws Exception
     */
    public function setCallbackUrl($callbackUrl)
    {
        if (!filter_var($callbackUrl, FILTER_VALIDATE_URL)) {
            throw new Exception('The callbackUrl must be a valid address (scheme included!)');
        }
        $this->callbackUrl = $callbackUrl;
    }

    /**
     * @return string
     */
    public function getCancelUrl()
    {
        return $this->cancelUrl;
    }

    /**
     * @param string $cancelUrl
     * @throws Exception
     */
    public function setCancelUrl($cancelUrl)
    {
        if (!filter_var($cancelUrl, FILTER_VALIDATE_URL)) {
            throw new Exception('The cancelUrl must be a valid address (scheme included!)');
        }
        $this->cancelUrl = $cancelUrl;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency ISO 4217 valutacode (standaard EUR)
     * @throws Exception
     */
    public function setCurrency($currency)
    {
        if (!in_array($currency, array(self::CURRENCY_EUR, self::CURRENCY_USD))) {
            throw new Exception('Currency must be one of the \Sisow\API\Payment::CURRENCY_ constants');
        }
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @throws Exception
     */
    public function setDescription($description)
    {
        if (strlen($description) > 32) {
            throw new Exception('The description may not be longer than 32 characters');
        }
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getEntranceCode()
    {
        return $this->entranceCode;
    }

    /**
     * @param string $entranceCode
     * @throws Exception
     */
    public function setEntranceCode($entranceCode)
    {
        if (!preg_match('/^[0-9a-z]+$/i', $entranceCode) || strlen($entranceCode) > 40) {
            throw new Exception('The EntranceCode may only contain [0-9a-z] and must not be longer than 40 characters');
        }
        $this->entranceCode = $entranceCode;
    }

    /**
     * @return string
     */
    public function getNotifyUrl()
    {
        return $this->notifyUrl;
    }

    /**
     * @param string $notifyUrl
     * @throws Exception
     */
    public function setNotifyUrl($notifyUrl)
    {
        if (!filter_var($notifyUrl, FILTER_VALIDATE_URL)) {
            throw new Exception('The notifyUrl must be a valid address (scheme included!)');
        }
        $this->notifyUrl = $notifyUrl;
    }

    /**
     * @return string|int
     */
    public function getPurchaseId()
    {
        return $this->purchaseId;
    }

    /**
     * @param string|int $purchaseId Het betalingskenmerk, maximaal 16 posities
     * @throws Exception
     */
    public function setPurchaseId($purchaseId)
    {
        if (strlen($purchaseId) > 16) {
            throw new Exception('The PurchaseId may not be longer than 16 characters');
        }
        $this->purchaseId = $purchaseId;
    }

    /**
     * @return string
     */
    public function getReturnUrl()
    {
        return $this->returnUrl;
    }

    /**
     * @param string $returnUrl
     * @throws Exception
     */
    public function setReturnUrl($returnUrl)
    {
        if (!filter_var($returnUrl, FILTER_VALIDATE_URL)) {
            throw new Exception('The returnUrl must be a valid address (scheme included!)');
        }
        $this->returnUrl = $returnUrl;
    }
} 
