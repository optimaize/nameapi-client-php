<?php

namespace org\nameapi\client\services\formatter;

use org\nameapi\ontology\input\context\Context;
use org\nameapi\client\services\formatter\personnameformatter\PersonNameFormatterService;
use org\nameapi\client\services\formatter\namefieldformatter\NameFieldFormatterService;

require_once(__DIR__.'/personnameformatter/PersonNameFormatterService.php');
require_once(__DIR__.'/namefieldformatter/NameFieldFormatterService.php');


/**
 * Provides access to the formatter-related services.
 */
class FormatterServiceFactory {

    private $apiKey;
    private $context;
    private $baseUrl;
    private $personNameFormatterService;
    private $nameFieldFormatterService;

    /**
     */
    public function __construct($apiKey, Context $context, $baseUrl) {
        $this->apiKey = $apiKey;
        $this->context = $context;
        $this->baseUrl = $baseUrl;
    }

    /**
     * @return PersonNameFormatterService
     * @since v4.0
     */
    public function personNameFormatter() {
        if ($this->personNameFormatterService==null) {
            $this->personNameFormatterService = new PersonNameFormatterService($this->apiKey, $this->context, $this->baseUrl);
        }
        return $this->personNameFormatterService;
    }

    /**
     * @return NameFieldFormatterService
     */
    public function nameFieldFormatter() {
        if ($this->nameFieldFormatterService==null) {
            $this->nameFieldFormatterService = new NameFieldFormatterService($this->apiKey, $this->context, $this->baseUrl);
        }
        return $this->nameFieldFormatterService;
    }

}
