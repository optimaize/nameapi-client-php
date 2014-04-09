<?php

namespace org\nameapi\client\services\parser\personnameparser;

require_once(__DIR__.'/../../../../ontology/input/entities/person/PersonType.php');
require_once(__DIR__.'/../OutputPersonName.php');

use org\nameapi\ontology\input\entities\person\PersonType;
use org\nameapi\client\services\parser\OutputPersonName;


class ParsedPerson {

    /**
     * @var PersonType $personType
     */
    private $personType = null;

    /**
     * @var OutputPersonName[] $names
     */
    private $names = null;

    public function __construct(PersonType $personType, array $names) {
        if (!$names) throw new \Exception("Names may not be empty!");
        $this->personType = $personType;
        $this->names      = $names;
    }

    /**
     * @return PersonType
     */
    public function getPersonType() {
        return $this->personType;
    }

    /**
     * Usually just one, but multiple when the person type is NATURAL_MULTIPLE.
     * @return OutputPersonName[]
     */
    public function getNames() {
        return $this->names;
    }

    /**
     * @return OutputPersonName
     */
    public function getFirstName() {
        return $this->names[0];
    }

    /**
     * @throws \Exception if there is not exactly one.
     * @return OutputPersonName
     */
    public function getSingleName() {
        if (sizeof($this->names) != 1) {
            throw new \Exception('Expected exactly 1 name, got '.sizeof($this->names).'!');
        }
        return $this->names[0];
    }


    public function __toString() {
        $nameStr = '';
        foreach ($this->names as $name) {
            if ($nameStr != '') $nameStr .= ',';
            $nameStr .= $name;
        }
        $str = 'ParsedPerson{personType='.$this->personType.', names='.$nameStr.'}';
        return $str;
    }
}
