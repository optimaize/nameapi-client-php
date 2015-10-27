<?php

require 'vendor/autoload.php';

use org\nameapi\ontology\input\context\Context;
use org\nameapi\ontology\input\context\Priority;
use org\nameapi\client\services\ServiceFactory;

define('API_KEY', 'your-api-key');
define('TEST_EMAIL', 'abcdefgh@10minutemail.com');

$context = Context::builder()
    ->apiKey(API_KEY)
    ->priority(Priority::REALTIME())
    ->build();

$serviceFactory = new ServiceFactory($context);

$deaDetector = $serviceFactory->emailServices()->disposableEmailAddressDetector();
$result = $deaDetector->isDisposable(TEST_EMAIL);
echo $result->getDisposable();
