<?php

namespace org\nameapi\client\services\matcher;

require_once(__DIR__.'/GenderMatchType.php');


class GenderMatcherResult {

    /**
     * @var GenderMatchType $type
     */
    private $matchType = null;

    /**
     * @var float $confidence
     */
    private $confidence = null;

    /**
     * @var string[] $warnings
     */
    private $warnings = null;

    /**
     * @param GenderMatchType $type
     * @param float $confidence
     * @param string[] $warnings
     */
    public function __construct(GenderMatchType $type, $confidence, $warnings) {
        $this->matchType = $type;
        $this->confidence = $confidence;
    }

    /**
     * @return GenderMatchType
     */
    public function getMatchType() {
        return $this->matchType;
    }

    /**
     * @return float
     */
    public function getConfidence() {
        return $this->confidence;
    }

    /**
     * @return string[]
     */
    public function getWarnings() {
        return $this->warnings;
    }

}
