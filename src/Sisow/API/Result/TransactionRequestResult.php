<?php

namespace Sisow\API\Result;

use Sisow\API\Client;
use Sisow\API\Exception;
use Sisow\API\Payment;
use Sisow\API\Result;

class TransactionRequestResult extends Result
{
    /** @var int */
    private $documentId;

    /** @var string */
    private $documentUrl;

    /** @var int */
    private $invoiceNumber;

    /** @var string */
    private $issuerUrl;

    /** @var Payment */
    private $payment;

    /** @var string */
    private $transactionId;

    /**
     * @param Client $client
     * @param Payment $payment
     * @param array $transactionRequestData
     * @throws Exception
     */
    public function __construct(Client $client, Payment $payment, array $transactionRequestData)
    {
        if (!isset($transactionRequestData['signature']['sha1'])) {
            throw new Exception('Signature is missing');
        }
        $this->setSignature($transactionRequestData['signature']['sha1']);
        $this->setClient($client);
        $this->setPayment($payment);

        $transactionRequestData = call_user_func_array('array_merge', $transactionRequestData);

        $requiredFields = array('issuerurl', 'trxid');
        if(count(array_intersect_key(array_flip($requiredFields), $transactionRequestData)) !== count($requiredFields)) {
            throw new Exception('The request went wrong, missing parameters');
        }

        $this->setIssuerUrl($transactionRequestData['issuerurl']);
        $this->setTransactionId($transactionRequestData['trxid']);

        if (isset($transactionRequestData['documentid'], $transactionRequestData['documenturl'])) {
            $this->setDocumentId($transactionRequestData['documentid']);
            $this->setDocumentUrl($transactionRequestData['documenturl']);
        }

        if (isset($transactionRequestData['invoiceno'])) {
            $this->setInvoiceNumber($transactionRequestData['invoiceno']);
        }
    }

    /**
     * @return int
     */
    public function getDocumentId()
    {
        return $this->documentId;
    }

    /**
     * @param int $documentId
     */
    protected function setDocumentId($documentId)
    {
        $this->documentId = (int)$documentId;
    }

    /**
     * @return string
     */
    public function getDocumentUrl()
    {
        return $this->documentUrl;
    }

    /**
     * @param string $documentUrl
     */
    protected function setDocumentUrl($documentUrl)
    {
        $this->documentUrl = $documentUrl;
    }

    /**
     * @return int
     */
    public function getInvoiceNumber()
    {
        return $this->invoiceNumber;
    }

    /**
     * @param int $invoiceNumber
     */
    protected function setInvoiceNumber($invoiceNumber)
    {
        $this->invoiceNumber = $invoiceNumber;
    }

    /**
     * @return string
     */
    public function getIssuerUrl()
    {
        return $this->issuerUrl;
    }

    /**
     * @param string $issuerUrl
     */
    protected function setIssuerUrl($issuerUrl)
    {
        $this->issuerUrl = $issuerUrl;
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
    protected function setPayment(Payment $payment)
    {
        $this->payment = $payment;
    }

    /**
     * @return string
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * @param string $transactionId
     */
    protected function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;
    }
}
