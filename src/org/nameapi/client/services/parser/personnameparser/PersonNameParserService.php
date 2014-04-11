<?php

namespace org\nameapi\client\services\parser\personnameparser;

use org\nameapi\ontology\input\context\Context;
use org\nameapi\ontology\input\entities\person\NaturalInputPerson;
use org\nameapi\ontology\input\entities\person\PersonType;

use org\nameapi\client\services\parser\ParsingStatus;
use org\nameapi\client\services\parser\OutputTermType;
use org\nameapi\client\services\parser\Term;
use org\nameapi\client\services\parser\OutputPersonName;

require_once('wsdl/SoapPersonNameParserService.php');
require_once('PersonNameParserResult.php');


/**
 * This is the service class for the web service offered at
 * http://api.nameapi.org/soap/v4.0/parser/personnameparser?wsdl
 *
 * HOW TO USE:
 * $personNameParser = $myServiceFactory->nameParserServiceFactory()->personNameParser();
 * $parseResult = $personNameParser->parse($myInputPerson);
 */
class PersonNameParserService {

    private $context;
    private $soapPersonNameParser;

    /**
     * @access public
     */
    public function __construct(Context $context) {
        $this->context = $context;
        $this->soapPersonNameParser = new wsdl\SoapPersonNameParserService();
    }

    /**
     * @param NaturalInputPerson $person
     * @return PersonNameParserResult
     */
    public function parse(NaturalInputPerson $person) {
        $parameters = new wsdl\ParseArguments($this->context, $person);
        $result = $this->soapPersonNameParser->parse($parameters);
        $parsingStatus = new ParsingStatus($result->parsingStatus);
        $errorMessage = ((string)$parsingStatus==='FAILURE') ? $result->errorMessage : null;
        $matches = null;
        if ($parsingStatus->isSuccess()) {
            $matches = array(); //ParsedPersonMatch
            foreach ($result->parsedPersonMatches as $match) {
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
        }
        return new PersonNameParserResult($parsingStatus, $errorMessage, $matches);
    }

}
