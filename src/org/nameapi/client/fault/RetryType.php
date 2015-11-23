<?php

namespace org\nameapi\client\fault;

/**
 * The RetryType enum class tells and when the client may retry and send the same request again.
 *
 * <p>Possible values are: NO, LATER, NOW.</p>
 */
final class RetryType {

    /**
     * @var string $value
     */
    private $value = null;

    public function __construct($value) {
        if ($value!='NO' && $value!='LATER' && $value!='NOW') {
            throw new \Exception('Invalid value for RetryType: '.$value.'!');
        }
        $this->value = $value;
    }


    public function __toString() {
        return $this->value;
    }

    public function isNo() {
        return $this->value === 'NO';
    }
    public function isLater() {
        return $this->value === 'LATER';
    }
    public function isNow() {
        return $this->value === 'NOW';
    }

}
