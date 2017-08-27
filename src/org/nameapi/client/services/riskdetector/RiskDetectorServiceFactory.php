<?php

namespace org\nameapi\client\services\riskdetector;

use org\nameapi\ontology\input\context\Context;

require_once(__DIR__ . '/person/PersonRiskDetectorService.php');

/**
 * Provides access to the risk-related services.
 *
 * @since v5.3
 */
class RiskDetectorServiceFactory {

    private $apiKey;
    private $context;
    private $baseUrl;
    private $personRiskDetector;

    /**
     */
    public function __construct($apiKey, Context $context, $baseUrl) {
        $this->apiKey  = $apiKey;
        $this->context = $context;
        $this->baseUrl = $baseUrl;
    }

    /**
     * @return riskdetector\PersonRiskDetectorService
     */
    public function personRiskDetector() {
        if ($this->personRiskDetector==null) {
            $this->personRiskDetector = new riskdetector\PersonRiskDetectorService($this->apiKey, $this->context, $this->baseUrl);
        }
        return $this->personRiskDetector;
    }

}

