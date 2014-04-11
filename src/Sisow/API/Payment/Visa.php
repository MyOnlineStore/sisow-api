<?php

namespace Sisow\API\Payment;

use Sisow\API\Payment;

class Visa extends Payment
{
    public function getPaymentIdentifier()
    {
        return 'visa';
    }
} 
