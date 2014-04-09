<?php

namespace org\nameapi\client\services\genderizer;

use org\nameapi\ontology\input\context\Context;

require_once('persongenderizer/PersonGenderizerService.php');


/**
 *
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
    public function personGenderizerService() {
        if ($this->personGenderizerService==null) {
            $this->personGenderizerService = new persongenderizer\PersonGenderizerService($this->context);
        }
        return $this->personGenderizerService;
    }

}
