<?php

namespace org\nameapi\ontology\input\entities\person\gender;


/**
 * Enum class StoragePersonGender
 *
 * This is how common database applications usually store the gender for a person.
 *
 * Possible values are: MALE, FEMALE, UNKNOWN.
 *
 * @package org\nameapi\ontology\input\entities\person\gender
 */
final class StoragePersonGender {

    /**
     * @var string $value
     */
    private $value = null;

    public function __construct($value) {
        if ($value!='MALE' && $value!='FEMALE' && $value!='UNKNOWN') {
            throw new \Exception('Invalid value for StoragePersonGender: '.$value.'!');
        }
        $this->value = $value;
    }



    public function __toString() {
        return $this->value;
    }

}

