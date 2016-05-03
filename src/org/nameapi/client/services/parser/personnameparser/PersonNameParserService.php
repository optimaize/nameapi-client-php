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
 * http://api.nameapi.org/rest/v5.0/parser/personnameparser
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
            ['inputPerson'=>$person, 'context'=>$this->context]
        );

        try {
            $matches = array(); //ParsedPersonMatch
            foreach ($response->matches as $match) {
                $gender = null;
                if (isSet($match->parsedPerson->gender)) {
                    $gender = new PersonGenderResult(
                        new ComputedPersonGender($match->parsedPerson->gender->gender),
                        (isset( $match->parsedPerson->gender->maleProportion) ?  $match->parsedPerson->gender->maleProportion : null),
                        $match->parsedPerson->gender->confidence
                    );
                }

                $terms = array();
                if (isSet($match->parsedPerson->outputPersonName->terms)) {
                    foreach ($match->parsedPerson->outputPersonName->terms as $term) {
                        array_push($terms, new Term($term->string, new OutputTermType($term->termType)));
                    }
                }
                $outputPersonName = new OutputPersonName($terms);

                $people = array();
                if (isSet($match->parsedPerson->people)) {
                    foreach ($match->parsedPerson->people as $onePerson) {
                        $terms = array();
                        foreach ($onePerson->terms as $term) {
                            array_push($terms, new Term($term->string, new OutputTermType($term->termType)));
                        }
                        array_push($names, new OutputPersonName($terms));
                    }
                }

                $parsedPerson = new ParsedPerson(
                    new PersonType($match->parsedPerson->personType),
                    new PersonRole($match->parsedPerson->personRole),
                    $gender,
                    (isSet($match->parsedPerson->addressingGivenName)) ? $match->parsedPerson->addressingGivenName : null,
                    (isSet($match->parsedPerson->addressingSurname)) ? $match->parsedPerson->addressingSurname : null,
                    $outputPersonName,
                    $people
                );

                $parserDisputes = array();
                if (isSet($match->parsedPerson->parserDisputes)) {
                    foreach ($match->parsedPerson->parserDisputes as $dispute) {
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

}
