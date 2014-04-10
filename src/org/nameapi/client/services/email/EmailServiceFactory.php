<?php

namespace org\nameapi\client\services\email;

use org\nameapi\ontology\input\context\Context;
use org\nameapi\client\services\email\disposableemailaddressdetector\DisposableEmailAddressDetectorService;

require_once('disposableemailaddressdetector/DisposableEmailAddressDetectorService.php');


/**
 *
 */
class EmailServiceFactory {

    private $context;
    private $disposableEmailAddressDetector;

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

}
