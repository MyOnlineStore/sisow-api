<?php

namespace Sisow\API\Payment;

use Sisow\API\Payment;

class MisterCash extends Payment
{
    public function getPaymentIdentifier()
    {
        return 'mistercash';
    }
} 
