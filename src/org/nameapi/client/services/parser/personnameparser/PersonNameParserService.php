<?php

namespace org\nameapi\client\services\parser\personnameparser;

use org\nameapi\ontology\input\context\Context;
use org\nameapi\ontology\input\entities\person\NaturalInputPerson;
use org\nameapi\ontology\input\entities\person\PersonType;
use org\nameapi\client\lib\RestHttpClient;
use org\nameapi\client\lib\Configuration;
use org\nameapi\client\lib\ApiException;

use org\nameapi\client\services\parser\OutputTermType;
use org\nameapi\client\services\parser\Term;
use org\nameapi\client\services\parser\OutputPersonName;

require_once(__DIR__.'/PersonNameParserResult.php');


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
class PersonNameParserService {

    private static $RESOURCE_PATH = "parser/personnameparser";

    private $context;

    /**
     * @var RestHttpClient
     */
    private $restHttpClient;


    /**
     * @access public
     */
    public function __construct($apiKey, Context $context, $baseUrl) {
        $this->context = $context;
        $configuration = new Configuration();
        $configuration->setApiKey($apiKey);
        $configuration->setBaseUrl($baseUrl);
        $this->restHttpClient = new RestHttpClient($configuration);
    }

    /**
     * @param NaturalInputPerson $person
     * @return PersonNameParserResult
     */
    public function parse(NaturalInputPerson $person) {
        $queryParams = array();
        $headerParams = array();

        list($response, $httpHeader) = $this->restHttpClient->callApiPost(
            PersonNameParserService::$RESOURCE_PATH,
            $queryParams,
            $headerParams,
            ['inputPerson'=>$person, 'context'=>$this->context]
        );

        try {
            $matches = array(); //ParsedPersonMatch
            foreach ($response->matches as $match) {
                $names = array();
                foreach ($match->parsedPerson->names as $name) {
                    $terms = array();
                    foreach ($name->terms as $term) {
                        array_push($terms, new Term($term->string, new OutputTermType($term->termType)));
                    }
                    array_push($names, new OutputPersonName($terms));
                }
                $parsedPerson = new ParsedPerson(new PersonType($match->parsedPerson->personType), $names);
                $parsedPersonMatch = new ParsedPersonMatch($parsedPerson, $match->likeliness, $match->confidence);
                array_push($matches, $parsedPersonMatch);
            }
            return new PersonNameParserResult($matches);
        } catch (\Exception $e) {
            throw new ApiException("Server sent unexpected or unsupported response: ".$e->getMessage(), 500);
        }
    }

}
