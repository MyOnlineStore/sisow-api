<?php

namespace Sisow\API\Payment;

use Sisow\API\Payment;

class Mastercard extends Payment
{
    public function getPaymentIdentifier()
    {
        return 'mastercard';
    }
} 
