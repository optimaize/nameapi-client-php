<?php

namespace org\nameapi\ontology\input\entities\person\gender;

/**
 * Enum class ComputedPersonGender
 *
 * Possible values are: MALE, FEMALE, NEUTRAL, UNKNOWN, INDETERMINABLE, CONFLICT.
 *
 * @package org\nameapi\ontology\input\entities\person\gender
 */
final class ComputedPersonGender {

    /**
     * @var string $value
     */
    private $value = null;

    public function __construct($value) {
        if ($value!='MALE' && $value!='FEMALE' && $value!='NEUTRAL' && $value!='UNKNOWN' && $value!='INDETERMINABLE' && $value!='CONFLICT') {
            throw new \Exception('Invalid value for ComputedPersonGender: '.$value.'!');
        }
        $this->value = $value;
    }



    public function __toString() {
        return $this->value;
    }

}
