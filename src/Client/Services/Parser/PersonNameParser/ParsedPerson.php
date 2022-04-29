<?php

namespace Org\NameApi\Client\Services\Parser\PersonNameParser;

use Org\NameApi\Client\Services\Genderizer\PersonGenderizer\PersonGenderResult;
use Org\NameApi\Client\Services\Parser\OutputPersonName;
use Org\NameApi\Ontology\Input\Entities\Person\PersonRole;
use Org\NameApi\Ontology\Input\Entities\Person\PersonType;


class ParsedPerson
{

    /**
     * @var PersonType $personType
     */
    private $personType = null;
    /**
     * @var PersonRole $personRole
     */
    private $personRole = null;
    /**
     * @var PersonGenderResult $gender
     */
    private $gender = null;

    private $addressingGivenName = null;
    private $addressingSurname = null;

    /**
     * @var OutputPersonName $outputPersonName
     */
    private $outputPersonName = null;

    /**
     * @var ParsedPerson[] $people
     */
    private $people = null;

    public function __construct(PersonType $personType,
                                PersonRole $personRole,
                                $gender,
                                $addressingGivenName,
                                $addressingSurname,
                                OutputPersonName $outputPersonName,
                                array $people)
    {
        //if (!$names) throw new \Exception("Names may not be empty!");
        $this->personType = $personType;
        $this->personRole = $personRole;
        $this->gender = $gender;
        $this->addressingGivenName = $addressingGivenName;
        $this->addressingSurname = $addressingSurname;
        $this->outputPersonName = $outputPersonName;
        $this->people = $people;
    }

    /**
     * @return PersonType
     */
    public function getPersonType()
    {
        return $this->personType;
    }

    /**
     * @return PersonRole
     */
    public function getPersonRole()
    {
        return $this->personRole;
    }

    /**
     * @return PersonGenderResult or null
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @return null
     */
    public function getAddressingGivenName()
    {
        return $this->addressingGivenName;
    }

    /**
     * @return null
     */
    public function getAddressingSurname()
    {
        return $this->addressingSurname;
    }

    /**
     * @return OutputPersonName
     */
    public function getOutputPersonName()
    {
        return $this->outputPersonName;
    }

    /**
     * Returns the people contained within this person.
     *
     * <p>If the getPersonType() is 'MULTIPLE' then expect content here. But also 'FAMILY' and 'LEGAL' can
     * have entries here.</p>
     *
     * @return ParsedPerson[] the array may be empty
     */
    public function getPeople()
    {
        return $this->people;
    }


    public function __toString()
    {
        $str = 'ParsedPerson{personType=' . $this->personType . '}';
        return $str;
    }
}
