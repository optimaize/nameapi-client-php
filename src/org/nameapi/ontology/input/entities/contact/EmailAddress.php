<?php

namespace org\nameapi\ontology\input\entities\contact;

class EmailAddress implements \JsonSerializable {

    /**
     * @var string $emailAddress
     */
    public $emailAddress;

    /**
     * @param string $emailAddress
     */
    public function __construct($emailAddress) {
        $this->emailAddress = $emailAddress;
    }

    public function jsonSerialize() {
        return array(
            'type'         => "EmailAddressImpl",
            'emailAddress' => $this->emailAddress,
        );
    }
}
