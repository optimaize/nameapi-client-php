<?php

namespace Org\NameApi\Client\Services\Parser\PersonNameParser;

use Org\NameApi\Client\Fault\ServiceException;
use Org\NameApi\Client\Services\BaseService;
use Org\NameApi\Client\Services\Genderizer\PersonGenderizer\PersonGenderResult;
use Org\NameApi\Client\Services\Parser\OutputPersonName;
use Org\NameApi\Client\Services\Parser\OutputTermType;
use Org\NameApi\Client\Services\Parser\Term;
use Org\NameApi\Ontology\Input\Context\Context;
use Org\NameApi\Ontology\Input\Entities\Person\Gender\ComputedPersonGender;
use Org\NameApi\Ontology\Input\Entities\Person\NaturalInputPerson;
use Org\NameApi\Ontology\Input\Entities\Person\PersonRole;
use Org\NameApi\Ontology\Input\Entities\Person\PersonType;


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
class PersonNameParserService extends BaseService
{

    private static $RESOURCE_PATH = "parser/personnameparser";


    public function __construct($apiKey, Context $context, $baseUrl)
    {
        parent::__construct($apiKey, $context, $baseUrl);
    }


    /**
     * @param  NaturalInputPerson  $person
     * @return PersonNameParserResult
     * @throws ServiceException
     */
    public function parse(NaturalInputPerson $person)
    {
        $queryParams = array();
        $headerParams = array();

        list($response, $httpResponseData) = $this->restHttpClient->callApiPost(
            PersonNameParserService::$RESOURCE_PATH,
            $queryParams, $headerParams,
            array('inputPerson' => $person->toArray(), 'context' => $this->context->toArray())
        );

        try {
            $matches = array(); //ParsedPersonMatch
            foreach ($response->matches as $match) {
                $pp = $match->parsedPerson;

                $parsedPerson = $this->extractPerson($pp);

                $parserDisputes = array();
                if (isset($match->parserDisputes)) {
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

    private function extractPerson($pp)
    {
        $gender = $this->extractGender($pp);
        $outputPersonName = $this->extractTerms($pp);
        $people = $this->extractPeople($pp);
        return new ParsedPerson(
            new PersonType($pp->personType),
            new PersonRole($pp->personRole),
            $gender,
            (isset($pp->addressingGivenName)) ? $pp->addressingGivenName : null,
            (isset($pp->addressingSurname)) ? $pp->addressingSurname : null,
            $outputPersonName,
            $people
        );
    }

    private function extractGender($parsedPerson)
    {
        if (!isset($parsedPerson->gender)) {
            return null;
        }
        return new PersonGenderResult(
            new ComputedPersonGender($parsedPerson->gender->gender),
            (isset($parsedPerson->gender->maleProportion) ? $parsedPerson->gender->maleProportion : null),
            $parsedPerson->gender->confidence
        );
    }

    private function extractTerms($parsedPerson)
    {
        $terms = array();
        if (isset($parsedPerson->outputPersonName) && isset($parsedPerson->outputPersonName->terms)) {
            foreach ($parsedPerson->outputPersonName->terms as $term) {
                array_push($terms, new Term($term->string, new OutputTermType($term->termType)));
            }
        }
        return new OutputPersonName($terms);
    }

    private function extractPeople($parsedPerson)
    {
        $people = array();
        if (isset($parsedPerson->people)) {
            foreach ($parsedPerson->people as $onePerson) {
                $extractedPerson = $this->extractPerson($onePerson);
                array_push($people, $extractedPerson);
            }
        }
        return $people;
    }

}
