<?php

namespace org\nameapi\client\services\parser;

use org\nameapi\ontology\input\context\Context;

require_once('personnameparser/PersonNameParserService.php');

class ParserServiceFactory {

    private $context;
    private $personNameParser;

    /**
     */
    public function __construct(Context $context) {
        $this->context = $context;
    }

    /**
     * @return personnameparser\PersonNameParserService
     */
    public function personNameParser() {
        if ($this->personNameParser==null) {
            $this->personNameParser = new personnameparser\PersonNameParserService($this->context);
        }
        return $this->personNameParser;
    }

}

