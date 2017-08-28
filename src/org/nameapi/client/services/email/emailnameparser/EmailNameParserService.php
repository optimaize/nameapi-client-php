<?php

namespace org\nameapi\client\services\email\emailnameparser;

use org\nameapi\client\fault\ServiceException;
use org\nameapi\client\services\BaseService;
use org\nameapi\ontology\input\context\Context;

require_once(__DIR__.'/EmailNameParserResult.php');

/**
 * This is the service class for the web service offered at
 * http://api.nameapi.org/rest/v5.3/email/emailnameparser
 *
 * HOW TO USE:
 * $emailNameParser = $myServiceFactory->emailServices()->emailNameParser();
 * $result = $emailNameParser->parse("john.doe@example.com");
 *
 * @since v4.0
 */
class EmailNameParserService extends BaseService {

    private static $RESOURCE_PATH = "email/emailnameparser";

    public function __construct($apiKey, Context $context, $baseUrl) {
        parent::__construct($apiKey, $context, $baseUrl);
    }


    /**
     * @param string $emailAddress
     * @return EmailNameParserResult
     * @throws ServiceException
     */
    public function parse($emailAddress) {
        $queryParams = array(
            'emailAddress'=>$emailAddress
        );
        $headerParams = array();

        list($response, $httpResponseData) = $this->restHttpClient->callApiGet(
            EmailNameParserService::$RESOURCE_PATH,
            $queryParams, $headerParams
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
            throw $this->unmarshallingFailed($response, $httpResponseData);
        }
    }

} 