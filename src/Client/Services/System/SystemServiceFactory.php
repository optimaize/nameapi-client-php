<?php

namespace Org\NameApi\Client\Services\System;

use Org\NameApi\Client\Services\System\Ping\PingService;
use Org\NameApi\ontology\input\Context\Context;

/**
 * Provides access to the system-related services.
 */
class SystemServiceFactory
{

    private $apiKey;
    private $context;
    private $baseUrl;
    private $pingService;

    /**
     */
    public function __construct($apiKey, Context $context, $baseUrl)
    {
        $this->apiKey = $apiKey;
        $this->context = $context;
        $this->baseUrl = $baseUrl;
    }

    /**
     * @return PingService
     * @since v4.0
     */
    public function ping()
    {
        if ($this->pingService == null) {
            $this->pingService = new PingService($this->apiKey, $this->context, $this->baseUrl);
        }
        return $this->pingService;
    }

}
