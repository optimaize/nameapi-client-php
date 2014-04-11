<?php

namespace org\nameapi\client\services\email\emailnameparser;

require_once(__DIR__.'/EmailAddressNameType.php');

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
        $ret = $this->name;
        if ((string)$this->nameType != 'NAME') {
            $ret .= ' (type=' . (string)$this->nameType .')';
        }
        return $ret;
    }
} 