<?php

namespace org\nameapi\client\services\email\emailnameparser;

use org\nameapi\ontology\input\context\Context;

require_once(__DIR__.'/wsdl/SoapEmailNameParserService.php');
require_once(__DIR__.'/EmailNameParserResult.php');

/**
 * This is the service class for the web service offered at
 * http://api.nameapi.org/soap/v4.0/email/emailnameparser?wsdl
 *
 * HOW TO USE:
 * $emailNameParser = $myServiceFactory->emailServices()->emailNameParser();
 * $result = $emailNameParser->parse("john.doe@example.com");
 * echo (string)$result->getDisposable()); //prints 'YES'
 *
 * @since v4.0
 */
class EmailNameParserService {

    private $context;
    private $soapEmailNameParserService;

    public function __construct($apiKey, Context $context, $baseUrl) {
        $this->context = $context;
        $this->soapEmailNameParserService = new wsdl\SoapEmailNameParserService(array(), $baseUrl);
    }

    /**
     * @param string $emailAddress
     * @return EmailNameParserResult
     */
    public function parse($emailAddress) {
        $parameters = new wsdl\EmailNameParserServiceArguments($this->context, $emailAddress);
        $result = $this->soapEmailNameParserService->parse($parameters);
        $matches = array();
        if (isSet($result->return->matches)) {
            foreach ($result->return->matches as $match) {
                $givenNames = array();
                $surnames   = array();
                if (isSet($match->givenNames)) {
                    foreach ($match->givenNames as $name) {
                        array_push($givenNames, new NameFromEmailAddress($name->name, new EmailAddressNameType($name->nameType)));
                    }
                }
                if (isSet($match->surnames)) {
                    foreach ($match->surnames as $name) {
                        array_push($surnames, new NameFromEmailAddress($name->name, new EmailAddressNameType($name->nameType)));
                    }
                }
                array_push($matches, new EmailNameParserMatch($givenNames, $surnames, $match->confidence));
            }
        }
        return new EmailNameParserResult(
            new EmailAddressParsingResultType($result->return->resultType),
            $matches
        );
    }

} 