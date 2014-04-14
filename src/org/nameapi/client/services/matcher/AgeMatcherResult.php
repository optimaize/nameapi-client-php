<?php

namespace org\nameapi\client\services\matcher;

require_once(__DIR__.'/AgeMatchType.php');

class AgeMatcherResult {

    /**
     * @var AgeMatchType
     */
    private $matchType;

    function __construct($matchType) {
        $this->matchType = $matchType;
    }

    /**
     * @return AgeMatchType
     */
    public function getMatchType() {
        return $this->matchType;
    }

}