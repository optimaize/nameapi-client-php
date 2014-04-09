<?php

namespace org\nameapi\client\services\email\disposableemailaddressdetector;

/**
 * Class Maybe
 *
 * Possible values are: YES, NO, UNKNOWN.
 *
 * @status experimental this class may be moved to re-use for other services.
 */
class Maybe {

    /**
     * @var string $value
     */
    private $value = null;

    public function __construct($value) {
        if ($value!='YES' && $value!='NO' && $value!='UNKNOWN') {
            throw new \Exception('Invalid value for Maybe: '.$value.'!');
        }
        $this->value = $value;
    }



    public function toString() {
        return $this->value;
    }
    public function __toString() {
        return $this->toString();
    }

}
