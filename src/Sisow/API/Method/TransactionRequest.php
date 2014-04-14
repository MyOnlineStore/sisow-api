<?php

namespace Sisow\API\Method;

use Sisow\API\Client;
use Sisow\API\Exception;
use Sisow\API\Method;
use Sisow\API\Payment;
use Sisow\API\Payment\Ebill;
use Sisow\API\Payment\Ideal;
use Sisow\API\Payment\Klarna\KlarnaAccount;
use Sisow\API\Payment\Klarna\KlarnaInvoice;
use Sisow\API\Payment\Maestro;
use Sisow\API\Payment\Mastercard;
use Sisow\API\Payment\MisterCash;
use Sisow\API\Payment\PaypalExpressCheckout;
use Sisow\API\Payment\SofortBanking;
use Sisow\API\Payment\Visa;
use Sisow\API\Payment\WebshopGiftcard;
use Sisow\API\Payment\WireTransfer;
use Sisow\API\Result\TransactionRequestResult;

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
     * @return Ebill|Ideal|KlarnaAccount|KlarnaInvoice|Maestro|Mastercard|MisterCash|PaypalExpressCheckout|SofortBanking|Visa|WebshopGiftcard|WireTransfer
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
     * @return mixed|TransactionRequestResult
     * @throws Exception
     */
    public function execute()
    {
        $client = $this->getClient();
        $payment = $this->getPayment();

        $parameters = array(
            'merchantid' => $client->getMerchantId(),
            'payment' => $payment::PAYMENT_IDENTIFIER,
            'purchaseid' => $payment->getPurchaseId(),
            'amount' => $payment->getAmount(),
            'currency' => $payment->getCurrency(),
            'entrancecode' => $payment->getEntranceCode(),
            'description' => $payment->getDescription(),
            'ipaddress' => $client->getIpAddress(),
            'returnurl' => $payment->getReturnUrl(),
            'cancelurl' => $payment->getCancelUrl(),
            'callbackurl' => $payment->getCallbackUrl(),
            'notifyurl' => $payment->getNotifyUrl(),
            'sha1' => $this->getHash()
        );

        if (method_exists($payment, 'getParameters')) {
            $parameters = array_merge($parameters, $payment->getParameters());
        }
        return new TransactionRequestResult($client, $payment, parent::execute($parameters));
    }

    /**
     * @return string
     */
    protected function getHash()
    {
        return sha1("{$this->payment->getPurchaseId()}{$this->payment->getEntranceCode()}{$this->payment->getAmount()}{$this->getClient()->getMerchantId()}{$this->getClient()->getMerchantKey()}");
    }
} 
