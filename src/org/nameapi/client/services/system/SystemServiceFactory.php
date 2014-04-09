<?php

namespace org\nameapi\client\services\system;

use org\nameapi\ontology\input\context\Context;
use org\nameapi\client\services\system\ping\PingerService;

require_once('pinger/PingerService.php');


/**
 *
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
    public function pingerService() {
        if ($this->pingerService==null) {
            $this->pingerService = new PingerService($this->context);
        }
        return $this->pingerService;
    }

}
