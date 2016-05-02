<?php

namespace org\nameapi\client\services\parser\personnameparser;


/**
 * Class DisputeType
 *
 * Possible values are:
 * GENDER
 * SPELLING
 *
 */
final class DisputeType {

    /**
     * @var string $value
     */
    private $value = null;

    public function __construct($value) {
        if ($value!=='GENDER' && $value!=='SPELLING') {
            throw new \Exception('Invalid value for DisputeType: '.$value.'!');
        }
        $this->value = $value;
    }



    public function __toString() {
        return $this->value;
    }

}

