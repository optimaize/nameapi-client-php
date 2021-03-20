<?php

namespace Org\NameApi\Ontology\Input\Entities\Person\Gender;


/**
 * Enum class StoragePersonGender
 *
 * This is how common database applications usually store the gender for a person.
 *
 * Possible values are: MALE, FEMALE, UNKNOWN.
 *
 * @package Org\NameApi\Ontology\Input\Entities\Person\Gender
 */
final class StoragePersonGender
{

    /**
     * @var string $value
     */
    private $value = null;

    public function __construct($value)
    {
        if ($value != 'MALE' && $value != 'FEMALE' && $value != 'UNKNOWN') {
            throw new \Exception('Invalid value for StoragePersonGender: ' . $value . '!');
        }
        $this->value = $value;
    }


    public function __toString()
    {
        return $this->value;
    }

}

