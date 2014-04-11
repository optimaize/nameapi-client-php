<?php

namespace org\nameapi\client\services\email\emailnameparser\wsdl;

use org\nameapi\ontology\input\context\Context;

class EmailNameParserServiceArguments {

    public $context = null;
    public $emailAddress = null;

    /**
     * @param Context $context
     * @param string $emailAddress
     */
    public function __construct(Context $context, $emailAddress) {
        $this->context = $context;
        $this->emailAddress = $emailAddress;
    }

}
