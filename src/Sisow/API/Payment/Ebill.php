<?php

namespace Sisow\API\Payment;

use Sisow\API\Exception;
use Sisow\API\Payment;

class Ebill extends Payment
{
    const PAYMENT_IDENTIFIER = 'ebill';

    /** @var int */
    private $days = 14;

    /** @var bool */
    private $including = false;

    /** @var string */
    private $mail;

    /**
     * @return int Het aantal dagen dat de Sisow ebill geldig is
     */
    public function getDays()
    {
        return $this->days;
    }

    /**
     * @param int $days Het aantal dagen dat de Sisow ebill geldig is
     * @throws \Sisow\API\Exception
     */
    public function setDays($days)
    {
        if (!is_numeric($days)) {
            throw new Exception('Days must be numeric');
        }
        $this->days = (int)$days;
    }

    /**
     * @return bool
     */
    public function getIncluding()
    {
        return $this->including;
    }

    /**
     * @param bool $including
     */
    public function setIncluding($including)
    {
        $this->including = (bool)$including;
    }

    /**
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     * @throws \Sisow\API\Exception
     */
    public function setMail($mail)
    {
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Invalid email address is specified');
        }
        $this->mail = $mail;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return array(
            'billing_mail' => $this->mail,
            'days' => $this->days,
            'including' => $this->including ? 'true' : 'false'
        );
    }
}
