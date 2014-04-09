<?php

namespace org\nameapi\client\services\matcher\personmatcher;

use org\nameapi\ontology\input\context\Context;
use org\nameapi\ontology\input\entities\person\NaturalInputPerson;
use org\nameapi\client\services\matcher\PersonNameMatchType;

use org\nameapi\client\services\matcher\PersonNameMatch;
use org\nameapi\client\services\matcher\GenderMatch;
use org\nameapi\client\services\matcher\GenderMatchType;
use org\nameapi\client\services\matcher\AgeMatch;

require_once('wsdl/SoapPersonMatcherService.php');
require_once('PersonMatchResult.php');


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
    public function __construct(Context $context) {
        $this->context = $context;
        $this->soapPersonMatcher = new wsdl\SoapPersonMatcherService();
    }

    /**
     * @param NaturalInputPerson $person1
     * @param NaturalInputPerson $person2
     * @return PersonMatchResult
     */
    public function match(NaturalInputPerson $person1, NaturalInputPerson $person2) {
        $parameters = new wsdl\MatchArguments($this->context, $person1, $person2);
        $result = $this->soapPersonMatcher->match($parameters);

        $genderWarnings = isSet($result->genderMatch->warnings) ? $result->genderMatch->warnings : null;

        return new PersonMatchResult(
            new PersonMatchType($result->personMatchType),
            new PersonMatchComposition($result->personMatchComposition),
            $result->points, $result->confidence,
            new PersonNameMatch(new PersonNameMatchType($result->personNameMatch->type)),
            new GenderMatch(new GenderMatchType($result->genderMatch->type), $result->genderMatch->confidence, $genderWarnings),
            new AgeMatch($result->ageMatch)
        );
    }

}
