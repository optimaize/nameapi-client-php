<?php

namespace Org\NameApi\Ontology\Input\Entities\Person;

use Org\NameApi\Ontology\Input\Entities\Address\AddressRelation;
use Org\NameApi\Ontology\Input\Entities\Contact\EmailAddress;
use Org\NameApi\Ontology\Input\Entities\Contact\TelNumber;
use Org\NameApi\Ontology\Input\Entities\Person\Age\AgeInfo;
use Org\NameApi\Ontology\Input\Entities\Person\Gender\StoragePersonGender;
use Org\NameApi\Ontology\Input\Entities\Person\Name\InputPersonName;

class NaturalInputPerson
{

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
     * @param  InputPersonName|null  $personName
     * @param  storagePersonGender  $gender
     * @param  AgeInfo|null  $ageInfo
     * @param  MaritalStatus  $maritalStatus
     * @param  string[]|null  $nationalities
     * @param  string[]|null  $nativeLanguages
     * @param  string|null  $correspondenceLanguage
     * @param  string|null  $religion
     * @param  AddressRelation[]|null  $addresses
     * @param  TelNumber[]|null  $telNumbers
     * @param  EmailAddress[]|null  $emailAddresses
     */
    public function __construct(
        InputPersonName $personName,
        $gender,
        $ageInfo,
        $maritalStatus,
        $nationalities,
        $nativeLanguages,
        $correspondenceLanguage,
        $religion,
        $addresses,
        $telNumbers,
        $emailAddresses
    ) {
        $this->personName = $personName;
        $this->gender = ($gender != null) ? (string) $gender : null;
        $this->ageInfo = $ageInfo;
        $this->maritalStatus = ($maritalStatus != null) ? (string) $maritalStatus : null;
        $this->nationalities = $nationalities;
        $this->nativeLanguages = $nativeLanguages;
        $this->correspondenceLanguage = $correspondenceLanguage;
        $this->religion = $religion;
        $this->addresses = $addresses;
        $this->telNumbers = $telNumbers;
        $this->emailAddresses = $emailAddresses;
    }

    /**
     * @return NaturalInputPersonBuilder
     */
    static function builder()
    {
        return new NaturalInputPersonBuilder();
    }

    public function toArray()
    {
        $ret = array();
        $ret['type'] = $this->type;
        if ($this->personName) {
            $ret['personName'] = $this->personName;
        }
        if ($this->gender) {
            $ret['gender'] = $this->gender;
        }
        if ($this->ageInfo) {
            $ret['ageInfo'] = $this->ageInfo;
        }
        if ($this->maritalStatus) {
            $ret['maritalStatus'] = $this->maritalStatus;
        }
        if ($this->nationalities) {
            $ret['nationalities'] = $this->nationalities;
        }
        if ($this->nativeLanguages) {
            $ret['nativeLanguages'] = $this->nativeLanguages;
        }
        if ($this->correspondenceLanguage) {
            $ret['correspondenceLanguage'] = $this->correspondenceLanguage;
        }
        if ($this->religion) {
            $ret['religion'] = $this->religion;
        }
        if ($this->addresses) {
            $ret['addresses'] = $this->addresses;
        }
        if ($this->telNumbers) {
            $ret['telNumbers'] = $this->telNumbers;
        }
        if ($this->emailAddresses) {
            $ret['emailAddresses'] = $this->emailAddresses;
        }
        return $ret;
    }
}
