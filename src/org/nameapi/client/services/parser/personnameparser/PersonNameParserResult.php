<?php

namespace org\nameapi\client\services\parser\personnameparser;

require_once(__DIR__.'/ParsedPersonMatch.php');


class PersonNameParserResult {

    /**
     * @var ParsedPersonMatch[] $matches
     */
    private $matches = null;

    public function __construct($matches) {
        if (sizeof($matches)==0) throw new \Exception("At least one match is required!");
        $this->matches = $matches;
    }

    /**
     * Returns a non-empty array if getParsingStatus() is SUCCESS, and null otherwise.
     * @return ParsedPersonMatch[]
     */
    public function getMatches() {
        return $this->matches;
    }

    /**
     * Returns the best match.
     * @return ParsedPersonMatch
     */
    public function getBestMatch() {
        return $this->matches[0];
    }

}
