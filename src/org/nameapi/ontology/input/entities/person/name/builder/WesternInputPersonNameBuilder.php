<?php

namespace org\nameapi\ontology\input\entities\person\name\builder;

use org\nameapi\ontology\input\entities\person\name\NameField;
use org\nameapi\ontology\input\entities\person\name\types\CommonNameFieldType;

class WesternInputPersonNameBuilder extends InputPersonNameBuilder {

    /**
     * @param $string
     * @return $this
     */
    public function givenName($string) {
        $this->nameField(new NameField($string, CommonNameFieldType::GIVENNAME));
        return $this;
    }

    /**
     * @param $string
     * @return $this
     */
    public function surname($string) {
        $this->nameField(new NameField($string, CommonNameFieldType::SURNAME));
        return $this;
    }
}
