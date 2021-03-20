<?php

namespace Org\NameApi\Ontology\Input\Entities\Person\Gender;

/**
 * Enum class ComputedPersonGender
 *
 * Possible values are: MALE, FEMALE, NEUTRAL, UNKNOWN, INDETERMINABLE, CONFLICT.
 *
 * @package Org\NameApi\Ontology\Input\Entities\Person\Gender
 */
final class ComputedPersonGender
{

    /**
     * @var string $value
     */
    private $value = null;

    public function __construct($value)
    {
        if ($value != 'MALE' && $value != 'FEMALE' && $value != 'NEUTRAL' && $value != 'UNKNOWN' && $value != 'INDETERMINABLE' && $value != 'CONFLICT') {
            throw new \Exception('Invalid value for ComputedPersonGender: ' . $value . '!');
        }
        $this->value = $value;
    }


    public function __toString()
    {
        return $this->value;
    }

}
