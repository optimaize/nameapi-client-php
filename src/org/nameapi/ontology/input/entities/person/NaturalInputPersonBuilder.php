<?php

namespace org\nameapi\ontology\input\entities\person;

require_once(__DIR__.'/NaturalInputPerson.php');

use org\nameapi\ontology\input\entities\address\InputAddress;
use org\nameapi\ontology\input\entities\address\AddressRelation;
use org\nameapi\ontology\input\entities\address\UseForAllAddressRelation;
use org\nameapi\ontology\input\entities\contact\EmailAddress;
use org\nameapi\ontology\input\entities\contact\TelNumber;
use org\nameapi\ontology\input\entities\person\age\AgeInfo;
use org\nameapi\ontology\input\entities\person\name\InputPersonName;
use org\nameapi\ontology\input\entities\person\gender\StoragePersonGender;

/**
 * Builder for {@link NaturalInputPerson}.
 *
 * <p>The setters don't do anything other than setting the value. They don't check if the value was
 * set already, they don't trim the values.</p>
 */
class NaturalInputPersonBuilder {

    /**
     * @var InputPersonName|null $personName
     */
    private $personName = null;

    /**
     * @var StoragePersonGender $gender
     */
    private $gender;

    /**
     * @var AgeInfo|null $ageInfo
     */
    private $ageInfo = null;

    /**
     * @var MaritalStatus $maritalStatus
     */
    private $maritalStatus;

    /**
     * @var string[]|null $nationalities
     */
    private $nationalities = null;

    /**
     * @var string[]|null $nativeLanguages
     */
    private $nativeLanguages = null;

    /**
     * @var string|null $correspondenceLanguage
     */
    private $correspondenceLanguage = null;

    /**
     * @var string|null $religion
     */
    private $religion = null;

    /**
     * @var AddressRelation[]|null $addresses
     */
    private $addresses = null;

    /**
     * @var TelNumber[]|null $telNumbers
     */
    private $telNumbers = null;

    /**
     * @var EmailAddress[]|null $emailAddresses
     */
    private $emailAddresses = null;



    function __construct() {
    }


    /**
     * @param InputPersonName|null $personName
     * @return NaturalInputPersonBuilder
     */
    public function name(InputPersonName $personName) {
        $this->personName = $personName;
        return $this;
    }

    /**
     * @param $gender
     *        either an instance of StoragePersonGender, or a string in upper case like 'MALE'.
     * @return NaturalInputPersonBuilder
     */
    public function gender($gender) {
        if (is_string($gender)) {
            $gender = new StoragePersonGender($gender);
        }
        $this->gender = $gender;
        return $this;
    }

    /**
     * @param AgeInfo $ageInfo
     * @return NaturalInputPersonBuilder
     */
    public function ageInfo(AgeInfo $ageInfo) {
        $this->ageInfo = $ageInfo;
        return $this;
    }

    /**
     * @param MaritalStatus $maritalStatus
     * @return NaturalInputPersonBuilder
     */
    public function maritalStatus($maritalStatus) {
        $this->maritalStatus = $maritalStatus;
        return $this;
    }

    /**
     * @param string $nationality
     * @return NaturalInputPersonBuilder
     */
    public function addNationality($nationality) {
        if ($this->nationalities==null) {
            $this->nationalities = array();
        }
        array_push($this->nationalities, $nationality);
        return $this;
    }

    /**
     * @param string $nativeLanguage
     * @return NaturalInputPersonBuilder
     */
    public function addNativeLanguage($nativeLanguage) {
        if ($this->nativeLanguages==null) {
            $this->nativeLanguages = array();
        }
        array_push($this->nativeLanguages, $nativeLanguage);
        return $this;
    }

    /**
     * @param string $correspondenceLanguage
     * @return NaturalInputPersonBuilder
     */
    public function correspondenceLanguage($correspondenceLanguage) {
        $this->correspondenceLanguage = $correspondenceLanguage;
        return $this;
    }

    /**
     * @param string $religion
     * @return NaturalInputPersonBuilder
     */
    public function religion($religion) {
        $this->religion = $religion;
        return $this;
    }

    //TODO not used yet
//    public function addAddress($address) {
//    }

    /**
     * @param string|TelNumber $telNumber
     * @return NaturalInputPersonBuilder
     */
    public function addTelNumber($telNumber) {
        if ($this->telNumbers==null) {
            $this->telNumbers = array();
        }
        if (is_string($telNumber)) {
            $telNumber = \org\nameapi\ontology\input\entities\contact\TelNumberFactory::forNumber($telNumber);
        }
        array_push($this->telNumbers, $telNumber);
        return $this;
    }

    /**
     * @param string|EmailAddress $emailAddress
     * @return NaturalInputPersonBuilder
     */
    public function addEmailAddress($emailAddress) {
        if ($this->emailAddresses==null) {
            $this->emailAddresses = array();
        }
        if (is_string($emailAddress)) {
            $emailAddress = \org\nameapi\ontology\input\entities\contact\EmailAddressFactory::forAddress($emailAddress);
        }
        array_push($this->emailAddresses, $emailAddress);
        return $this;
    }


    /**
     * @param InputAddress $address
     * @return NaturalInputPersonBuilder
     */
    public function addAddressForAll(InputAddress $address) {
        if ($this->addresses==null) {
            $this->addresses = array();
        }
        array_push($this->addresses, new UseForAllAddressRelation($address));
        return $this;
    }


    /**
     * @return NaturalInputPerson
     */
    public function build() {
        return new NaturalInputPerson(
            $this->personName, $this->gender,
            $this->ageInfo, $this->maritalStatus,
            $this->nationalities, $this->nativeLanguages,
            $this->correspondenceLanguage,
            $this->religion,
            $this->addresses,
            $this->telNumbers, $this->emailAddresses
        );
    }

}
