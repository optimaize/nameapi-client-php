<?php

namespace org\nameapi\client\services\genderizer\persongenderizer\wsdl;

use org\nameapi\client\services\genderizer\persongenderizer\PersonGenderResult;
use org\nameapi\ontology\input\entities\person\gender\ComputedPersonGender;

class AssessResponse {

    /**
     * @var Object $return
     */
    private $return = null;

    //constructor not called. hence we do object conversion in getter.

    /**
     * @return PersonGenderResult
     */
    public function getReturn() {
        return new PersonGenderResult(
            new ComputedPersonGender($this->return->gender),
            isSet($this->return->maleProportion) ? $this->return->maleProportion : null,
            $this->return->confidence
        );
    }

}
