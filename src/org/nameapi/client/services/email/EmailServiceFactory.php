<?php

namespace Org\NameApi\Client\Services\Email;

use Org\NameApi\Client\Services\Email\DisposableEmailAddressDetector\DisposableEmailAddressDetectorService;
use Org\NameApi\Client\Services\Email\EmailNameParser\EmailNameParserService;
use Org\NameApi\ontology\input\Context\Context;

/**
 * Provides access to the email-related services.
 */
class EmailServiceFactory
{

    private $apiKey;
    private $context;
    private $baseUrl;
    private $disposableEmailAddressDetector;
    private $emailNameParser;
    private $emailNameParser2;

    /**
     */
    public function __construct($apiKey, Context $context, $baseUrl)
    {
        $this->apiKey = $apiKey;
        $this->context = $context;
        $this->baseUrl = $baseUrl;
    }

    /**
     * @return DisposableEmailAddressDetectorService
     * @since v4.0
     */
    public function disposableEmailAddressDetector()
    {
        if ($this->disposableEmailAddressDetector == null) {
            $this->disposableEmailAddressDetector = new DisposableEmailAddressDetectorService($this->apiKey, $this->context, $this->baseUrl);
        }
        return $this->disposableEmailAddressDetector;
    }

    /**
     * @return EmailNameParserService
     * @since v4.0
     */
    public function emailNameParser()
    {
        if ($this->emailNameParser == null) {
            $this->emailNameParser = new EmailNameParserService($this->apiKey, $this->context, $this->baseUrl);
        }
        return $this->emailNameParser;
    }

}
