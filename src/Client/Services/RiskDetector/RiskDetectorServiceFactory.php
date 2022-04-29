<?php

namespace Org\NameApi\Client\Services\RiskDetector;

use Org\NameApi\Client\Services\RiskDetector\Person\PersonRiskDetectorService;
use Org\NameApi\Ontology\Input\Context\Context;

/**
 * Provides access to the risk-related services.
 *
 * @since v5.3
 */
class RiskDetectorServiceFactory
{

    private $apiKey;
    private $context;
    private $baseUrl;
    private $personRiskDetector;

    /**
     */
    public function __construct($apiKey, Context $context, $baseUrl)
    {
        $this->apiKey = $apiKey;
        $this->context = $context;
        $this->baseUrl = $baseUrl;
    }

    /**
     * @return PersonRiskDetectorService
     */
    public function personRiskDetector()
    {
        if ($this->personRiskDetector == null) {
            $this->personRiskDetector = new PersonRiskDetectorService($this->apiKey, $this->context, $this->baseUrl);
        }
        return $this->personRiskDetector;
    }

}

