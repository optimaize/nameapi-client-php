<?php

namespace Org\NameApi\Client\Services\Matcher\PersonMatcher;

use Org\NameApi\Client\Services\Matcher\AgeMatcherResult;
use Org\NameApi\Client\Services\Matcher\GenderMatcherResult;
use Org\NameApi\Client\Services\Matcher\PersonNameMatcherResult;

class PersonMatcherResult
{

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
    public function __construct($personMatchType, $personMatchComposition, $points, $confidence, $personNameMatch, $genderMatch, $ageMatch)
    {
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
    public function getMatchType()
    {
        return $this->matchType;
    }

    /**
     * @return PersonMatchComposition
     */
    public function getMatchComposition()
    {
        return $this->matchComposition;
    }

    /**
     *
     * @return float
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     *
     * @return float
     */
    public function getConfidence()
    {
        return $this->confidence;
    }

    /**
     *
     * @return PersonNameMatcherResult
     */
    public function getPersonNameMatcherResult()
    {
        return $this->personNameMatcherResult;
    }

    /**
     *
     * @return GenderMatcherResult
     */
    public function getGenderMatcherResult()
    {
        return $this->genderMatcherResult;
    }

    /**
     * @return AgeMatcherResult
     */
    public function getAgeMatcherResult()
    {
        return $this->ageMatcherResult;
    }

}
