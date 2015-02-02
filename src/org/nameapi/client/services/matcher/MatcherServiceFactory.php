<?php

namespace org\nameapi\client\services\matcher;

use org\nameapi\ontology\input\context\Context;

require_once(__DIR__.'/personmatcher/PersonMatcherService.php');

/**
 * Provides access to the matcher-related services.
 */
class MatcherServiceFactory {

    private $context;
    private $baseUrl;
    private $personMatcher;

    /**
     */
    public function __construct(Context $context, $baseUrl) {
        $this->context = $context;
        $this->baseUrl = $baseUrl;
    }

    /**
     * @return personmatcher\PersonMatcherService
     * @since v4.0
     */
    public function personMatcher() {
        if ($this->personMatcher==null) {
            $this->personMatcher = new personmatcher\PersonMatcherService($this->context, $this->baseUrl);
        }
        return $this->personMatcher;
    }

}

