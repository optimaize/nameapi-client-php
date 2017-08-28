<?php

namespace org\nameapi\client\services\parser\personnameparser;

require_once(__DIR__.'/PersonNameParserResult.php');
require_once(__DIR__.'/../../genderizer/persongenderizer/PersonGenderResult.php');

use org\nameapi\client\fault\ServiceException;
use org\nameapi\client\services\BaseService;
use org\nameapi\client\services\parser\OutputPersonName;
use org\nameapi\client\services\parser\OutputTermType;
use org\nameapi\client\services\parser\Term;
use org\nameapi\ontology\input\context\Context;
use org\nameapi\ontology\input\entities\person\NaturalInputPerson;
use org\nameapi\ontology\input\entities\person\PersonType;
use org\nameapi\ontology\input\entities\person\PersonRole;
use org\nameapi\client\services\genderizer\persongenderizer\PersonGenderResult;
use org\nameapi\ontology\input\entities\person\gender\ComputedPersonGender;


/**
 * This is the service class for the web service offered at
 * http://api.nameapi.org/rest/v5.3/parser/personnameparser
 *
 * HOW TO USE:
 * $personNameParser = $myServiceFactory->nameParserServiceFactory()->personNameParser();
 * $parseResult = $personNameParser->parse($myInputPerson);
 *
 * @since v4.0
 */
class PersonNameParserService extends BaseService {

    private static $RESOURCE_PATH = "parser/personnameparser";


    public function __construct($apiKey, Context $context, $baseUrl) {
        parent::__construct($apiKey, $context, $baseUrl);
    }


    /**
     * @param NaturalInputPerson $person
     * @return PersonNameParserResult
     * @throws ServiceException
     */
    public function parse(NaturalInputPerson $person) {
        $queryParams = array();
        $headerParams = array();

        list($response, $httpResponseData) = $this->restHttpClient->callApiPost(
            PersonNameParserService::$RESOURCE_PATH,
            $queryParams, $headerParams,
            array('inputPerson'=>$person, 'context'=>$this->context)
        );

        try {
            $matches = array(); //ParsedPersonMatch
            foreach ($response->matches as $match) {
                $pp = $match->parsedPerson;

                $parsedPerson = $this->extractPerson($pp);

                $parserDisputes = array();
                if (isSet($match->parserDisputes)) {
                    foreach ($match->parserDisputes as $dispute) {
                        array_push($parserDisputes, new ParserDispute(new DisputeType($dispute->disputeType), $dispute->message));
                    }
                }

                $parsedPersonMatch = new ParsedPersonMatch(
                    $parsedPerson,
                    $match->likeliness,
                    $match->confidence,
                    $parserDisputes
                );
                array_push($matches, $parsedPersonMatch);
            }
            return new PersonNameParserResult($matches);
        } catch (\Exception $e) {
            throw $this->unmarshallingFailed($response, $httpResponseData);
        }
    }

    private function extractGender($parsedPerson) {
        if (!isSet($parsedPerson->gender)) {
            return null;
        }
        return new PersonGenderResult(
            new ComputedPersonGender($parsedPerson->gender->gender),
            (isset( $parsedPerson->gender->maleProportion) ?  $parsedPerson->gender->maleProportion : null),
            $parsedPerson->gender->confidence
        );
    }

    private function extractTerms($parsedPerson) {
        $terms = array();
        if (isSet($parsedPerson->outputPersonName) && isSet($parsedPerson->outputPersonName->terms)) {
            foreach ($parsedPerson->outputPersonName->terms as $term) {
                array_push($terms, new Term($term->string, new OutputTermType($term->termType)));
            }
        }
        return new OutputPersonName($terms);
    }

    private function extractPeople($parsedPerson) {
        $people = array();
        if (isSet($parsedPerson->people)) {
            foreach ($parsedPerson->people as $onePerson) {
                $extractedPerson = $this->extractPerson($onePerson);
                array_push($people, $extractedPerson);
            }
        }
        return $people;
    }

    private function extractPerson($pp) {
        $gender = $this->extractGender($pp);
        $outputPersonName = $this->extractTerms($pp);
        $people = $this->extractPeople($pp);
        return new ParsedPerson(
            new PersonType($pp->personType),
            new PersonRole($pp->personRole),
            $gender,
            (isSet($pp->addressingGivenName)) ? $pp->addressingGivenName : null,
            (isSet($pp->addressingSurname)) ? $pp->addressingSurname : null,
            $outputPersonName,
            $people
        );
    }

}
