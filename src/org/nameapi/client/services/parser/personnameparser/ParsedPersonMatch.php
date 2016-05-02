<?php

namespace org\nameapi\client\services\parser\personnameparser;

require_once(__DIR__.'/ParsedPerson.php');
require_once(__DIR__.'/ParserDispute.php');

class ParsedPersonMatch {

    /**
     * @var ParsedPerson $parsedPerson
     */
    private $parsedPerson = null;

    /**
     * @var ParserDispute[] $parserDisputes
     */
    private $parserDisputes = null;

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
     * @param $parserDisputes
     * @access public
     */
    public function __construct(ParsedPerson $parsedPerson, $likeliness, $confidence, $parserDisputes) {
        $this->parsedPerson = $parsedPerson;
        $this->likeliness = $likeliness;
        $this->confidence = $confidence;
        $this->parserDisputes = $parserDisputes;
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

    /**
     * Usually empty, that's good.
     * @return ParserDispute[]
     */
    public function getParserDisputes() {
        return $this->parserDisputes;
    }

}
