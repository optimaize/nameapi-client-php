<?php

namespace org\nameapi\client\services;

use org\nameapi\ontology\input\context\Context;

require_once(__DIR__.'/BaseService.php');
require_once(__DIR__.'/Host.php');
require_once(__DIR__.'/development/DevelopmentServiceFactory.php');
require_once(__DIR__.'/system/SystemServiceFactory.php');
require_once(__DIR__.'/parser/ParserServiceFactory.php');
require_once(__DIR__.'/genderizer/GenderizerServiceFactory.php');
require_once(__DIR__.'/matcher/MatcherServiceFactory.php');
require_once(__DIR__.'/formatter/FormatterServiceFactory.php');
require_once(__DIR__.'/email/EmailServiceFactory.php');
require_once(__DIR__.'/riskdetector/RiskDetectorServiceFactory.php');

require_once(__DIR__.'/../http/RestHttpClient.php');

require_once(__DIR__.'/../../ontology/input/context/Context.php');
require_once(__DIR__.'/../../ontology/input/entities/contact/EmailAddressFactory.php');
require_once(__DIR__.'/../../ontology/input/entities/contact/TelNumberFactory.php');
require_once(__DIR__.'/../../ontology/input/entities/person/NaturalInputPersonBuilder.php');
require_once(__DIR__.'/../../ontology/input/entities/address/StructuredAddressBuilder.php');
require_once(__DIR__.'/../../ontology/input/entities/address/UseForAllAddressRelation.php');



/**
 *
 */
class ServiceFactory {

    private $apiKey;

    private $context;

    private $host;

    /**
     * Set to the "latest stable" version,
     * @var string
     */
    private $apiVersion;

    /**
     * Either 'rest' or 'soap'.
     * @var string
     */
    private $technology = 'rest';

    /**
     * Something like 'http://api.nameapi.org/rest/v5.3/'
     * Gets constructed based on other attributes in here.
     */
    private $baseUrl;

    private $developmentServiceFactory;
    private $systemServiceFactory;
    private $parserServiceFactory;
    private $genderizerServiceFactory;
    private $matcherServiceFactory;
    private $formatterServiceFactory;
    private $emailServiceFactory;
    private $riskServiceFactory;


    /**
     * @var $apiKey
     * @var $context
     * @var $host defaults to Host::standard()
     * @var $apiVersion default is the "latest stable", currently that is 5.3.
     *      You want to change this to target another version, for example a release candidate or a development version.
     */
    public function __construct($apiKey, Context $context, Host $host=null, $apiVersion=null) {
        $this->apiKey = $apiKey;
        $this->context = $context;
        if ($host==null) {
            $this->host = Host::standard();
        } else {
            $this->host = $host;
        }
        if ($apiVersion==null) {
            $this->apiVersion = '5.0';
        } else {
            $this->apiVersion = $apiVersion;
        }
        $this->baseUrl = $this->host->toString() . '/'.$this->technology.'/v'.$this->apiVersion.'/';
    }


    /**
     * @return development\DevelopmentServiceFactory
     */
    public function developmentServices() {
        if ($this->developmentServiceFactory==null) {
            $this->developmentServiceFactory = new development\DevelopmentServiceFactory($this->apiKey, $this->context, $this->baseUrl);
        }
        return $this->developmentServiceFactory;
    }

    /**
     * @return system\SystemServiceFactory
     */
    public function systemServices() {
        if ($this->systemServiceFactory==null) {
            $this->systemServiceFactory = new system\SystemServiceFactory($this->apiKey, $this->context, $this->baseUrl);
        }
        return $this->systemServiceFactory;
    }

    /**
     * @return parser\ParserServiceFactory
     */
    public function parserServices() {
        if ($this->parserServiceFactory==null) {
            $this->parserServiceFactory = new parser\ParserServiceFactory($this->apiKey, $this->context, $this->baseUrl);
        }
        return $this->parserServiceFactory;
    }

    /**
     * @return genderizer\GenderizerServiceFactory
     */
    public function genderizerServices() {
        if ($this->genderizerServiceFactory==null) {
            $this->genderizerServiceFactory = new genderizer\GenderizerServiceFactory($this->apiKey, $this->context, $this->baseUrl);
        }
        return $this->genderizerServiceFactory;
    }

    /**
     * @return matcher\MatcherServiceFactory
     */
    public function matcherServices() {
        if ($this->matcherServiceFactory==null) {
            $this->matcherServiceFactory = new matcher\MatcherServiceFactory($this->apiKey, $this->context, $this->baseUrl);
        }
        return $this->matcherServiceFactory;
    }

    /**
     * @return formatter\FormatterServiceFactory
     */
    public function formatterServices() {
        if ($this->formatterServiceFactory==null) {
            $this->formatterServiceFactory = new formatter\FormatterServiceFactory($this->apiKey, $this->context, $this->baseUrl);
        }
        return $this->formatterServiceFactory;
    }

    /**
     * @return email\EmailServiceFactory
     */
    public function emailServices() {
        if ($this->emailServiceFactory==null) {
            $this->emailServiceFactory = new email\EmailServiceFactory($this->apiKey, $this->context, $this->baseUrl);
        }
        return $this->emailServiceFactory;
    }

    /**
     * @return riskdetector\RiskDetectorServiceFactory
     * @since v5.3
     */
    public function riskServices() {
        if ($this->riskServiceFactory==null) {
            $this->riskServiceFactory = new riskdetector\RiskDetectorServiceFactory($this->apiKey, $this->context, $this->baseUrl);
        }
        return $this->riskServiceFactory;
    }

}
