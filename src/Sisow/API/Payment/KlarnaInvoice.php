<?php

namespace Sisow\API\Payment;

use Sisow\API\Payment;

class KlarnaInvoice extends Payment
{
    public function getPaymentIdentifier()
    {
        return 'klarna';
    }
} 
