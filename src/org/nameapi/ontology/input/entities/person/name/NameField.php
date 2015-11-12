<?php

namespace org\nameapi\ontology\input\entities\person\name;

/**
 * Class NameField
 *
 * The content of a form field or database field, as input sent to the web service.
 * It contains the string value, and the field type.
 *
 * @package org\nameapi\ontology\input\entities\person\name
 */
class NameField {

    /**
     * @var string $string
     */
    public $string;

    /**
     * @var string $fieldType
     */
    public $fieldType;

    /**
     * @param string $string for example "Peter".
     * @param string $fieldType for example "GIVENNAME".
     * @access public
     */
    public function __construct($string, $fieldType) {
        $this->string = $string;
        $this->fieldType = $fieldType;
    }

}
