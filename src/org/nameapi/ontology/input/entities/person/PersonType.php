<?php

namespace org\nameapi\ontology\input\entities\person;

/**
 * Class PersonType
 *
 * Possible values are: NATURAL, MULTIPLE, FAMILY, LEGAL
 */
final class PersonType {
    /**
     * @var string $value
     */
    private $value = null;

    public function __construct($value) {
        if ($value!=='NATURAL' && $value!=='MULTIPLE' && $value!=='FAMILY' && $value!=='LEGAL') {
            throw new \Exception('Invalid value for PersonType: '.$value.'!');
        }
        $this->value = $value;
    }


    public function __toString() {
        return $this->value;
    }

}

