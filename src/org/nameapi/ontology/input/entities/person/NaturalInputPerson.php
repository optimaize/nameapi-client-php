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
use org\nameapi\ontology\input\entities\address\AddressRelation;

class NaturalInputPerson {

    /**
     * @return NaturalInputPersonBuilder
     */
    static function builder() {
        return new NaturalInputPersonBuilder();
    }

    public $type = 'NaturalInputPerson';

    /**
     * @var InputPersonName|null $personName
     */
    public $personName = null;

    /**
     * @var StoragePersonGender $gender
     */
    public $gender = null;

    /**
     * @var AgeInfo|null $ageInfo
     */
    public $ageInfo = null;

    /**
     * @var string $maritalStatus
     */
    public $maritalStatus = null;

    /**
     * @var string[]|null $nationalities
     */
    public $nationalities = null;

    /**
     * @var string[]|null $nativeLanguages
     */
    public $nativeLanguages = null;

    /**
     * @var string|null $correspondenceLanguage
     */
    public $correspondenceLanguage = null;

    /**
     * @var string|null $religion
     */
    public $religion = null;

    /**
     * @var AddressRelation[]|null $addresses
     */
    public $addresses = null;

    /**
     * @var TelNumber[]|null $telNumbers
     */
    public $telNumbers = null;

    /**
     * @var EmailAddress[]|null $emailAddresses
     */
    public $emailAddresses = null;


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
     * @param AddressRelation[]|null $addresses
     * @param TelNumber[]|null $telNumbers
     * @param EmailAddress[]|null $emailAddresses
     */
    public function __construct(InputPersonName $personName, $gender,
                                $ageInfo, $maritalStatus,
                                $nationalities, $nativeLanguages,
                                $correspondenceLanguage,
                                $religion,
                                $addresses,
                                $telNumbers, $emailAddresses) {
        $this->personName = $personName;
        $this->gender = ($gender!=null) ? (String)$gender : null;
        $this->ageInfo = $ageInfo;
        $this->maritalStatus = ($maritalStatus!=null) ? (String)$maritalStatus : null;
        $this->nationalities = $nationalities;
        $this->nativeLanguages = $nativeLanguages;
        $this->correspondenceLanguage = $correspondenceLanguage;
        $this->religion = $religion;
        $this->addresses = $addresses;
        $this->telNumbers = $telNumbers;
        $this->emailAddresses = $emailAddresses;
    }

}
