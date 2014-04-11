<?php

namespace org\nameapi\client\services\email\emailnameparser;

require_once('NameFromEmailAddress.php');

/**
 * One way (and ideally the only way) of parsing an email address.
 */
class EmailNameParserMatch {

    /**
     * @var NameFromEmailAddress[] $givenNames
     */
    private $givenNames = null;

    /**
     * @var NameFromEmailAddress[] $surnames
     */
    private $surnames = null;

    /**
     * @var float $confidence
     */
    private $confidence = null;


    /**
     * @param NameFromEmailAddress[] $givenNames
     * @param NameFromEmailAddress[] $surnames
     * @param float $confidence
     */
    public function __construct($givenNames, $surnames, $confidence) {
        $this->givenNames = $givenNames;
        $this->surnames = $surnames;
        $this->confidence = $confidence;
    }

    /**
     * @return NameFromEmailAddress[]
     */
    public function getGivenNames() {
        return $this->givenNames;
    }

    /**
     * @return NameFromEmailAddress[]
     */
    public function getSurnames() {
        return $this->surnames;
    }

    /**
     * @return float 0-1
     */
    public function getConfidence() {
        return $this->confidence;
    }

    public function __toString() {
        $ret  = '{';
        $ret .= 'givenNames='. implode(", ",$this->givenNames);
        $ret .= ', surnames='. implode(", ",$this->surnames);
        $ret .= ', confidence='.$this->confidence;
        return $ret.'}';
    }
} 