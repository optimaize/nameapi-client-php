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
        if (($value!=='YES') && ($value!=='NO') && ($value!=='UNKNOWN')) {
            throw new \Exception('Invalid value for Maybe: >>>'.$value.'<<<!');
        }
        $this->value = $value;
    }


    /**
     * @return bool
     */
    public function isDisposable() {
        return $this->value === 'YES';
    }

    public function __toString() {
        return $this->value;
    }

}
