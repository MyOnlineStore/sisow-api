<?php

namespace Sisow\API\Payment;

use Sisow\API\Payment;

class WebshopGiftcard extends Payment
{
    public function getPaymentIdentifier()
    {
        return 'webshop';
    }
} 
