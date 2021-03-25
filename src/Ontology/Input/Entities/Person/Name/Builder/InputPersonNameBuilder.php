<?php

namespace Org\NameApi\Ontology\Input\Entities\Person\Name\Builder;

use Org\NameApi\Ontology\Input\Entities\Person\Name\InputPersonName;
use Org\NameApi\Ontology\Input\Entities\Person\Name\NameField;
use Org\NameApi\Ontology\Input\Entities\Person\Name\Types\CommonNameFieldType;

class InputPersonNameBuilder
{

    /**
     * @var NameField[] $nameFields
     * @access public
     */
    private $nameFields = array();

    /**
     * @param $string
     * @return $this
     */
    public function fullname($string)
    {
        return $this->nameField(new NameField($string, CommonNameFieldType::FULLNAME));
    }

    /**
     * @param NameField $nameField
     * @return $this
     */
    public function nameField(NameField $nameField)
    {
        array_push($this->nameFields, $nameField);
        return $this;
    }


    public function isEmpty()
    {
        return empty($this->nameFields);
    }

    public function build()
    {
        return new InputPersonName($this->nameFields);
    }

}
