<?php

namespace org\nameapi\client\services\email\emailnameparser;

require_once('EmailAddressNameType.php');

class NameFromEmailAddress {

    /**
     * @var string $name
     */
    private $name = null;

    /**
     * @var EmailAddressNameType $nameType
     */
    private $nameType = null;


    /**
     * @param string[] $name
     * @param EmailAddressNameType $nameType
     */
    public function __construct($name, EmailAddressNameType $nameType) {
        $this->name = $name;
        $this->nameType = $nameType;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @return EmailAddressNameType
     */
    public function getNameType() {
        return $this->nameType;
    }


    public function __toString() {
//        $ret  = 'NameFromEmailAddress{';
//        $ret .= 'name='.$this->name;
//        $ret .= ', nameType='.$this->nameType;
//        return $ret.'}';

        $ret = $this->name;
        if ($this->nameType->toString()!='NAME') {
            $ret .= ' (type='.$this->nameType->toString().')';
        }
        return $ret;
    }
} 