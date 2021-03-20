<?php

namespace Org\NameApi\Client\Services\Parser;

use Org\NameApi\ontology\input\Context\Context;

/**
 * Provides access to the parser-related services.
 */
class ParserServiceFactory
{

    private $apiKey;
    private $context;
    private $baseUrl;
    private $personNameParser;

    /**
     */
    public function __construct($apiKey, Context $context, $baseUrl)
    {
        $this->apiKey = $apiKey;
        $this->context = $context;
        $this->baseUrl = $baseUrl;
    }

    /**
     * @return PersonNameParser\PersonNameParserService
     * @since v4.0
     */
    public function personNameParser()
    {
        if ($this->personNameParser == null) {
            $this->personNameParser = new PersonNameParser\PersonNameParserService($this->apiKey, $this->context, $this->baseUrl);
        }
        return $this->personNameParser;
    }

}

