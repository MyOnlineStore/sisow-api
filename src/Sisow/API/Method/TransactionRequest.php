<?php

namespace Sisow\API\Method;

use Sisow\API\Client;
use Sisow\API\Exception;
use Sisow\API\Method;
use Sisow\API\Payment;
use Sisow\API\Payment\Ebill;
use Sisow\API\Payment\Esend;
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

    /** @var Esend */
    private $esend;

    /**
     * @param Client $client
     * @param Payment $payment
     * @param Esend $esend
     */
    public function __construct(Client $client, Payment $payment, Esend $esend = null)
    {
        $this->setClient($client);
        $this->setPayment($payment);
        if ($esend) {
            $this->setEsend($esend);
        }
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
     * @return Esend
     */
    public function getEsend()
    {
        return $this->esend;
    }

    /**
     * @param Esend $esend
     */
    public function setEsend(Esend $esend)
    {
        $this->esend = $esend;
    }

    /**
     * @param array $parameters
     * @return TransactionRequestResult
     * @throws Exception
     */
    public function execute(array $parameters = array())
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

        if ($esend = $this->getEsend()) {
            $esendParameters = array(
                'shipping_lastname' => $esend->getLastname(),
                'shipping_address1' => strstr($esend->getAddress(), "\n", true),
                'shipping_zip' => $esend->getZipcode(),
                'shipping_city' => $esend->getCity(),
                'shipping_country' => $esend->getCountry(),
                'shipping_countrycode' => $esend->getCountryCode()
            );

            if ($firstname = $esend->getFirstname()) {
                $esendParameters['shipping_firstname'] = $firstname;
            }
            if ($email = $esend->getEmail()) {
                $esendParameters['shipping_mail'] = $email;
            }
            if ($company = $esend->getCompany()) {
                $esendParameters['shipping_company'] = $company;
            }
            if ($address2 = strstr("\n", $esend->getAddress())) {
                $esendParameters['shipping_address2'] = $address2;
            }
            if ($phone = $esend->getPhone()) {
                $esendParameters['shipping_phone'] = $phone;
            }
            if ($weight = $esend->getWeight()) {
                $esendParameters['weight'] = $weight;
            }
            if ($shippingCosts = $esend->getShippingCosts()) {
                $esendParameters['shipping'] = $shippingCosts;
            }
            if ($handleCosts = $esend->getHandleCosts()) {
                $esendParameters['handling'] = $handleCosts;
            }
            $parameters = array_merge($parameters, $esendParameters);
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
