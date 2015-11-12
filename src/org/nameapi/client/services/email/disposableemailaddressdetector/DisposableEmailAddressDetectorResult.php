<?php

namespace org\nameapi\client\services\email\disposableemailaddressdetector;

class DisposableEmailAddressDetectorResult {

    /**
     * @var Maybe $disposable
     */
    private $disposable = null;

    /**
     * @param Maybe $disposable
     * @access public
     */
    public function __construct($disposable) {
        $this->disposable = $disposable;
    }

    /**
     * @return Maybe
     */
    public function getDisposable() {
        return $this->disposable;
    }

}
