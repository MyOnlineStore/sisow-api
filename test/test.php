<?php

include('../src/Sisow/API/Autoloader.php');

use Sisow\API\Client;
use Sisow\API\Method\TransactionRequest;
use Sisow\API\Payment\Ebill;
use Sisow\API\Payment;

$options = getopt('', array('merchantId:', 'merchantKey:'));

$client = new Client($options['merchantId'], $options['merchantKey']);
$client->setEnviroment(Client::ENVIRONMENT_TESTING);

$payment = new Ebill();
$orderNumber = time();

$payment->setAmount(100);
$payment->setPurchaseId($orderNumber);
$payment->setEntranceCode(sha1($orderNumber));
$payment->setDescription("Order: {$orderNumber}");
$payment->setReturnUrl('http://www.example.org/');
$payment->setMail('danny.loomeijer@fayntic.com');
$payment->setIncluding(true);

$transactionRequest = new TransactionRequest($client, $payment);
var_dump($transactionRequest->execute());
