<?php

namespace Sisow\API\Payment;

use Sisow\API\Payment;

class PaypalExpressCheckout extends Payment
{
    public function getPaymentIdentifier()
    {
        return 'paypalec';
    }
} 
