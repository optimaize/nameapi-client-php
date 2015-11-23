<?php

namespace org\nameapi\client\services\development;

use org\nameapi\client\services\development\exceptionthrower\ExceptionThrowerService;
use org\nameapi\ontology\input\context\Context;

require_once(__DIR__.'/exceptionthrower/ExceptionThrowerService.php');


/**
 * Provides access to the system-related services.
 */
class DevelopmentServiceFactory {

    private $apiKey;
    private $context;
    private $baseUrl;
    private $exceptionThrowerService;

    /**
     */
    public function __construct($apiKey, Context $context, $baseUrl) {
        $this->apiKey = $apiKey;
        $this->context = $context;
        $this->baseUrl = $baseUrl;
    }

    /**
     * @return ExceptionThrowerService
     * @since v5.0
     */
    public function exceptionThrower() {
        if ($this->exceptionThrowerService==null) {
            $this->exceptionThrowerService = new ExceptionThrowerService($this->apiKey, $this->context, $this->baseUrl);
        }
        return $this->exceptionThrowerService;
    }

}
