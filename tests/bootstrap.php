<?php /* Copyright © LemonWeb B.V. All rights reserved. $$Revision: 6946 $ */

if (!is_file($autoloadFile = __DIR__.'/../vendor/autoload.php')) {
    throw new RuntimeException('Install dependencies to run test suite.');
}

require $autoloadFile;
