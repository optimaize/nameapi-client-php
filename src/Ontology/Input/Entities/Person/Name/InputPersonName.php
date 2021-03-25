<?php

namespace Org\NameApi\Ontology\Input\Entities\Person\Name;

class InputPersonName
{

    /**
     * @var NameField[] $nameFields
     * @access public
     */
    public $nameFields = null;

    /**
     * @param NameField[] $nameFields
     * @access public
     */
    public function __construct($nameFields)
    {
        $this->nameFields = $nameFields;
    }

    /**
     * @return Builder\WesternInputPersonNameBuilder
     */
    static function westernBuilder()
    {
        return new Builder\WesternInputPersonNameBuilder();
    }

    /**
     * @return Builder\AmericanInputPersonNameBuilder
     */
    static function americanBuilder()
    {
        return new Builder\AmericanInputPersonNameBuilder();
    }

}
