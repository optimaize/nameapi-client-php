<?php

namespace org\nameapi\ontology\input\entities\person;

require_once(__DIR__.'/MaritalStatus.php');
require_once(__DIR__.'/age/AgeInfoFactory.php');
require_once(__DIR__.'/gender/ComputedPersonGender.php');
require_once(__DIR__.'/gender/StoragePersonGender.php');
require_once(__DIR__.'/name/InputPersonName.php');

use org\nameapi\ontology\input\entities\contact\EmailAddress;
use org\nameapi\ontology\input\entities\contact\TelNumber;
use org\nameapi\ontology\input\entities\person\age\AgeInfo;
use org\nameapi\ontology\input\entities\person\name\InputPersonName;
use org\nameapi\ontology\input\entities\person\gender\StoragePersonGender;

class NaturalInputPerson {

    /**
     * @return NaturalInputPersonBuilder
     */
    static function builder() {
        return new NaturalInputPersonBuilder();
    }


    /**
     * @var InputPersonName|null $personName
     */
    private $personName = null;

    /**
     * @var StoragePersonGender $gender
     */
    private $gender = null;

    /**
     * @var AgeInfo|null $ageInfo
     */
    private $ageInfo = null;

    /**
     * @var MaritalStatus $maritalStatus
     */
    private $maritalStatus = null;

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

    private $addresses = null;

    /**
     * @var TelNumber[]|null $telNumbers
     */
    private $telNumbers = null;

    /**
     * @var EmailAddress[]|null $emailAddresses
     */
    private $emailAddresses = null;


    /**
     * Use the {@link NaturalInputPersonBuilder} to create this.
     *
     * @param InputPersonName|null $personName
     * @param storagePersonGender $gender
     * @param AgeInfo|null $ageInfo
     * @param MaritalStatus $maritalStatus
     * @param string[]|null $nationalities
     * @param string[]|null $nativeLanguages
     * @param string|null $correspondenceLanguage
     * @param string|null $religion
     * @param $addresses|null TODO not used yet
     * @param TelNumber[]|null $telNumbers
     * @param EmailAddress[]|null $emailAddresses
     * @throws Exception
     */
    public function __construct(InputPersonName $personName, $gender,
                                $ageInfo, $maritalStatus,
                                $nationalities, $nativeLanguages,
                                $correspondenceLanguage,
                                $religion,
                                $addresses,
                                $telNumbers, $emailAddresses) {
        if ($gender==null) throw new \Exception("Param gender is mandatory, use UNKNOWN!");
        if ($maritalStatus==null) throw new \Exception("Param maritalStatus is mandatory, use UNKNOWN!");
        $this->personName = $personName;
        $this->gender = $gender;
        $this->ageInfo = $ageInfo;
        $this->maritalStatus = $maritalStatus;
        $this->nationalities = $nationalities;
        $this->nativeLanguages = $nativeLanguages;
        $this->correspondenceLanguage = $correspondenceLanguage;
        $this->religion = $religion;
        $this->addresses = $addresses;
        $this->telNumbers = $telNumbers;
        $this->emailAddresses = $emailAddresses;
    }

    /**
     * @return InputPersonName|null
     */
    public function getPersonName() {
        return $this->personName;
    }

    /**
     * @return storagePersonGender
     */
    public function getGender() {
        return $this->gender;
    }

    /**
     *
     * @return AgeInfo|null
     */
    public function getAgeInfo() {
        return $this->ageInfo;
    }

    /**
     * @return MaritalStatus
     */
    public function getMaritalStatus() {
        return $this->maritalStatus;
    }

    /**
     * @return string[]|null
     */
    public function getNationalities() {
        return $this->nationalities;
    }

    /**
     * @return string[]|null
     */
    public function getNativeLanguages() {
        return $this->nativeLanguages;
    }

    /**
     * @return string|null
     */
    public function getCorrespondenceLanguage() {
        return $this->correspondenceLanguage;
    }

    /**
     * @return string|null
     */
    public function getReligion() {
        return $this->religion;
    }

    //TODO not used yet
//    /**
//     * @return null
//     */
//    public function getAddresses() {
//        return $this->addresses;
//    }

    /**
     * @return null|EmailAddress[]
     */
    public function getEmailAddresses() {
        return $this->emailAddresses;
    }

    /**
     * @return null|TelNumber[]
     */
    public function getTelNumbers() {
        return $this->telNumbers;
    }

}
