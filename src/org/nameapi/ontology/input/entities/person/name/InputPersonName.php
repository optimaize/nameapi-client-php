<?php

namespace org\nameapi\ontology\input\entities\person\name;

require_once('NameField.php');
require_once('builder/InputPersonNameBuilder.php');
require_once('builder/WesternInputPersonNameBuilder.php');
require_once('builder/AmericanInputPersonNameBuilder.php');
require_once('types/AmericanNameFieldType.php');
require_once('types/CommonNameFieldType.php');

class InputPersonName {

    /**
     * @return builder\WesternInputPersonNameBuilder
     */
    static function westernBuilder() {
        return new builder\WesternInputPersonNameBuilder();
    }
    /**
     * @return builder\AmericanInputPersonNameBuilder
     */
    static function americanBuilder() {
        return new builder\AmericanInputPersonNameBuilder();
    }

    /**
     * @var NameField[] $names
     * @access public
     */
    public $names = null;

    /**
     * @param NameField[] $names
     * @access public
     */
    public function __construct($names) {
        $this->names = $names;
    }

}
