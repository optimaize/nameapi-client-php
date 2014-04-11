<?php

namespace org\nameapi\ontology\input\entities\person;

/**
 * Class PersonType
 *
 * Possible values are: NATURAL_SINGLE, NATURAL_MULTIPLE, NATURAL_FAMILY, LEGAL
 */
final class PersonType {
    /**
     * @var string $value
     */
    private $value = null;

    public function __construct($value) {
        if ($value!=='NATURAL_SINGLE' && $value!=='NATURAL_MULTIPLE' && $value!=='NATURAL_FAMILY' && $value!=='LEGAL') {
            throw new \Exception('Invalid value for PersonType: '.$value.'!');
        }
        $this->value = $value;
    }


    public function __toString() {
        return $this->value;
    }

}

