<?php

namespace org\nameapi\ontology\input\entities\person\name\builder;

use org\nameapi\ontology\input\entities\person\name\NameField;
use org\nameapi\ontology\input\entities\person\name\types\CommonNameFieldType;
use org\nameapi\ontology\input\entities\person\name\types\AmericanNameFieldType;

class AmericanInputPersonNameBuilder extends InputPersonNameBuilder {

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
    public function middleName($string) {
        $this->nameField(new NameField($string, AmericanNameFieldType::MIDDLENAME));
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


    /**
     * @param $string
     * @return $this
     */
    public function prefix($string) {
        $this->nameField(new NameField($string, AmericanNameFieldType::NAMEPREFIX));
        return $this;
    }

    /**
     * @param $string
     * @return $this
     */
    public function suffix($string) {
        $this->nameField(new NameField($string, AmericanNameFieldType::NAMESUFFIX));
        return $this;
    }

}
