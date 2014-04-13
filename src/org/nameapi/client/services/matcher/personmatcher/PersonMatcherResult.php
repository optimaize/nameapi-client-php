<?php

namespace org\nameapi\client\services\matcher\personmatcher;

use org\nameapi\client\services\matcher\PersonNameMatch;
use org\nameapi\client\services\matcher\GenderMatch;
use org\nameapi\client\services\matcher\AgeMatch;

require_once(__DIR__.'/PersonMatchType.php');
require_once(__DIR__.'/PersonMatchComposition.php');
require_once(__DIR__.'/../PersonNameMatch.php');
require_once(__DIR__.'/../GenderMatch.php');
require_once(__DIR__.'/../AgeMatch.php');


class PersonMatcherResult {

    /**
     * @var PersonMatchType $personMatchType
     */
    private $personMatchType = null;

    /**
     * @var PersonMatchComposition $personMatchComposition
     */
    private $personMatchComposition = null;

    /**
     * @var float $points
     */
    private $points = null;

    /**
     * @var float $confidence
     */
    private $confidence = null;

    /**
     * @var PersonNameMatch $personNameMatch
     */
    private $personNameMatch = null;

    /**
     * @var GenderMatch $genderMatch
     */
    private $genderMatch = null;

    /**
     * @var AgeMatch $ageMatch
     */
    private $ageMatch = null;

    /**
     *
     * @param PersonMatchType $personMatchType
     * @param PersonMatchComposition $personMatchComposition
     * @param float $points
     * @param float $confidence
     * @param PersonNameMatch $personNameMatch
     * @param GenderMatch $genderMatch
     * @param AgeMatch $ageMatch
     */
    public function __construct($personMatchType, $personMatchComposition, $points, $confidence, $personNameMatch, $genderMatch, $ageMatch) {
        $this->personMatchType = $personMatchType;
        $this->personMatchComposition = $personMatchComposition;
        $this->points = $points;
        $this->confidence = $confidence;
        $this->personNameMatch = $personNameMatch;
        $this->genderMatch = $genderMatch;
        $this->ageMatch = $ageMatch;
    }


    /**
     * @return PersonMatchType
     */
    public function getPersonMatchType() {
        return $this->personMatchType;
    }

    /**
     * @return PersonMatchComposition
     */
    public function getPersonMatchComposition() {
        return $this->personMatchComposition;
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
     * @return PersonNameMatch
     */
    public function getPersonNameMatch() {
        return $this->personNameMatch;
    }

    /**
     *
     * @return GenderMatch
     */
    public function getGenderMatch() {
        return $this->genderMatch;
    }

    /**
     * @return AgeMatch
     */
    public function getAgeMatch() {
        return $this->ageMatch;
    }

}
