<?php

namespace org\nameapi\client\services\matcher;

use org\nameapi\ontology\input\context\Context;

require_once(__DIR__.'/personmatcher/PersonMatcherService.php');

/**
 * Provides access to the matcher-related services.
 */
class MatcherServiceFactory {

    private $context;
    private $personMatcher;

    /**
     */
    public function __construct(Context $context) {
        $this->context = $context;
    }

    /**
     * @return personmatcher\PersonMatcherService
     */
    public function personMatcher() {
        if ($this->personMatcher==null) {
            $this->personMatcher = new personmatcher\PersonMatcherService($this->context);
        }
        return $this->personMatcher;
    }

}

