<?php

namespace Org\NameApi\Client\Services\Formatter;

use Org\NameApi\Client\Services\Formatter\NameFieldFormatter\NameFieldFormatterService;
use Org\NameApi\Client\Services\Formatter\PersonNameFormatter\PersonNameFormatterService;
use Org\NameApi\ontology\input\Context\Context;

/**
 * Provides access to the formatter-related services.
 */
class FormatterServiceFactory
{

    private $apiKey;
    private $context;
    private $baseUrl;
    private $personNameFormatterService;
    private $nameFieldFormatterService;

    /**
     */
    public function __construct($apiKey, Context $context, $baseUrl)
    {
        $this->apiKey = $apiKey;
        $this->context = $context;
        $this->baseUrl = $baseUrl;
    }

    /**
     * @return PersonNameFormatterService
     * @since v4.0
     */
    public function personNameFormatter()
    {
        if ($this->personNameFormatterService == null) {
            $this->personNameFormatterService = new PersonNameFormatterService($this->apiKey, $this->context, $this->baseUrl);
        }
        return $this->personNameFormatterService;
    }

    /**
     * @return NameFieldFormatterService
     */
    public function nameFieldFormatter()
    {
        if ($this->nameFieldFormatterService == null) {
            $this->nameFieldFormatterService = new NameFieldFormatterService($this->apiKey, $this->context, $this->baseUrl);
        }
        return $this->nameFieldFormatterService;
    }

}
