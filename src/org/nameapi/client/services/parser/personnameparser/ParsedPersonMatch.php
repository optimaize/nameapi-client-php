<?php

namespace org\nameapi\client\services\parser\personnameparser;

require_once(__DIR__.'/ParsedPerson.php');

class ParsedPersonMatch {

    /**
     * @var ParsedPerson $parsedPerson
     */
    private $parsedPerson = null;

    /**
     * @var float $likeliness
     */
    private $likeliness = null;

    /**
     * @var float $confidence
     */
    private $confidence = null;

    /**
     * @param ParsedPerson $parsedPerson
     * @param float $likeliness
     * @param float $confidence
     * @access public
     */
    public function __construct($parsedPerson, $likeliness, $confidence) {
        $this->parsedPerson = $parsedPerson;
        $this->likeliness = $likeliness;
        $this->confidence = $confidence;
    }

    /**
     * @return ParsedPerson
     */
    public function getParsedPerson() {
        return $this->parsedPerson;
    }

    /**
     * @return float 0-1
     */
    public function getLikeliness() {
        return $this->likeliness;
    }

    /**
     * @return float 0-1
     */
    public function getConfidence() {
        return $this->confidence;
    }

}
