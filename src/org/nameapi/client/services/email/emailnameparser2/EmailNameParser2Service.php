<?php

namespace org\nameapi\client\services\email\emailnameparser2;

use org\nameapi\ontology\input\context\Context;
use org\nameapi\client\services\email\emailnameparser\wsdl\EmailNameParserServiceArguments;
use org\nameapi\client\services\email\emailnameparser\NameFromEmailAddress;
use org\nameapi\client\services\email\emailnameparser\EmailAddressNameType;
use org\nameapi\client\services\email\emailnameparser\EmailNameParserMatch;

require_once(__DIR__.'/wsdl/SoapEmailNameParser2Service.php');
require_once(__DIR__.'/EmailNameParser2Result.php');
require_once(__DIR__.'/../emailnameparser/wsdl/EmailNameParserServiceArguments.php');
require_once(__DIR__.'/../emailnameparser/NameFromEmailAddress.php');
require_once(__DIR__.'/../emailnameparser/EmailAddressNameType.php');
require_once(__DIR__.'/../emailnameparser/EmailNameParserMatch.php');

/**
 * This is the service class for the web service offered at
 * http://api.nameapi.org/soap/v4.1/email/emailnameparser2?wsdl
 *
 * HOW TO USE:
 * $emailNameParser2 = $myServiceFactory->emailServices()->emailNameParser2();
 * $result = $emailNameParser2->parse("john.doe@example.com");
 * echo (string)$result->getDisposable()); //prints 'YES'
 *
 * @since v4.1
 */
class EmailNameParser2Service {

    private $context;
    private $soapEmailNameParserService;

    public function __construct(Context $context, $baseUrl) {
        $this->context = $context;
        $this->soapEmailNameParserService = new wsdl\SoapEmailNameParser2Service(array(), $baseUrl);
    }

    /**
     * @param string $emailAddress
     * @return EmailNameParser2Result
     */
    public function parse($emailAddress) {
        $parameters = new EmailNameParserServiceArguments($this->context, $emailAddress);
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
        return new EmailNameParser2Result(
            new EmailAddressParsingResultType2($result->return->resultType),
            $matches
        );
    }

} 