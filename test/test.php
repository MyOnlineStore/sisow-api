<?php

include('../src/Sisow/API/Autoloader.php');

use Sisow\API\Client;
use Sisow\API\Method\StatusRequest;
use Sisow\API\Method\TransactionRequest;
use Sisow\API\Payment\Ebill;
use Sisow\API\Payment;
use Sisow\API\Result\StatusRequestResult;

$options = getopt('', array('merchantId:', 'merchantKey:'));

$client = new Client($options['merchantId'], $options['merchantKey']);
$client->setEnviroment(Client::ENVIRONMENT_TESTING);

$payment = new Payment\Ideal();
$orderNumber = time();

$payment->setAmount(100);
$payment->setPurchaseId($orderNumber);
$payment->setEntranceCode(sha1($orderNumber));
$payment->setDescription("Order: {$orderNumber}");
$payment->setReturnUrl('http://www.example.org/');

$statusRequest = new StatusRequest($client, 'TEST080493131798');
var_dump($statusRequest->execute());

$statusRequest = new StatusRequest($client, 'TEST080493131815');
$object = $statusRequest->execute();
var_dump($object->getStatus());
