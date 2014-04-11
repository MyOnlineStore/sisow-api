<?php

namespace Sisow\API\Payment;

use Sisow\API\Payment;

class WireTransfer extends Payment
{
    public function getPaymentIdentifier()
    {
        return 'overboeking';
    }
} 
