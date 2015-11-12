<?php

namespace org\nameapi\client\services\matcher\personmatcher;

use org\nameapi\ontology\input\context\Context;
use org\nameapi\ontology\input\entities\person\NaturalInputPerson;
use org\nameapi\client\services\matcher\PersonNameMatchType;

use org\nameapi\client\services\matcher\PersonNameMatcherResult;
use org\nameapi\client\services\matcher\GenderMatcherResult;
use org\nameapi\client\services\matcher\GenderMatchType;
use org\nameapi\client\services\matcher\AgeMatcherResult;
use org\nameapi\client\services\matcher\AgeMatchType;
use org\nameapi\client\lib\RestHttpClient;
use org\nameapi\client\lib\Configuration;
use org\nameapi\client\lib\ApiException;

require_once(__DIR__.'/PersonMatcherResult.php');


/**
 * This is the service class for the web service offered at
 * http://api.nameapi.org/rest/v5.0/matcher/personmatcher
 *
 * HOW TO USE:
 * $personMatcher = $myServiceFactory->matcherServiceFactory()->personMatcher();
 * $matchResult = $personMatcher->match($myInputPerson1, $myInputPerson2);
 *
 * @since v4.0
 */
class PersonMatcherService {

    private static $RESOURCE_PATH = "matcher/personmatcher";

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
     * @param NaturalInputPerson $person1
     * @param NaturalInputPerson $person2
     * @return PersonMatcherResult
     */
    public function match(NaturalInputPerson $person1, NaturalInputPerson $person2) {
        $queryParams = array();
        $headerParams = array();

        list($response, $httpHeader) = $this->restHttpClient->callApiPost(
            PersonMatcherService::$RESOURCE_PATH,
            $queryParams,
            $headerParams,
            ['inputPerson1'=>$person1, 'inputPerson2'=>$person2, 'context'=>$this->context]
        );

        try {
            return new PersonMatcherResult(
                new PersonMatchType($response->matchType),
                new PersonMatchComposition($response->personMatchComposition),
                $response->points, $response->confidence,
                new PersonNameMatcherResult(new PersonNameMatchType($response->personNameMatcherResult->matchType)),
                new GenderMatcherResult(
                    new GenderMatchType($response->genderMatcherResult->matchType),
                    isSet($response->genderMatcherResult->confidence) ? $response->genderMatcherResult->confidence : null,
                    isSet($response->genderMatcherResult->warnings) ? $response->genderMatcherResult->warnings : null
                ),
                new AgeMatcherResult(new AgeMatchType($response->ageMatcherResult->matchType))
            );
        } catch (\Exception $e) {
            throw new ApiException("Server sent unexpected or unsupported response: ".$e->getMessage(), 500);
        }
    }

}
