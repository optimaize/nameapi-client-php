<?php

namespace org\nameapi\client\services\matcher\personmatcher;

use org\nameapi\ontology\input\context\Context;
use org\nameapi\ontology\input\entities\person\NaturalInputPerson;
use org\nameapi\client\services\matcher\PersonNameMatchType;

use org\nameapi\client\services\matcher\PersonNameMatcherResult;
use org\nameapi\client\services\matcher\GenderMatcherResult;
use org\nameapi\client\services\matcher\GenderMatchType;
use org\nameapi\client\services\matcher\AgeMatcherResult;
use org\nameapi\client\services\matcher\AgeMatchType;

require_once(__DIR__.'/wsdl/SoapPersonMatcherService.php');
require_once(__DIR__.'/PersonMatcherResult.php');


/**
 * This is the service class for the web service offered at
 * http://api.nameapi.org/soap/v4.0/matcher/personmatcher?wsdl
 *
 * HOW TO USE:
 * $personMatcher = $myServiceFactory->matcherServiceFactory()->personMatcher();
 * $matchResult = $personMatcher->match($myInputPerson1, $myInputPerson2);
 */
class PersonMatcherService {

    private $context;
    private $soapPersonMatcher;

    /**
     * @access public
     */
    public function __construct(Context $context, $baseUrl) {
        $this->context = $context;
        $this->soapPersonMatcher = new wsdl\SoapPersonMatcherService(array(), $baseUrl);
    }

    /**
     * @param NaturalInputPerson $person1
     * @param NaturalInputPerson $person2
     * @return PersonMatcherResult
     */
    public function match(NaturalInputPerson $person1, NaturalInputPerson $person2) {
        $parameters = new wsdl\MatchArguments($this->context, $person1, $person2);
        $result = $this->soapPersonMatcher->match($parameters);

        $genderWarnings = isSet($result->genderMatcherResult->warnings) ? $result->genderMatcherResult->warnings : null;

        return new PersonMatcherResult(
            new PersonMatchType($result->matchType),
            new PersonMatchComposition($result->matchComposition),
            $result->points, $result->confidence,
            new PersonNameMatcherResult(new PersonNameMatchType($result->personNameMatcherResult->matchType)),
            new GenderMatcherResult(new GenderMatchType($result->genderMatcherResult->matchType), $result->genderMatcherResult->confidence, $genderWarnings),
            new AgeMatcherResult(new AgeMatchType($result->ageMatcherResult->matchType))
        );
    }

}
