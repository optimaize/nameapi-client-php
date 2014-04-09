<?php

namespace org\nameapi\ontology\input\entities\person\name\builder;

use org\nameapi\ontology\input\entities\person\name\InputPersonName;
use org\nameapi\ontology\input\entities\person\name\NameField;
use org\nameapi\ontology\input\entities\person\name\types\CommonNameFieldType;

class InputPersonNameBuilder {

    /**
     * @var NameField[] $nameFields
     * @access public
     */
    private $nameFields = array();

    /**
     * @param $string
     * @return $this
     */
    public function fullname($string) {
        return $this->nameField(new NameField($string, CommonNameFieldType::FULLNAME));
    }

    /**
     * @param NameField $nameField
     * @return $this
     */
    public function nameField(NameField $nameField) {
        array_push($this->nameFields, $nameField);
        return $this;
    }


    public function isEmpty() {
        return empty($this->nameFields);
    }

    public function build() {
        return new InputPersonName($this->nameFields);
    }

}
