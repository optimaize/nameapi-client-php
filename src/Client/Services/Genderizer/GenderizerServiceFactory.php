<?php

namespace Org\NameApi\Client\Services\Genderizer;

use Org\NameApi\Ontology\Input\Context\Context;

/**
 * Provides access to the genderizer-related services.
 */
class GenderizerServiceFactory
{

    private $apiKey;
    private $context;
    private $baseUrl;
    private $personGenderizerService;

    /**
     */
    public function __construct($apiKey, Context $context, $baseUrl)
    {
        $this->apiKey = $apiKey;
        $this->context = $context;
        $this->baseUrl = $baseUrl;
    }

    /**
     * @return PersonGenderizer\PersonGenderizerService
     * @since v4.0
     */
    public function personGenderizer()
    {
        if ($this->personGenderizerService == null) {
            $this->personGenderizerService = new PersonGenderizer\PersonGenderizerService($this->apiKey, $this->context, $this->baseUrl);
        }
        return $this->personGenderizerService;
    }

}
