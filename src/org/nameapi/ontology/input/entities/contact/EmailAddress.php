<?php

namespace org\nameapi\ontology\input\entities\contact;

class EmailAddress {

    /**
     * @var string $emailAddress
     */
    private $emailAddress;

    /**
     * @param string $emailAddress
     */
    public function __construct($emailAddress) {
        $this->emailAddress = $emailAddress;
    }

    /**
     * @return string
     */
    public function getEmailAddress() {
        return $this->emailAddress;
    }

}
