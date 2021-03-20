<?php

namespace Org\NameApi\Client\Services\Matcher;

use Org\NameApi\ontology\input\Context\Context;

/**
 * Provides access to the matcher-related services.
 */
class MatcherServiceFactory
{

    private $apiKey;
    private $context;
    private $baseUrl;
    private $personMatcher;

    /**
     */
    public function __construct($apiKey, Context $context, $baseUrl)
    {
        $this->apiKey = $apiKey;
        $this->context = $context;
        $this->baseUrl = $baseUrl;
    }

    /**
     * @return PersonMatcher\PersonMatcherService
     * @since v4.0
     */
    public function personMatcher()
    {
        if ($this->personMatcher == null) {
            $this->personMatcher = new PersonMatcher\PersonMatcherService($this->apiKey, $this->context, $this->baseUrl);
        }
        return $this->personMatcher;
    }

}

