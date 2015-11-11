<?php

namespace org\nameapi\client\services\genderizer;

use org\nameapi\ontology\input\context\Context;

require_once(__DIR__.'/persongenderizer/PersonGenderizerService.php');


/**
 * Provides access to the genderizer-related services.
 */
class GenderizerServiceFactory {

    private $apiKey;
    private $context;
    private $baseUrl;
    private $personGenderizerService;

    /**
     */
    public function __construct($apiKey, Context $context, $baseUrl) {
        $this->apiKey = $apiKey;
        $this->context = $context;
        $this->baseUrl = $baseUrl;
    }

    /**
     * @return persongenderizer\PersonGenderizerService
     * @since v4.0
     */
    public function personGenderizer() {
        if ($this->personGenderizerService==null) {
            $this->personGenderizerService = new persongenderizer\PersonGenderizerService($this->apiKey, $this->context, $this->baseUrl);
        }
        return $this->personGenderizerService;
    }

}
