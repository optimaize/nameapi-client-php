<?php

namespace org\nameapi\client\services\system;

use org\nameapi\ontology\input\context\Context;
use org\nameapi\client\services\system\ping\PingerService;

require_once(__DIR__.'/pinger/PingerService.php');


/**
 * Provides access to the system-related services.
 */
class SystemServiceFactory {

    private $apiKey;
    private $context;
    private $baseUrl;
    private $pingerService;

    /**
     */
    public function __construct($apiKey, Context $context, $baseUrl) {
        $this->apiKey = $apiKey;
        $this->context = $context;
        $this->baseUrl = $baseUrl;
    }

    /**
     * @return PingerService
     * @since v4.0
     */
    public function pinger() {
        if ($this->pingerService==null) {
            $this->pingerService = new PingerService($this->context, $this->baseUrl);
        }
        return $this->pingerService;
    }

}
