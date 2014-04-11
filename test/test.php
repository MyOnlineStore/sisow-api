<?php

include('../src/Sisow/API/Autoloader.php');

use Sisow\API\Client;
use Sisow\API\Method\TransactionRequest;
use Sisow\API\Payment\Mastercard;

$options = getopt('', array('merchantId:', 'merchantKey:'));

$client = new Client($options['merchantId'], $options['merchantKey']);
$client->setEnviroment(Client::ENVIRONMENT_TESTING);

$orderNumber = time();

$ideal = new Mastercard();
$ideal->setAmount(100);
$ideal->setPurchaseId($orderNumber);
$ideal->setEntranceCode(sha1($orderNumber));

$ideal->setDescription("Order: {$orderNumber}");
$ideal->setReturnUrl('http://www.example.org/');

$transactionRequest = new TransactionRequest($client, $ideal);
var_dump($transactionRequest->request());
