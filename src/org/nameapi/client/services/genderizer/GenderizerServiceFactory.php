<?php

namespace org\nameapi\client\services\genderizer;

use org\nameapi\ontology\input\context\Context;

require_once(__DIR__.'/persongenderizer/PersonGenderizerService.php');


/**
 * Provides access to the genderizer-related services.
 */
class GenderizerServiceFactory {

    private $context;
    private $personGenderizerService;

    /**
     */
    public function __construct(Context $context) {
        $this->context = $context;
    }

    /**
     * @return persongenderizer\PersonGenderizerService
     */
    public function personGenderizer() {
        if ($this->personGenderizerService==null) {
            $this->personGenderizerService = new persongenderizer\PersonGenderizerService($this->context);
        }
        return $this->personGenderizerService;
    }

}
