<?php

namespace org\nameapi\ontology\input\entities\person;


/**
 * Class MaritalStatus
 *
 * Possible values are: UNKNOWN, SINGLE, ENGAGED, MARRIED, SEPARATED, DIVORCED, WIDOWED
 *
 * @package org\nameapi\ontology\input\entities\person
 */
final class MaritalStatus {

    /**
     * @var string $value
     */
    private $value = null;

    public function __construct($value) {
        if ($value!='UNKNOWN' && $value!='SINGLE' && $value!='ENGAGED' && $value!='MARRIED' && $value!='SEPARATED' && $value!='DIVORCED' && $value!='WIDOWED') {
            throw new \Exception('Invalid value for MaritalStatus: '.$value.'!');
        }
        $this->value = $value;
    }



    public function __toString() {
        return $this->value;
    }

}

