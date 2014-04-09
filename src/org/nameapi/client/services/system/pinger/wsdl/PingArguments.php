<?php

namespace org\nameapi\client\services\system\ping\wsdl;

use org\nameapi\ontology\input\context\Context;

class PingArguments {

    private $context = null;

    public function __construct(Context $context) {
        $this->context = $context;
    }

}
