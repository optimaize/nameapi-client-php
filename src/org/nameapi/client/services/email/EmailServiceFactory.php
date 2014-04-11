<?php

namespace org\nameapi\client\services\email;

use org\nameapi\ontology\input\context\Context;
use org\nameapi\client\services\email\disposableemailaddressdetector\DisposableEmailAddressDetectorService;
use org\nameapi\client\services\email\emailnameparser\EmailNameParserService;

require_once(__DIR__.'/disposableemailaddressdetector/DisposableEmailAddressDetectorService.php');
require_once(__DIR__.'/emailnameparser/EmailNameParserService.php');


/**
 * Provides access to the email-related services.
 */
class EmailServiceFactory {

    private $context;
    private $disposableEmailAddressDetector;
    private $emailNameParser;

    /**
     */
    public function __construct(Context $context) {
        $this->context = $context;
    }

    /**
     * @return DisposableEmailAddressDetectorService
     */
    public function disposableEmailAddressDetector() {
        if ($this->disposableEmailAddressDetector==null) {
            $this->disposableEmailAddressDetector = new DisposableEmailAddressDetectorService($this->context);
        }
        return $this->disposableEmailAddressDetector;
    }

    /**
     * @return EmailNameParserService
     */
    public function emailNameParser() {
        if ($this->emailNameParser==null) {
            $this->emailNameParser = new EmailNameParserService($this->context);
        }
        return $this->emailNameParser;
    }

}
