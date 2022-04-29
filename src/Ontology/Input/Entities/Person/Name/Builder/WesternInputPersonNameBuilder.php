<?php

namespace Org\NameApi\Ontology\Input\Entities\Person\Name\Builder;

use Org\NameApi\Ontology\Input\Entities\Person\Name\NameField;
use Org\NameApi\Ontology\Input\Entities\Person\Name\Types\CommonNameFieldType;

class WesternInputPersonNameBuilder extends InputPersonNameBuilder
{

    /**
     * @param $string
     * @return $this
     */
    public function givenName($string)
    {
        $this->nameField(new NameField($string, CommonNameFieldType::GIVENNAME));
        return $this;
    }

    /**
     * @param $string
     * @return $this
     */
    public function surname($string)
    {
        $this->nameField(new NameField($string, CommonNameFieldType::SURNAME));
        return $this;
    }
}
