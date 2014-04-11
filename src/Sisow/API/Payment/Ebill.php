<?php

namespace Sisow\API\Payment;

use Sisow\API\Payment;

class Ebill extends Payment
{
    public function getPaymentIdentifier()
    {
        return 'ebill';
    }
} 
