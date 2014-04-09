<?php

namespace org\nameapi\client\services\parser\personnameparser;

use org\nameapi\client\services\parser\ParsingStatus;

require_once(__DIR__.'/../ParsingStatus.php');
require_once('ParsedPersonMatch.php');


class PersonNameParserResult {

    /**
     * @var ParsingStatus
     */
    private $parsingStatus = null;

    /**
     * @var string $errorMessage
     */
    private $errorMessage = null;

    /**
     * @var ParsedPersonMatch[] $matches
     */
    private $matches = null;

    public function __construct(ParsingStatus $parsingStatus, $errorMessage, $matches) {
        $this->parsingStatus = $parsingStatus;
        $this->errorMessage  = $errorMessage;
        $this->matches       = $matches;
    }

    /**
     * Tells whether parsing was successful or not.
     * @return ParsingStatus
     */
    public function getParsingStatus() {
        return $this->parsingStatus;
    }

    /**
     * Returns a string error message if getParsingStatus() is FAILURE, and null otherwise.
     * @return string
     */
    public function getErrorMessage() {
        return $this->errorMessage;
    }

    /**
     * Returns a non-empty array if getParsingStatus() is SUCCESS, and null otherwise.
     * @return ParsedPersonMatch[]
     */
    public function getMatches() {
        return $this->matches;
    }

    /**
     * Returns the best match, or null if none.
     * @return ParsedPersonMatch
     */
    public function getBestMatch() {
        if (!$this->matches) return null;
        return $this->matches[0];
    }

}
