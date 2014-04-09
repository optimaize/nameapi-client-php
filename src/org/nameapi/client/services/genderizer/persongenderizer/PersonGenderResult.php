<?php

namespace org\nameapi\client\services\genderizer\persongenderizer;

use \org\nameapi\ontology\input\entities\person\gender\ComputedPersonGender;

class PersonGenderResult {

    /**
     * @var ComputedPersonGender
     */
    private $gender = null;

    /**
     * @var float $maleProportion
     */
    private $maleProportion = null;

    /**
     * @var float $confidence
     */
    private $confidence = null;

    /**
     * @param float $confidence
     * @param ComputedPersonGender $gender
     * @param float $maleProportion
     */
    public function __construct(ComputedPersonGender $gender, $maleProportion, $confidence) {
        $this->gender = $gender;
        $this->maleProportion = $maleProportion;
        $this->confidence = $confidence;
    }

    /**
     * @return ComputedPersonGender
     */
    public function getGender() {
        return $this->gender;
    }

    /**
     * Only of interest if getGender() returns NEUTRAL. And even then it may be null (unknown).
     * @return float null if inapplicable or unknown.
     *         Range 0-1, 0.5 is neutral, high above is more male and closer to 0 is more female).
     */
    public function getMalePercent() {
        return $this->maleProportion;
    }

    /**
     * @return float 0-1, the higher the better.
     */
    public function getConfidence() {
        return $this->confidence;
    }

}
