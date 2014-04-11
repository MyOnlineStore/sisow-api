<?php

namespace Sisow\API\Payment;

use Sisow\API\Payment;

class Maestro extends Payment
{
    public function getPaymentIdentifier()
    {
        return 'maestro';
    }
} 
