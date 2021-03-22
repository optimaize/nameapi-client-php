<?php

namespace Org\NameApi\Client\Services;

use Org\NameApi\Ontology\Input\Context\Context;

/**
 *
 */
class ServiceFactory
{

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
    public function __construct($apiKey, Context $context, Host $host = null, $apiVersion = null)
    {
        $this->apiKey = $apiKey;
        $this->context = $context;
        if ($host == null) {
            $this->host = Host::standard();
        } else {
            $this->host = $host;
        }
        if ($apiVersion == null) {
            $this->apiVersion = '5.0';
        } else {
            $this->apiVersion = $apiVersion;
        }
        $this->baseUrl = $this->host->toString() . '/' . $this->technology . '/v' . $this->apiVersion . '/';
    }


    /**
     * @return Development\DevelopmentServiceFactory
     */
    public function developmentServices()
    {
        if ($this->developmentServiceFactory == null) {
            $this->developmentServiceFactory = new Development\DevelopmentServiceFactory($this->apiKey, $this->context, $this->baseUrl);
        }
        return $this->developmentServiceFactory;
    }

    /**
     * @return System\SystemServiceFactory
     */
    public function systemServices()
    {
        if ($this->systemServiceFactory == null) {
            $this->systemServiceFactory = new System\SystemServiceFactory($this->apiKey, $this->context, $this->baseUrl);
        }
        return $this->systemServiceFactory;
    }

    /**
     * @return Parser\ParserServiceFactory
     */
    public function parserServices()
    {
        if ($this->parserServiceFactory == null) {
            $this->parserServiceFactory = new Parser\ParserServiceFactory($this->apiKey, $this->context, $this->baseUrl);
        }
        return $this->parserServiceFactory;
    }

    /**
     * @return Genderizer\GenderizerServiceFactory
     */
    public function genderizerServices()
    {
        if ($this->genderizerServiceFactory == null) {
            $this->genderizerServiceFactory = new Genderizer\GenderizerServiceFactory($this->apiKey, $this->context, $this->baseUrl);
        }
        return $this->genderizerServiceFactory;
    }

    /**
     * @return Matcher\MatcherServiceFactory
     */
    public function matcherServices()
    {
        if ($this->matcherServiceFactory == null) {
            $this->matcherServiceFactory = new Matcher\MatcherServiceFactory($this->apiKey, $this->context, $this->baseUrl);
        }
        return $this->matcherServiceFactory;
    }

    /**
     * @return Formatter\FormatterServiceFactory
     */
    public function formatterServices()
    {
        if ($this->formatterServiceFactory == null) {
            $this->formatterServiceFactory = new Formatter\FormatterServiceFactory($this->apiKey, $this->context, $this->baseUrl);
        }
        return $this->formatterServiceFactory;
    }

    /**
     * @return Email\EmailServiceFactory
     */
    public function emailServices()
    {
        if ($this->emailServiceFactory == null) {
            $this->emailServiceFactory = new Email\EmailServiceFactory($this->apiKey, $this->context, $this->baseUrl);
        }
        return $this->emailServiceFactory;
    }

    /**
     * @return RiskDetector\RiskDetectorServiceFactory
     * @since v5.3
     */
    public function riskServices()
    {
        if ($this->riskServiceFactory == null) {
            $this->riskServiceFactory = new RiskDetector\RiskDetectorServiceFactory($this->apiKey, $this->context, $this->baseUrl);
        }
        return $this->riskServiceFactory;
    }

}
