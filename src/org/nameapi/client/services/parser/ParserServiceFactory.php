<?php

namespace org\nameapi\client\services\parser;

use org\nameapi\ontology\input\context\Context;

require_once(__DIR__.'/personnameparser/PersonNameParserService.php');

/**
 * Provides access to the parser-related services.
 */
class ParserServiceFactory {

    private $apiKey;
    private $context;
    private $baseUrl;
    private $personNameParser;

    /**
     */
    public function __construct($apiKey, Context $context, $baseUrl) {
        $this->apiKey = $apiKey;
        $this->context = $context;
        $this->baseUrl = $baseUrl;
    }

    /**
     * @return personnameparser\PersonNameParserService
     * @since v4.0
     */
    public function personNameParser() {
        if ($this->personNameParser==null) {
            $this->personNameParser = new personnameparser\PersonNameParserService($this->apiKey, $this->context, $this->baseUrl);
        }
        return $this->personNameParser;
    }

}

