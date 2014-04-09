<?php

namespace org\nameapi\client\services\email;

use org\nameapi\ontology\input\context\Context;
use org\nameapi\client\services\email\disposableemailaddressdetector\DisposableEmailAddressDetector;

require_once('disposableemailaddressdetector/DisposableEmailAddressDetector.php');


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
     * @return DisposableEmailAddressDetector
     */
    public function disposableEmailAddressDetector() {
        if ($this->disposableEmailAddressDetector==null) {
            $this->disposableEmailAddressDetector = new DisposableEmailAddressDetector($this->context);
        }
        return $this->disposableEmailAddressDetector;
    }

}
