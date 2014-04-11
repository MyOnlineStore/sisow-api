<?php

namespace Sisow\API\Method;

use Sisow\API\Client;
use Sisow\API\Method;
use Sisow\API\Payment;
use Sisow\API\Payment\Ideal;

class TransactionRequest extends Method
{
    /** @var Payment */
    private $payment;

    /**
     * @param Client $client
     * @param Payment $payment
     */
    public function __construct(Client $client, Payment $payment)
    {
        $this->setClient($client);
        $this->setPayment($payment);
    }

    /**
     * @return string
     */
    public function getHash()
    {
        return sha1("{$this->payment->getPurchaseId()}{$this->payment->getEntranceCode()}{$this->payment->getAmount()}{$this->getClient()->getMerchantId()}{$this->getClient()->getMerchantKey()}");
    }

    /**
     * @return Payment
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * @param Payment $payment
     */
    public function setPayment(Payment $payment)
    {
        $this->payment = $payment;
    }

    /**
     * @return array
     */
    public function request()
    {
        $parameters = array(
            'merchantid' => $this->getClient()->getMerchantId(),
            'payment' => $this->payment->getPaymentIdentifier(),
            'purchaseid' => $this->payment->getPurchaseId(),
            'amount' => $this->payment->getAmount(),
            'currency' => $this->payment->getCurrency(),
            'entrancecode' => $this->payment->getEntranceCode(),
            'description' => $this->payment->getDescription(),
            'ipaddress' => $this->getClient()->getIpAddress(),
            'returnurl' => $this->payment->getReturnUrl(),
            'cancelurl' => $this->payment->getCancelUrl(),
            'callbackurl' => $this->payment->getCallbackUrl(),
            'notifyurl' => $this->payment->getNotifyUrl(),
            'sha1' => $this->getHash()
        );

        if ($this->payment instanceof Ideal) {
            $parameters['issuerid'] = $this->payment->getIssuerId();
        }
        return parent::request($parameters);
    }
} 
