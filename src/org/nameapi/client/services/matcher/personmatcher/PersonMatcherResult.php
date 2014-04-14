<?php

namespace org\nameapi\client\services\matcher\personmatcher;

use org\nameapi\client\services\matcher\PersonNameMatcherResult;
use org\nameapi\client\services\matcher\GenderMatcherResult;
use org\nameapi\client\services\matcher\AgeMatcherResult;

require_once(__DIR__.'/PersonMatchType.php');
require_once(__DIR__.'/PersonMatchComposition.php');
require_once(__DIR__.'/../PersonNameMatcherResult.php');
require_once(__DIR__.'/../GenderMatcherResult.php');
require_once(__DIR__.'/../AgeMatcherResult.php');


class PersonMatcherResult {

    /**
     * @var PersonMatchType $personMatchType
     */
    private $matchType = null;

    /**
     * @var PersonMatchComposition $personMatchComposition
     */
    private $matchComposition = null;

    /**
     * @var float $points
     */
    private $points = null;

    /**
     * @var float $confidence
     */
    private $confidence = null;

    /**
     * @var PersonNameMatcherResult $personNameMatcherResult
     */
    private $personNameMatcherResult = null;

    /**
     * @var GenderMatcherResult $genderMatcherResult
     */
    private $genderMatcherResult = null;

    /**
     * @var AgeMatcherResult $ageMatcherResult
     */
    private $ageMatcherResult = null;

    /**
     *
     * @param PersonMatchType $personMatchType
     * @param PersonMatchComposition $personMatchComposition
     * @param float $points
     * @param float $confidence
     * @param PersonNameMatcherResult $personNameMatch
     * @param GenderMatcherResult $genderMatch
     * @param AgeMatcherResult $ageMatch
     */
    public function __construct($personMatchType, $personMatchComposition, $points, $confidence, $personNameMatch, $genderMatch, $ageMatch) {
        $this->matchType = $personMatchType;
        $this->matchComposition = $personMatchComposition;
        $this->points = $points;
        $this->confidence = $confidence;
        $this->personNameMatcherResult = $personNameMatch;
        $this->genderMatcherResult = $genderMatch;
        $this->ageMatcherResult = $ageMatch;
    }


    /**
     * @return PersonMatchType
     */
    public function getMatchType() {
        return $this->matchType;
    }

    /**
     * @return PersonMatchComposition
     */
    public function getMatchComposition() {
        return $this->matchComposition;
    }

    /**
     *
     * @return float
     */
    public function getPoints() {
        return $this->points;
    }

    /**
     *
     * @return float
     */
    public function getConfidence() {
        return $this->confidence;
    }

    /**
     *
     * @return PersonNameMatcherResult
     */
    public function getPersonNameMatcherResult() {
        return $this->personNameMatcherResult;
    }

    /**
     *
     * @return GenderMatcherResult
     */
    public function getGenderMatcherResult() {
        return $this->genderMatcherResult;
    }

    /**
     * @return AgeMatcherResult
     */
    public function getAgeMatcherResult() {
        return $this->ageMatcherResult;
    }

}
