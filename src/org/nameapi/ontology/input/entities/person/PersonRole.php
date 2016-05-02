<?php

namespace org\nameapi\ontology\input\entities\person;

/**
 * Class PersonRole
 *
 * Possible values are: GROUP, PRIMARY, RECEIVER, RESIDENT, CONTACT, OWNER, MEMBER
 */
final class PersonRole {
    /**
     * @var string $value
     */
    private $value = null;

    public function __construct($value) {
        if ($value!=='GROUP' && $value!=='PRIMARY' && $value!=='RECEIVER' && $value!=='RESIDENT' && $value!=='CONTACT' && $value!=='OWNER' && $value!=='MEMBER') {
            throw new \Exception('Invalid value for PersonRole: '.$value.'!');
        }
        $this->value = $value;
    }


    public function __toString() {
        return $this->value;
    }

}

