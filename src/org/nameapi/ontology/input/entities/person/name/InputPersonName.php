<?php

namespace org\nameapi\ontology\input\entities\person\name;

require_once(__DIR__.'/NameField.php');
require_once(__DIR__.'/builder/InputPersonNameBuilder.php');
require_once(__DIR__.'/builder/WesternInputPersonNameBuilder.php');
require_once(__DIR__.'/builder/AmericanInputPersonNameBuilder.php');
require_once(__DIR__.'/types/AmericanNameFieldType.php');
require_once(__DIR__.'/types/CommonNameFieldType.php');

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
     * @var NameField[] $nameFields
     * @access public
     */
    public $nameFields = null;

    /**
     * @param NameField[] $nameFields
     * @access public
     */
    public function __construct($nameFields) {
        $this->nameFields = $nameFields;
    }

}
