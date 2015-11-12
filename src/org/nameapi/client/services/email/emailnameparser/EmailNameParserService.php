<?php

namespace org\nameapi\client\services\email\emailnameparser;

use org\nameapi\ontology\input\context\Context;
use org\nameapi\client\lib\RestHttpClient;
use org\nameapi\client\lib\Configuration;
use org\nameapi\client\lib\ApiException;

require_once(__DIR__.'/EmailNameParserResult.php');

/**
 * This is the service class for the web service offered at
 * http://api.nameapi.org/rest/v5.0/email/emailnameparser
 *
 * HOW TO USE:
 * $emailNameParser = $myServiceFactory->emailServices()->emailNameParser();
 * $result = $emailNameParser->parse("john.doe@example.com");
 *
 * @since v4.0
 */
class EmailNameParserService {

    private static $RESOURCE_PATH = "email/emailnameparser";

    private $context;

    /**
     * @var RestHttpClient
     */
    private $restHttpClient;


    public function __construct($apiKey, Context $context, $baseUrl) {
        $this->context = $context;
        $configuration = new Configuration();
        $configuration->setApiKey($apiKey);
        $configuration->setBaseUrl($baseUrl);
        $this->restHttpClient = new RestHttpClient($configuration);
    }

    /**
     * @param string $emailAddress
     * @return EmailNameParserResult
     */
    public function parse($emailAddress) {
        $queryParams = array(
            'emailAddress'=>$emailAddress
        );
        $headerParams = array();

        list($response, $httpHeader) = $this->restHttpClient->callApiGet(
            EmailNameParserService::$RESOURCE_PATH,
            $queryParams,
            $headerParams
        );
        try {
            $matches = array();
            if (isSet($response->nameMatches)) {
                foreach ($response->nameMatches as $match) {
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
                new EmailAddressParsingResultType($response->resultType),
                $matches
            );
        } catch (\Exception $e) {
            throw new ApiException("Server sent unexpected or unsupported response: ".$e->getMessage(), 500);
        }
    }

} 