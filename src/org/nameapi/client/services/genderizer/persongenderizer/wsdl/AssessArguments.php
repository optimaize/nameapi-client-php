<?php

namespace org\nameapi\client\services\genderizer\persongenderizer\wsdl;

use org\nameapi\ontology\input\context\Context;
use org\nameapi\ontology\input\entities\person\NaturalInputPerson;

class AssessArguments {

    private $context = null;
    private $person = null;

    public function __construct(Context $context, NaturalInputPerson $person) {
        $this->context = $context;
        $this->person = $person;
    }

}
