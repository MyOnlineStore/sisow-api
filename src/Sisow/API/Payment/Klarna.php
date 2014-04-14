<?php

namespace Sisow\API\Payment;

use Sisow\API\Exception;
use Sisow\API\Payment;

abstract class Klarna extends Payment
{
    /** @var int|string */
    private $customer;

    /** @var string [m|f] */
    private $gender;

    /**
     * @return int|string
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param int|string $customer
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param string $gender [m|f]
     * @throws \Sisow\API\Exception
     */
    public function setGender($gender)
    {
        if (!in_array($gender, array('m', 'f'))) {
            throw new Exception('The gender must either be "M" (male) or "F" (female) ');
        }
        $this->gender = strtolower($gender);
    }
} 
