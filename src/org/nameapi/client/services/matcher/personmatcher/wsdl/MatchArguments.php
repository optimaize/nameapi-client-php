<?php


namespace org\nameapi\client\services\matcher\personmatcher\wsdl;

use org\nameapi\ontology\input\context\Context;
use org\nameapi\ontology\input\entities\person\NaturalInputPerson;

class MatchArguments {

    private $context = null;
    private $person1 = null;
    private $person2 = null;

    public function __construct(Context $context, NaturalInputPerson $person1, NaturalInputPerson $person2) {
        $this->context = $context;
        $this->person1 = $person1;
        $this->person2 = $person2;
    }

}
