<?php

namespace org\nameapi\client\services\system;

use org\nameapi\ontology\input\context\Context;
use org\nameapi\client\services\system\ping\PingerService;

require_once(__DIR__.'/pinger/PingerService.php');


/**
 * Provides access to the system-related services.
 */
class SystemServiceFactory {

    private $context;
    private $pingerService;

    /**
     */
    public function __construct(Context $context) {
        $this->context = $context;
    }

    /**
     * @return PingerService
     */
    public function pinger() {
        if ($this->pingerService==null) {
            $this->pingerService = new PingerService($this->context);
        }
        return $this->pingerService;
    }

}
